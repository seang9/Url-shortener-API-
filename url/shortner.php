<?php
function updateurl($id) {
	global $app;
	$request = $app->request();
	$urls = json_decode($request->getBody());
	$url = $urls->url;
	$short_code = $urls->short_code;
	$hits = $urls->hits;
	$added_date = $urls->added_date;
	$user_ip = $urls->user_ip;
	$browser = $urls->browser;
	$referer = $urls->referer;
	$lastused = $urls->lastused;
	$sql = "UPDATE link SET url='$url',short_code='$short_code', hits='$hits', added_date='$added_date',
	 user_ip='$user_ip', browser='$browser',referer='$referer', lastused='$lastused' WHERE id='$id'";
	try {
		global $db;
		 $db->exec($sql);
		 echo json_encode($urls);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function getstaturls() {
	$query = "SELECT * FROM link";
	try {
	global $db;
		$urls = $db->query($query);
		$urls = $urls->fetchAll(PDO::FETCH_ASSOC);
		header("Content-Type: application/json", true);
		echo '{"urls": ' . json_encode($urls) . '}';
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function getUrls() {
	$query = "SELECT id,url,short_code FROM link";
	try {
	global $db;
		$urls = $db->query($query);
		$urls = $urls->fetchAll(PDO::FETCH_ASSOC);
		header("Content-Type: application/json", true);
		echo '{"urls": ' . json_encode($urls) . '}';
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function geturlbyid($id) {
	$query = "SELECT id,url,short_code FROM link WHERE id = '$id'";
    try {
		global $db;
		$urls = $db->query($query);
		$urls = $urls->fetch(PDO::FETCH_ASSOC);
        header("Content-Type: application/json", true);
        echo json_encode($urls);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}
function getstatbyid($id) {
	$query = "SELECT * FROM link WHERE id = '$id'";
    try {
		global $db;
		$urls = $db->query($query);
		$urls = $urls->fetch(PDO::FETCH_ASSOC);
        header("Content-Type: application/json", true);
        echo json_encode($urls);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function addurl() {
    global $app;
	$request = $app->request();
	$urls = json_decode($request->getBody());
	$url = $urls->url;
	$hits = $urls->hits;
	$user_ip = $_SERVER['REMOTE_ADDR'];
    $short_code = substr(md5(uniqid(rand(), true)),0,6);
    $browser = get_browser_name($_SERVER['HTTP_USER_AGENT']);
    $referer = $_SERVER['SERVER_NAME'];
	$query= "INSERT INTO link
                 (url, short_code, hits, user_ip, browser, referer,lastused)
              VALUES
                 ('$url', '$short_code', '0', '$user_ip', '$browser', '$referer','0')";
	try {
		global $db;
		$db->exec($query);
		$urls->id = $db->lastInsertId();
		echo json_encode($urls);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}
function deleteurl($id) {
	$sql = "DELETE FROM link WHERE id='$id'";
	try {
		global $db;
		$db->exec($sql);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

?>