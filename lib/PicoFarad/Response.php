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
    header('Content-Type: text/plain; charset=utf-8');

    echo $data;
    exit;
}


function html($data, $status_code = 200)
{
    header('HTTP/1.0 '.$status_code);
    header('Content-Type: text/html; charset=utf-8');

    echo $data;
    exit;
}


function csp(array $policies = array('default-src'), array $hosts = array())
{
    foreach (array('X-WebKit-CSP', 'X-Content-Security-Policy', 'Content-Security-Policy') as $header) {

        $values = '';

        foreach ($policies as $policy) {

            $values .= rtrim($policy." 'self' ".implode(' ', $hosts)).'; ';
        }

        header($header.': '.$values);
    }
}


function nosniff()
{
    header('X-Content-Type-Options: nosniff');
}


function xss()
{
    header('X-XSS-Protection: 1; mode=block');
}


function hsts()
{
    header('Strict-Transport-Security: max-age=31536000');
}


function xframe($mode = 'DENY', array $urls = array())
{
    header('X-Frame-Options: '.$mode.' '.implode(' ', $urls));
}