<?php
//PSR-12
namespace App\Config;

// Credenciais de banco de dados producao
const DB_HOST = 'localhost';
const DB_USER = 'webert';
const DB_PASS = 'Senha';
const DB_NAME = 'ominichanel';

// Credenciais de banco de dados teste
const DB_HOST_TEST = 'localhost';
const DB_USER_TEST = 'webert';
const DB_PASS_TEST = 'Senha';
const DB_NAME_TEST = 'ominichanel';

// Tokens e chaves
const EXTERNAL_TOKEN = 'SfBMRcUT9Bt3A1HHAALxKYfylrPMhFFg35IskTG4R7jYw181120';

// Mercado Pago
const MP_PUBLIC_KEY = 'key';
const MP_ACCESS_TOKEN = 'chave';

//smtp
const SMTP_NAME = "host";
const SMTP_USER = "email";
const SMTP_PASS = "senha";

/**
 * Retorna a configuração do banco de dados.
 *
 * @return array
 */
function get_database_config(): array
{
    return [
        'host' => DB_HOST,
        'user' => DB_USER,
        'password' => DB_PASS,
        'name' => DB_NAME,
    ];
}

/**
 * Obtém as configurações do banco de dados para ambiente de teste.
 *
 * @return array
 */
function get_test_database_config() {
    return [
        'host' => DB_HOST_TEST,
        'user' => DB_USER_TEST,
        'password' => DB_PASS_TEST,
        'name' => DB_NAME_TEST,
    ];
}

/**
 * Retorna a configuração do Mercado Pago da Plataforma.
 *
 * @return array
 */
function get_credentials_saas() : array
{
    return [
        'mp_public_key' => MP_PUBLIC_KEY,
        'mp_access_token' => MP_ACCESS_TOKEN,
    ];
}

/**
 * Retorna a configuração do SMTP da Plataforma.
 *
 * @return array
 */
function get_smtp_config() : array
{
    return [
        'smtp_name' => SMTP_NAME,
        'smtp_user' => SMTP_USER,
        'smtp_pass' => SMTP_PASS,
    ];
}