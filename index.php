<?php

$db_host = 'database-spotify.mysql.database.azure.com';
$db_name = 'spotifi-database';
$db_username = 'rootroot@database-spotify';
$db_password = 'TooRTooR99';
	

function dbConnection()
    {
		global $db_host, $db_name, $db_username, $db_password;
        try {
            $conn = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name, $db_username, $db_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("SET NAMES utf8mb4");
            return $conn;
        } catch (PDOException $e) {
            echo "Connection error " . $e->getMessage();
            exit;
        }
    }
	
	
$conn = dbConnection();
$data = json_decode(file_get_contents("php://input"));

$req = $conn->prepare('SELECT * FROM music');
$req->execute();

$datas = [];

        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
            /* Push offers data in out $offer_data */
            array_push($datas, $row);
        }

        $msg['message'] = 'Datas received';
        $msg['http'] = 200;
        $msg['status'] = 1;
        $msg['data'] = $datas;

echo json_encode($msg);
    
?>