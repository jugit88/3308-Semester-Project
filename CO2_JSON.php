<?php 
/*!@file CO2_JSON.php
   * @brief Grab CO2 data from database.
   * @details convert C02 Data to JSON format in order to use for data visualization.
   * 
   *
   *  
   */
/*!
 *@include auth.php
 */
include("auth.php");  
$hostname = "localhost";
$username = "root";
$password = "hanniganlab";

$dbhandle = mysql_connect($hostname, $username, $password)
    or die("Unable to connect to MySQL");

$selectdatabase = mysql_select_db("ypod",$dbhandle)
    or die("Could not select ypod database");

/*$myquery = "SELECT `BMP Temp(C)`, `BMP Pres(mb)` FROM `aqiq_raw`";
$query = mysql_query($myquery);
if ( ! $query ) {
	echo mysql_error();
	die;
}*/

$myquery = "SELECT `CO2 (ADC VAL)` FROM `aqiq_raw`";
$query = mysql_query($myquery);
if ( ! $query ) {
	echo mysql_error();
	die;
}
$rows = array();
$rows['name'] = 'CO2 (ADC VAL)';
while($r = mysql_fetch_array($query)) {
     $rows['data'][] = $r['CO2 (ADC VAL)'];
}

/*$data = array();
for ($x = 0; $x < mysql_num_rows($query); $x++) {
	$data[] = mysql_fetch_assoc($query);
}
echo json_encode($data);*/

$result = array();
array_push($result,$rows);
//array_push($result,$rows1);

print json_encode($result, JSON_NUMERIC_CHECK);

mysql_close($dbhandle);



?>