<?php


namespace App\Functions;

// Carregue configurações sensíveis de um arquivo separado
require_once __DIR__ . '/../../app/config/config_secret.php';
require_once __DIR__ . '/../../app/config/config.php';

use App\Config\ENVIRONMENT;


/**
 * Obtém as configurações do banco de dados para ambiente de producao.
 *
 * @return array
 */
function getDatabaseConnection(): mysqli
{
    /* 
    $db_host = getenv('DB_HOST');
    $db_user = getenv('DB_USER');
    $db_pass = getenv('DB_PASSWORD');
    $db_name = getenv('DB_DATABASE');
    */
    //usando o carregamento do app/config/config.php
    $db_con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    mysqli_set_charset($db_con, "utf8mb4");

    return $db_con;
}

/**
 * Obtém as configurações do banco de dados para ambiente de teste.
 *
 * @return array
 */
function get_test_database_config() {
    
    //usando o carregamento do app/config/config.php
    $db_con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    mysqli_set_charset($db_con, "utf8mb4");

    return $db_con;
}
