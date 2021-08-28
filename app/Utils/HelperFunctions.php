<?php
/**
 * Routing assets
 * @param string $path
 * @return string
 */
function asset(string $path): string
{
    $host = $_SERVER['HTTP_HOST'];
    $protocol = $_SERVER['REQUEST_SCHEME'];
    return "$protocol://$host/$path";
}