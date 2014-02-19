<html>
<head>
	<title>CGMiner Database Records/title>
	<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>

<?php
// Script for displaying data stored in SQL database

include_once('functions.inc.php');

$link = mysql_connect($host, $username, $password, $database);

if (!$link) {
	die('Could not connect: ' . mysql_error());
}
	
mysql_select_db($database) or die( 'Unable to select database');

$result = mysql_query("SELECT * from mining_stats");

$results_array = array();

while($row = mysql_fetch_assoc($result)) {
     $results_array[$row['id']] = $row;
}

echo '<table>';
echo '<tr><th>Time</th><th>Temperature</th><th>Fan</th><th>Shares</th><th>Load</th><th>Hash Rate</th></tr>';

foreach ($results_array as $therow) {
	
	$theDate = $therow['thetime'];
	$dt = new DateTime("@$theDate");

	$fanparts = explode(" ", $therow['fan']);
	$shareparts = explode(" ", $therow['shares']);


	echo '<tr><td>';
	echo $dt->format('Y-m-d H:i:s').'</td>';
	echo '<td>';
	echo $therow['temp'].' c</td>';
	echo '<td>';
	echo $fanparts[0].' % '.$fanparts[2].' rpm'.'</td>';
	echo '<td>';
	echo $shareparts[0].' valid / '.$shareparts[2].' invalid ('.$shareparts[3].' %) </td>';
	echo '<td>';
	echo $therow['theload'].' %</td>';
	echo '<td>';
	echo $therow['rate'].' KH/s</td></tr>';
}
echo '</table>';

?>

</body>
</html>