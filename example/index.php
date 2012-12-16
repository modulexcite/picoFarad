<?php

use PicoFarad\Router;
use PicoFarad\Response;
use PicoFarad\Request;
use PicoTemplate\Template;
use Model\Task;


Router\before(function() {


});


Router\get('/task/:name', function($name) {

    Response\json(Task\find_by_name($name));
});


Router\post('/tasks', function() {

    $task = Request\form_values();

    if (Task\create($task)) {

        Session\flash('Task created successfully.');
    }
    else {

        Session\flash_error('Unable to create this task.');
    }

    Response\redirect('/tasks');
});


Router\get('/tasks', function() {

    Response\html(Template\layout('task_index', Task\find_all()));
});


Router\execute();