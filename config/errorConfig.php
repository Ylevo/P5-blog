<?php

$errorsActive = [
    E_ERROR => TRUE,
    E_WARNING => FALSE,
    E_PARSE => TRUE,
    E_NOTICE => FALSE,
    E_CORE_ERROR => TRUE,
    E_CORE_WARNING => FALSE,
    E_COMPILE_ERROR => TRUE,
    E_COMPILE_WARNING => TRUE,
    E_USER_ERROR => TRUE,
    E_USER_WARNING => FALSE,
    E_USER_NOTICE => FALSE,
    E_STRICT => FALSE,
    E_RECOVERABLE_ERROR => FALSE,
    E_DEPRECATED => FALSE,
    E_USER_DEPRECATED => FALSE,
    E_ALL => FALSE
];

$errorMask = array_sum(
    array_keys($errorsActive, $search = true)
);

error_reporting($errorMask);

function myExceptionHandler($e)
{
    error_log($e);
    http_response_code(500);
    if (filter_var(ini_get('display_errors'), FILTER_VALIDATE_BOOLEAN)) {
        echo $e;
    } else {
        echo "<h1>500 Internal Server Error</h1>
              An internal server error has occurred.<br>
              Please try again later.";
    }
    exit;
}

set_exception_handler('myExceptionHandler');

set_error_handler(function ($level, $message, $file = '', $line = 0) {
    throw new ErrorException($message, 0, $level, $file, $line);
}, $errorMask);


