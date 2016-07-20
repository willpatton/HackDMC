<?php
/**
 * app/functions.php
 *
 * "hackathon" quality code
 * not yet in a class.  To support quick development.
 *
 */

/**
 * LOGOUT - reset app to a known state
 *
 */
function logout(){
    if (!isset($_SESSION)) {
        session_start();
    }

    // Unset all of the session variables.
    $_SESSION = array();

    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    session_destroy();
}

/**
 * RENDER - render an array to HTML
 * @param $ar
 * @return string
 */
function render_ar($ar)
{
    //ksort($ar);
    $html = '';
    foreach($ar as $key=>$val){
        $html .= $key;
        if(is_array($val)){
            //$html .= "\t".$key . " \n";
            $html .= "\n".render_ar($val);
            continue;
        }
        $html .= ' '. $val . "\n";
    }
    return $html;
}


/**
 * IMPORT - initiazlizes a database with data from a JSON file
 * Added LIMIT to control max loop count
 * @param $db
 * @param $filename
 */
function import_json_to_db($db, $filename)
{
    global $table, $msg; //, $lines;
    $count = 0;

    $f = fopen($filename, 'r');

    while ($buffer = fgets($f)) {

        //READ
        $ar = json_decode($buffer, true);
        //print_r($ar);

        //INSERT
        $fields = '';
        $values = '';
        foreach ($ar as $key => $val) {
            //TODO - handle nested arrays
            if (!is_array($val)) {
                $fields .= "$key, ";
                $values .= "'$val', ";
            }
        }
        $fields = rtrim($fields, ', ');
        $values = rtrim($values, ', ');

        //INSERT
        //$fields = 'machine_id, description';
        //$values = '270, "Hello World" ';
        $sql = "INSERT INTO " . $table . ($fields == "" ? "" : " (" . $fields . ")") . " VALUES (" . $values . ")";
        //echo $sql;

        $cresult = $db->dbQuery($sql);
        if ($cresult) {
            //TRUE - insert was okay
        } else {
            //FALSE - insert had error
        }


        //BREAK if too many
        if($count >= LIMIT_IMPORT){
            break;
        }
        $count++;
    }

    if($count > 0){
        $msg = '<p style="color:green;">Imported okay: '.$count.' of '.LIMIT_IMPORT.' records. Source file: '.$filename.'</p>'."\n";
    }
 }


/**
 * CONVERT - convert from JSON format to CSV format.  Used once for development
 * Tested at 200,000 lines (30 seconds runtime)
 * Added LIMIT hack to control loop count
 * @param $filenamein
 * @param $filenameout
 */
function convert_json_to_csv($filenamein, $filenameout)
{
    global $count,$lines,$html;

    $fin = fopen($filenamein, 'r');
    $fout = fopen($filenameout, 'w+');

    while ($buffer = fgets($fin)) {

        $ar = json_decode($buffer, true);
        //print_r($ar);

        /*
        if($count == 0) {
            foreach($ar as $key=>$value){
                @$html .=  $key . ','.$value."";
            }
            $html .=  "\n";
    }*/
        if($count==0){
            $html .= "Line,";
            $html .= "Category,";
            $html .= "Component,";
            $html .= "Type,";
            $html .= "Subtype,";
            $html .= "Machine ID,";
            $html .= "Instance ID,";
            $html .= "Sequence,";
            $html .= "Department 0,";
            $html .= "Department 1,";
            $html .= "Department 2,";
            $html .= "Begin Time,";
            $html .= "MT Name,";
            $html .= "MT Value,";
            $html .= "Flag,";

            $html .= "\n";
        }

        //BREAKOUT  - specific to machine 270... a hack for for debug.
        if($ar['machine_id'] == 270) {

            //print_r($ar);
            //exit;
            $html .= $count+1 . ",";
            $html .= $ar['category'].",";
            $html .= $ar['component'].",";
            $html .= $ar['type'].",";
            $html .= $ar['subtype'].",";
            $html .= $ar['machine_id'].",";
            @$html .= $ar['instance_id'].",";       //TODO - suppressed warning
            $html .= $ar['sequence'].",";
            $html .= $ar['department'][0].",";
            $html .= $ar['department'][1].",";
            $html .= $ar['department'][2].",";
            $html .= $ar['begin_dt_tm'].",";
            @$html .= $ar['mt_name'].",";           //TODO - suppressed warning
            $html .= $ar['mt_value'].",";
            $html .= $ar['virtual_flag'].",";
            $html .= "\n";
            /*
            foreach($ar as $key=>$value){
                @$html .=  $key . ','.$value."";
            }
            $html .=  "\n";
            */
        }

        $bytes = fputs($fout, $html);

        if($count % 100000 == 0){
            echo '<p>'.$count / 100000 . '</p>';
        }
        //MAX
        if($count >= $lines){
            break;
        }
        $count++;
        $html = '';
    }
    fclose($fout);
    fclose($fin);

//echo $html;
    file_put_contents($fout, $html);

    echo '<p>Complete: '.$count.' lines</p>';

}


/**
 * EXPORT - export/download a data array to a CSV
 * @param $filename
 * @param $result
 */
function export_ar_to_csv($filename, $result)
{
    $csv = '';
    $count = 0;

    while($ar = $result->fetch_assoc()) {

        if($count == 0) {
            foreach($ar as $key=>$val) {
                $csv .= $key . ',';
            }
            $csv .= "\n";
        }

        foreach($ar as $key=>$val){
            //$csv .= $key . ',';
            if(is_array($val)){
                //$csv .= "\t".$key . " \n";
                //$html .= ",".n_ar($val);
                continue;
            }
            $csv .= $val.',';
        }
        $csv .= "\n";

        $count++;
    }

    //SAVE - optionally save to a server
    //$bytes = file_put_contents($filename, $csv);


    //DOWNLOAD - to client
    $quoted = sprintf('"%s"', addcslashes(basename($filename), '"\\'));
    $size   = filesize($filename);
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . $quoted);
    header('Content-Transfer-Encoding: binary');
    header('Connection: Keep-Alive');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . $size);

    echo $csv;
    exit();
}
