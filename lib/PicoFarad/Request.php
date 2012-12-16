<?php

namespace PicoFarad\Request;

function param($name)
{
    return isset($_GET[$name]) ? $_GET[$name] : null;
}


function int_param($name)
{
    return isset($_GET[$name]) && is_int($_GET[$name]) ? $_GET[$name] : null;
}


function values()
{
    if (! empty($_POST)) {

        return $_POST;
    }

    $result = json_decode(body(), true);

    if ($result) {

        return $result;
    }

    return array();
}


function body()
{
    return file_get_contents('php://input');
}