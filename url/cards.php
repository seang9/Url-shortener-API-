<?php
function getpopularurl() {
 	$query = "SELECT `short_code` as urls  FROM `link` order by `hits` DESC LIMIT 1";
 	try {
 	global $db;
 		$urls = $db->query($query);
 		$urls = $urls->fetch(PDO::FETCH_ASSOC);
 		header("Content-Type: application/json", true);
 		echo '{"url": ' . json_encode($urls) . '}';
 	} catch(PDOException $e) {
 		echo '{"error":{"text":'. $e->getMessage() .'}}';
 	}
 }
function getNumofurls() {
 	$query = "SELECT COUNT(url) as urls FROM `link` ";
 	try {
 	global $db;
 		$urls = $db->query($query);
 		$urls = $urls->fetch(PDO::FETCH_ASSOC);
 		header("Content-Type: application/json", true);
 		echo '{"url": ' . json_encode($urls) . '}';
 	} catch(PDOException $e) {
 		echo '{"error":{"text":'. $e->getMessage() .'}}';
 	}
 }
function getopbrowser() {
 	$query = "SELECT min(browser) as urls FROM `link`";
 	try {
 	global $db;
 		$urls = $db->query($query);
 		$urls = $urls->fetch(PDO::FETCH_ASSOC);
 		header("Content-Type: application/json", true);
 		echo '{"url": ' . json_encode($urls) . '}';
 	} catch(PDOException $e) {
 		echo '{"error":{"text":'. $e->getMessage() .'}}';
 	}
}
 ?>