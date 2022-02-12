<?php

// Get train number from url
$trainNo = $_GET['trainNo'];

// Parse html here

// Note: It is not recommended to create an API by scraping web pages, 
// if we do so the output is not predictable and dirty
// (because html contents does not have the same structure)
// usually we fetch data from database (eg, MYSQL)

// AN EXAMPLE OF HOW TO SCRAPE A WEB PAGE USING PHP

// import simple_html_dom library
require 'simple_html_dom.php';

$html = file_get_html('http://www.indiarailinfo.com/train/1524?');

foreach($html->find('div.topcapsule') as $train) {
    $trainName = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $html->find('h1', 0)->plaintext);
}

// echo file_get_html('http://www.indiarailinfo.com/train/1524?')->plaintext;

// REAL API SAMPLE

// FETCH DATA FROM DATABASE HERE

// return a JSON response
header('Content-type: application/json');
$response = array();
$response['trainNo'] = $trainNo;
$response['trainName'] = "MGR Chennai Central - Mysuru Shatabdi Express";
$response['daysRunning'] = "Runs on: Mon Tue Thu Fri Sat Sun";

$scheduleData = array();
// use a for loop here while fetching from database
$scheduleData[0] = array();
$scheduleData[0]['stationName'] = "MGR Chennai Ctrl(MAS)";
$scheduleData[0]['arrivalTime'] = "Source";
$scheduleData[0]['departureTime'] = "06:00";
$scheduleData[0]['distance'] = "0.0 KM";
$scheduleData[0]['day'] = "1";
$scheduleData[0]['platform'] = "6,9,11";
$scheduleData[0]['avgDelay'] = "-";

$scheduleData[1] = array();
$scheduleData[1]['stationName'] = "Katpadi Jn(KPD)";
$scheduleData[1]['arrivalTime'] = "07:38";
$scheduleData[1]['departureTime'] = "07:40";
$scheduleData[1]['distance'] = "129.0 KM";
$scheduleData[1]['day'] = "1";
$scheduleData[1]['platform'] = "1";
$scheduleData[1]['avgDelay'] = "-";

$scheduleData[2] = array();
$scheduleData[2]['stationName'] = "KSR Bengaluru City Jn(SBC)";
$scheduleData[2]['arrivalTime'] = "10:55";
$scheduleData[2]['departureTime'] = "11:00";
$scheduleData[2]['distance'] = "358.5 KM";
$scheduleData[2]['day'] = "1";
$scheduleData[2]['platform'] = "7";
$scheduleData[2]['avgDelay'] = "-";

$scheduleData[3] = array();
$scheduleData[3]['stationName'] = "Mysuru Jn(MYS)";
$scheduleData[3]['arrivalTime'] = "13:00";
$scheduleData[3]['departureTime'] = "Dstn";
$scheduleData[3]['distance'] = "496.1 KM";
$scheduleData[3]['day'] = "1";
$scheduleData[3]['platform'] = "1";
$scheduleData[3]['avgDelay'] = "-";

$response['scheduleData'] = $scheduleData;

$response['catering'] = "✕ Pantry Car ✓ On-board Catering✓ E-Catering";
$response['coachPosition'] = "←L←EOG←CE1←C11←C10←C9←C8←C7←C6←C5←C4←C3←C2←C1←E1←K1←EOG↤";

$responseJSON = json_encode($response, JSON_UNESCAPED_UNICODE); // mandatory for unicode output

echo $responseJSON;

// {
// 	"trainName": "MGR Chennai Central - Mysuru Shatabdi Express",
// 	"daysRunning": "Runs on: Mon Tue Thu Fri Sat Sun ",
// 	"scheduleData": [{
// 		"stationName": "MGR Chennai Ctrl(MAS)",
// 		"arrivalTime": "Source",
// 		"departureTime": "06:00",
// 		"distance": "0.0 KM",
// 		"day": "1",
// 		"platform": "6,9,11",
// 		"avgDelay": "-"
// 	}, {
// 		"stationName": "Katpadi Jn(KPD)",
// 		"arrivalTime": "07:38",
// 		"departureTime": "07:40",
// 		"distance": "129.0 KM",
// 		"day": "1",
// 		"platform": "1",
// 		"avgDelay": "-"
// 	}, {
// 		"stationName": "KSR Bengaluru City Jn(SBC)",
// 		"arrivalTime": "10:55",
// 		"departureTime": "11:00",
// 		"distance": "358.5 KM",
// 		"day": "1",
// 		"platform": "7",
// 		"avgDelay": "-"
// 	}, {
// 		"stationName": "Mysuru Jn(MYS)",
// 		"arrivalTime": "13:00",
// 		"departureTime": "Dstn",
// 		"distance": "496.1 KM",
// 		"day": "1",
// 		"platform": "1",
// 		"avgDelay": "-"
// 	}],
// 	"catering": "✕ Pantry Car ✓ On-board Catering✓ E-Catering",
// 	"coachPosition": "←L←EOG←CE1←C11←C10←C9←C8←C7←C6←C5←C4←C3←C2←C1←E1←K1←EOG↤"
// }


?>