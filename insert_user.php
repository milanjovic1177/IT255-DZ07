<?php
include ("commons.php");

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    setResponseCode(405, "Request method not supported!");
    die();
} else {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

	if (!isset($first_name)) {
        setResponseCode(400, "first_name parameter is missing.");
        die();
	} else if (!isset($last_name)) {
		setResponseCode(400, "last_name parameter is missing.");
        die();
	} else if (!isset($email)) {
		setResponseCode(400, "email parameter is missing.");
        die();
	} else if (!isset($phone)) {
		setResponseCode(400, "phone parameter is missing.");
        die();
	}

    $dbConnection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $dbConnection->set_charset('utf8');

    $sql = "INSERT INTO users (first_name, last_name, email, phone) VALUES (?, ?, ?, ?)";
    $stmt = $dbConnection->prepare($sql);
//    echo $dbConnection -> error;
    $stmt->bind_param('ssss', $first_name, $last_name, $email, $phone);
    $stmt->execute();
    $inserted_id = $dbConnection->insert_id;
    $stmt->close();

    mysqli_close($dbConnection);
    echo $inserted_id;
    die();
}

?>
