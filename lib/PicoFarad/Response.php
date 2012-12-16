<?php

namespace PicoFarad\Response;


function redirect($url)
{
    header('Location: '.$url);
    exit;
}


function json(array $data, $status_code = 200)
{
    header('HTTP/1.0 '.$status_code);
    header('Content-Type: application/json');

    echo json_encode($data);
    exit;
}


function text($data, $status_code = 200)
{
    header('HTTP/1.0 '.$status_code);
    header('Content-Type: text/plain');

    echo $data;
    exit;
}


function html($data, $status_code = 200, $csp = true)
{
    header('HTTP/1.0 '.$status_code);
    header('Content-Type: text/html; charset=utf-8');

    if ($csp) {

        foreach (array('X-WebKit-CSP', 'X-Content-Security-Policy', 'Content-Security-Policy') as $header) {

            header($header.": default-src 'self'");
        }
    }

    echo $data;
    exit;
}