<?php

namespace PicoFarad\Session;

const SESSION_LIFETIME = 2678400;


session_set_cookie_params(SESSION_LIFETIME, '/', null, false, true);
session_start();


function flash($message)
{
    $_SESSION['flash_message'] = $message;
}


function flash_error($message)
{
    $_SESSION['flash_error_message'] = $message;
}