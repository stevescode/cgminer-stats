#!/usr/bin/php

<?php
// Script for logging single rig/single GPU cgminer stats into an SQL database
// Configure as a Cron Job to run at the required interval to update the database

include_once('functions.inc.php');

$nr_rigs = count($r);

for ($i=0; $i<$nr_rigs; $i++)
{
	$r[$i]['summary'] = request('summary', $r[$i]['ip'], $r[$i]['port']);
	if ($r[$i]['summary'] != null)
	{
		$r[$i]['devs']  = request('devs',  $r[$i]['ip'], $r[$i]['port']);
		$r[$i]['stats'] = request('stats', $r[$i]['ip'], $r[$i]['port']);
		$r[$i]['pools'] = request('pools', $r[$i]['ip'], $r[$i]['port']);
		$r[$i]['coin']  = request('coin',  $r[$i]['ip'], $r[$i]['port']);
	}
}

for ($i=0; $i<$nr_rigs; $i++)
{
	if (isset ($r[$i]['devs']))
	{
		foreach ($r[$i]['devs'] as $key=>$dev)
		{
			if ($key == 'GPU0')
			{		
				$rate =		$dev['MHS 5s']*1000;
				$temp = 	round($dev['Temperature']);
				$theload =	$dev['GPU Activity'];
				$shares = 	$dev['Accepted'].'  '.$dev['Rejected'].' '.number_format($dev['Device Rejected%'],2).' ';
				$fan =		$dev['Fan Percent'].'  '.$dev['Fan Speed'];
			}
		}
	}
}

$date = date('U');

// ENTER RESULTS INTO SQL TABLE
	
	$link = mysql_connect($host, $username, $password, $database);
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
		
	mysql_select_db($database) or die( 'Unable to select database');
	
	$newquery = "INSERT INTO '$tablename' (thetime, temp, fan, shares, theload, rate) VALUES ('$date','$temp','$fan','$shares','$theload','$rate')";
	
	mysql_query($newquery) 
	or die(mysql_error());
?>
