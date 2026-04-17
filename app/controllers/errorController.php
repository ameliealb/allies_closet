<?php

function show403()
{
    http_response_code(403);
    require RACINE . '/app/views/errors/403View.php';
    exit;
}

function show404()
{
    http_response_code(404);
    require RACINE . '/app/views/errors/404View.php';
    exit;
}