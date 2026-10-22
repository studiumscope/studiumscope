<?php
function getConnection() {
    $host_db = 'db.eoujlobvrtsflkbiucno.supabase.co';
    $port_db = '5432';
    $nome_db = 'postgres';
    $usuario_db = 'postgres';
    $senha_db = 'studiumscope';

    try {
        $pdo = new PDO("pgsql:host=$host_db;port=$port_db;dbname=$nome_db", $usuario_db, $senha_db);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Erro de conexão: " . $e->getMessage());
    }
}
