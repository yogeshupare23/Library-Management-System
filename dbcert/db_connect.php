<?php
$host = 'rootlms.mysql.database.azure.com';
$username = 'rootlms@rootlms';
$password = 'Yogi#123';
$db_name = 'lms';
try {
//Initializes MySQLi
    $connection = mysqli_init();

    mysqli_ssl_set($connection,NULL,NULL, "admin/DigiCertGlobalRootG2.crt.pem", NULL, NULL);

    // Establish the connection
    mysqli_real_connect($connection, $host, $username, $password, $db_name, 3306, NULL, MYSQLI_CLIENT_SSL);
    mysqli_set_charset($connection, "utf8");
    //If connection failed, show the error
    if (mysqli_connect_errno())
    {
        die('Failed to connect to MySQL: '.mysqli_connect_error());
    }
}
catch (mysqli_sql_exception $e) {
    throw new Exception("MySQL Connection Error: " . $e->getMessage());
}

function getConnection (){
    return $connection;
}
?>