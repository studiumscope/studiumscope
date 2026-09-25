<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../authController.php?acao=login");
    exit;
}
require_once __DIR__ . '/../../db.php';

$controller = new TarefasController();

$acao = $_GET['acao'] ?? 'index';
switch ($acao) {
    
     default:
        $controller->index();
}
class TarefasController {

    public function index() {
        
        include __DIR__ . "/../../_cabecalho.php";
        include "lista.php";
        include __DIR__ . "/../../_rodape.php";
      
    }


}