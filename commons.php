<?php

// echo $dbConnection -> error;

// DB:
define("DB_HOST", "localhost");
define("DB_USERNAME", "it255_dz07_users_un");
define("DB_PASSWORD", "kmlsdfijlifsijrijsdvlDSFijsdfsij");
define("DB_NAME", "it255_dz07_users");

// ==== General utility methods: ===================================================

/**
 * Sets the response code and reason
 *
 * @param int $code
 * @param string $reason
 */
function setResponseCode($code, $reason = null, $echo = null)
{
    $code = intval($code);

    if (version_compare(phpversion(), '5.4', '>') && is_null($reason)) {
        http_response_code($code);
    } else {
        header(trim("HTTP/1.0 $code $reason"));
    }

    if ($echo != null) {
        echo $echo;
    } else if ($reason != null) {
        echo $reason;
    }
}

function getRandomString($length = 6)
{
    $validCharacters = "abcdefghijklmnopqrstuxyvwzABCDEFGHIJKLMNOPQRSTUXYVWZ0123456789";
    $validCharNumber = strlen($validCharacters);

    $result = "";

    for ($i = 0; $i < $length; $i ++) {
        $index = mt_rand(0, $validCharNumber - 1);
        $result .= $validCharacters[$index];
    }

    return $result;
}

?>
