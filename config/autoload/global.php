<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

$env = getenv('DATABASE_URL');
$user = 'dev';
$password = 'dev';
$host = 'localhost';
$port = 5432;
$dbname = 'dev';
if ( ! empty($env) )
{
    $dbopts = parse_url($env);
    $user = $dbopts["user"];
    $password = $dbopts["pass"];
    $host = $dbopts["host"];
    $port = $dbopts["port"];
    $dbname = ltrim($dbopts["path"],'/');
}
return [
    'db' => [
        'driver'    => 'PDO_PGSQL',
        'user'      => $user,
        'password'  => $password,
        'host'      => $host,
        'port'      => $port,
        'dbname'    => $dbname
    ],
];
