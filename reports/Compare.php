


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Comparing Two Machines</h2>
  <p></p>
  <table class="table">
    <thead>
      <tr>
        <th>Information</th>
        <th>M1721 Okuma MA60H</th>
        <th>M4140 Okuma LB25</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Department</td>
        <td>Gear Grinding Argos</td>
        <td>EDM Plymouth</td>
      </tr>
      <tr>
        <td>Operator</td>
        <td>Johnson</td>
        <td>Smith</td>
      </tr>
    </tbody>
    <thead>
      <tr>
        <th>Energy</th>
        <th>M1721 Okuma MA60H</th>
        <th>M4140 Okuma LB25</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Watts (Last Day)</td>
        <td>300</td>
        <td>20</td>
      </tr>
      <tr>
        <td>Watts (Last Month)</td>
        <td>356</td>
        <td>86</td>
      </tr>
      <tr>
        <td>Watts (Last Year)</td>
        <td>290</td>
        <td>100</td>
      </tr>
      <tr>
        <td>Wattage Variability</td>
        <td>40</td>
        <td>5</td>
      </tr>
    </tbody>
    <thead>
      <tr>
        <th>Utilization</th>
        <th>M1721 Okuma MA60H</th>
        <th>M4140 Okuma LB25</th>
      </tr>
    </thead>
   <tbody>     
      <tr>
        <td>Utilization (Last Day)</td>
        <td>80%</td>
        <td>12%</td>
      </tr>
      <tr>
        <td>Utilization (Last Month)</td>
        <td>90%</td>
        <td>32%</td>
      </tr>
      <tr>
        <td>Utilization (Last Year)</td>
        <td>60%</td>
        <td>36%</td>
      </tr>
    </tbody>
    <thead>
      <tr>
        <th>Value</th>
        <th>M1721 Okuma MA60H</th>
        <th>M4140 Okuma LB25</th>
      </tr>
    </thead>
    <tbody>
    <tr>
        <td>Target Pieces Per Hours</td>
        <td>220</td>
        <td>10</td>
    </tr>
        <tr>
        <td>Parts Per Hour</td>
        <td>200</td>
        <td>13</td>
      </tr>
    <tr>
        <td>Value Per Hour</td>
        <td>$540</td>
        <td>$1,324</td>
        </tr>
    </tbody>
  </table>
</div>
<br>
<hr>
<?php
include 'Include_Plots/Compare.html'; 
?>
<br>
</body>
</html>
