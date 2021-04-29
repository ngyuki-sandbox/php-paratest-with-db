<?php
namespace App;

use PDO;

class ConnectionFactory
{
    public function create(): PDO
    {
        $host     = getenv('MYSQL_HOST');
        $port     = getenv('MYSQL_PORT');
        $username = getenv('MYSQL_USER');
        $password = getenv('MYSQL_PASSWORD');
        $dbname   = getenv('MYSQL_DATABASE');
        $charset  = 'utf8mb4';

        $token = getenv('TEST_TOKEN');
        if ($token !== false) {
            $dbname .= $token;
        }

        return new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=$charset", $username, $password, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
    }
}
