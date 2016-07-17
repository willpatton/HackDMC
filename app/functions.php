<?php
//functions.php


//RENDER
function n_ar($ar)
{
    //ksort($ar);
    $html = '';
    foreach($ar as $key=>$val){
        $html .= $key;
        if(is_array($val)){
            //$html .= "\t".$key . " \n";
            $html .= "\n".n_ar($val);
            continue;
        }
        $html .= ' '. $val . "\n";
    }
    return $html;
}

//IMPORT file to db
function import_ar($db, $filename)
{
    global $table, $lines;
    $count = 0;

    $f = fopen($filename, 'r');

    while ($buffer = fgets($f)) {

        //READ
        $aid = json_decode($buffer, true);
        //print_r($ar);

        //INSERT
        $fields = '';
        $values = '';
        foreach ($aid as $key => $val) {
            //TODO - handle nested arrays
            if (!is_array($val)) {
                $fields .= "$key, ";
                $values .= "'$val', ";
            }
        }
        $fields = rtrim($fields, ', ');
        $values = rtrim($values, ', ');

        //insert row
        //$fields = 'machine_id, description';
        //$values = '270, "Hello World" ';
        $sql = "INSERT INTO " . $table . ($fields == "" ? "" : " (" . $fields . ")") . " VALUES (" . $values . ")";
        //echo $sql;
        //print_r($db);
        //exit;

        $cresult = $db->dbQuery($sql);
        //if ($num) {
        //    $crow = $cresult->fetch_assoc();
        //}

        //print_r($cresult);


        //BREAK if too many
        if($count >= LIMIT_IMPORT){
            break;
        }
        $count++;
    }
}


//EXPORT
function export($filename, $ar)
{

    //CSV
    //$html .= csv_ar($ar);

    //$fin = fopen($filenamein, 'r');
    //$fout = fopen($filenameout, 'w+');

    //EXPORT TO CSV - works okay kinda
    //export_csv($filenamein, $filenameout);


    $html = '';
    foreach($ar as $key=>$val){
        //$html .= $key . ',';
        if(is_array($val)){
            //$html .= "\t".$key . " \n";
            $html .= ",".n_ar($val);
            continue;
        }
        $html .= ','. $val;
    }
    return $html;
}



function export_csv($filenamein, $filenameout)
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


        if($ar['machine_id'] == 270) {

            //print_r($ar);
            //exit;
            $html .= $count+1 . ",";
            $html .= $ar['category'].",";
            $html .= $ar['component'].",";
            $html .= $ar['type'].",";
            $html .= $ar['subtype'].",";
            $html .= $ar['machine_id'].",";
            @$html .= $ar['instance_id'].",";
            $html .= $ar['sequence'].",";
            $html .= $ar['department'][0].",";
            $html .= $ar['department'][1].",";
            $html .= $ar['department'][2].",";
            $html .= $ar['begin_dt_tm'].",";
            @$html .= $ar['mt_name'].",";
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
    file_put_contents('itamcojson2016.csv', $html);

    echo '<p>Complete: '.$count.' lines</p>';

}
