<?php
date_default_timezone_set('America/Sao_Paulo');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//Creating Array for JSON response
$response = array();
 
// Check if we got the field from the user
if (isset($_GET['vacan']) && isset($_GET['vacansf']) && isset($_GET['pativa']) && isset($_GET['pativasf']) && isset($_GET['fp']) && isset($_GET['fpsf']) && isset($_GET['energia']) && isset($_GET['energiasf']) && isset($_GET['pva']) && isset($_GET['pvasf'])) {
 
    
    $hora = date('Y-m-d H:i:s');
    $data = date('Y-m-d');
    $vacan = $_GET['vacan'];
    $vacansf = $_GET['vacansf'];
    $pativa = $_GET['pativa'];
    $pativasf = $_GET['pativasf'];
    $fp = $_GET['fp'];
    $fpsf = $_GET['fpsf'];
    $energia = $_GET['energia'];
    $energiasf = $_GET['energiasf'];
    $pva = $_GET['pva'];
    $pvasf = $_GET['pvasf'];
    
 
    // Include data base connect class
    $filepath = realpath (dirname(__FILE__));
	require_once($filepath."/db_connect.php");

 
    // Connecting to database 
    $db = new DB_CONNECT();
 
    // Fire SQL query to insert data in weather
    $result = mysql_query("INSERT INTO inversor3 (data,hora,vacan,vacansf,pativa,pativasf,fp,fpsf,energia,energiasf,pva,pvasf) VALUES('$data','$hora','$vacan','$vacansf','$pativa','$pativasf','$fp','$fpsf','$energia','$energiasf','$pva','$pvasf')");
 
    // Check for succesfull execution of query
    if ($result) {
        // successfully inserted 
        $response["success"] = 1;
        $response["message"] = "deu boa.";
 
        // Show JSON response
        echo json_encode($response);
    } else {
        // Failed to insert data in database
        $response["success"] = 0;
        $response["message"] = "deu merda";
 
        // Show JSON response
        echo json_encode($response);
    }
} else {
    // If required parameter is missing
    $response["success"] = 0;
    $response["message"] = "falta coisa ai";
 
    // Show JSON response
    echo json_encode($response);
}
?>