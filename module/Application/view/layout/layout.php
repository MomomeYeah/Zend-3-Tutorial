<?php

function route_url_matches($uri, $default=False)
{
    $request_uri = $_SERVER['REQUEST_URI'];
    return
        ($request_uri === '/' && $default) ||
        $request_uri === $uri;
}

function get_header_active_class($uri, $default=False)
{
    return route_url_matches($uri, $default) ? "active" : "";
}
