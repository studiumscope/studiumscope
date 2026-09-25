<?php
session_start();
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