<?php
include ("commons.php");

if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    setResponseCode(405, "Request method not supported!");
    die();
} else {
    $user_id = $_GET["user_id"];

	if (!isset($user_id)) {
        setResponseCode(400, "user_id parameter is missing.");
        die();
	}

    $dbConnection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $dbConnection->set_charset('utf8');
    
    $sql = "SELECT first_name, last_name, email, phone FROM users WHERE _id = ?";
    $stmt = $dbConnection->prepare($sql);
    $stmt->bind_param('i', $user_id);
    if ($stmt->execute() && $stmt->bind_result($first_name, $last_name, $email, $phone) && $stmt->fetch()) {
        $ret = array("id" => $user_id, "first_name" => $first_name, "last_name" => $last_name, "email" => $email, "phone" => $phone);
        echo json_encode($ret);
    } else {
        setResponseCode(400, "User with ID $user_id doesn't exist.");
    }
    $stmt->close();

    mysqli_close($dbConnection);
    die();
}

?>
