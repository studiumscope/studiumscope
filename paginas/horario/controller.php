<?php 

require_once __DIR__ . 'db.php'; 

$controller = new Controller(); 

$acao = $_GET['acao'] ?? 'index'; 

switch ($acao) {

    case 'index':
        $controller->index();
        break;
    case 'salvar':
        $controller->salvar();
       break;
    case 'editar':
        $controller->editar();
       break;
    case 'excluir':
        $controller->excluir();
        break;
    default:
        $controller->index();
        break;
}


class Controller {

    public function index() {
        $pdo = getConnection();
       
        $sql = "SELECT * FROM horario ORDER BY id";
        $stmt = $pdo->query($sql);
        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ . "_cabecalho.php";
        include __DIR__ . "lista.php";
        include "_rodape.php";
    }


    public function salvar() {

        $pdo = getConnection();

        $id = $_POST['id'] ?? '';

        $domingo = $_POST['domingo'] ?? '';
        $segunda = $_POST['segunda'] ?? '';
        $terca = $_POST['terca'] ?? '';
        $quarta = $_POST['quarta'] ?? '';
        $quinta = $_POST['quinta'] ?? '';
        $sexta = $_POST['sexta'] ?? '';
        $sabado = $_POST['sabado'] ?? '';


        if ($id == '') {

            $sql = "INSERT INTO horario
                    (domingo, segunda, terca, quarta, quinta, sexta, sabado)
                    VALUES
                    (:domingo, :segunda, :terca, :quarta, :quinta, :sexta, :sabado)";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':domingo' => $domingo,
                ':segunda' => $segunda,
                ':terca' => $terca,
                ':quarta' => $quarta,
                ':quinta' => $quinta,
                ':sexta' => $sexta,
                ':sabado' => $sabado
            ]);

        } else {

            $sql = "UPDATE horario SET
                        domingo = :domingo,
                        segunda = :segunda,
                        terca = :terca,
                        quarta = :quarta,
                        quinta = :quinta,
                        sexta = :sexta,
                        sabado = :sabado
                    WHERE id = :id";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':domingo' => $domingo,
                ':segunda' => $segunda,
                ':terca' => $terca,
                ':quarta' => $quarta,
                ':quinta' => $quinta,
                ':sexta' => $sexta,
                ':sabado' => $sabado,
                ':id' => $id
            ]);
        }


        header("Location: controller.php?acao=index");
        exit;
    }


    public function editar() {
        $pdo = getConnection();
        $id = $_GET['id'] ?? '';
        $sql = "SELECT * FROM horario WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
        $dado = $stmt->fetch(PDO::FETCH_ASSOC);


        include __DIR__ . "cabecalho.php";
        include "formHorario.php";
        include __DIR__ . "_rodape.php";
    }


    public function excluir() {

        $pdo = getConnection();
        $id = $_GET['id'] ?? '';
        $sql = "DELETE FROM horario WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);


        header("Location: controller.php?acao=index");
        exit;
    }

}