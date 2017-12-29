<?php

function route_url_startswith($uri, $request_uri)
{
    $len = strlen($uri);
    return substr($request_uri, 0, $len) === $uri;
}

function route_url_matches($uri, $default=False)
{
    $request_uri = $_SERVER['REQUEST_URI'];
    return
        ($request_uri === '/' && $default) ||
        route_url_startswith($uri, $request_uri);
}

function get_header_active_class($uri, $default=False)
{
    return route_url_matches($uri, $default) ? "active" : "";
}
