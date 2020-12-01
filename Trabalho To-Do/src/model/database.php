<?php

final class Database
{
    private static $conexao;

    private function __construct()
    {
    }

    public static function getInstance(): PDO
    {
        if (is_null(self::$conexao)) {
            self::$conexao = new PDO('sqlite:'.__DIR__.'../../database/db.sqlite3');
            self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$conexao;
    }

    public static function createSchema(): void
    {
        $db = self::getInstance();
        $db->exec(file_get_contents(__DIR__."./schemas/tarefa.sql"));
    }
}
