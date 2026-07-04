<?php

/**
 * Copie este arquivo para src/Conexao/Conexao.php e ajuste host, banco e credenciais.
 * A pasta src/Conexao/ está no .gitignore para não versionar senhas.
 */

namespace GbClicker\Conexao;

use PDO;

class Conexao
{
    public static function criarConexao(): PDO
    {
        $host = '127.0.0.1';
        $dbname = 'gbclicker';
        $user = 'root';
        $password = '';

        $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";

        return new PDO($dsn, $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }
}
