<a href="?acao=novo" class="trab-btn-novo">Nova tarefa</a>

<?php
function estaAtrasado($data) {
    return strtotime($data) < strtotime(date('Y-m-d'));
}
?>

<div class="trab-container">
    <?php if (!empty($dados)): ?>
        <?php foreach ($dados as $dado): ?>
            <?php $atrasado = estaAtrasado($dado['data_entrega']); ?>
            <div class="trab-card<?= $atrasado ? ' trab-atrasado' : '' ?>">
                <div class="trab-header">
                    <strong><?= htmlspecialchars($dado['titulo'] ?? '') ?></strong>
                    <span class="trab-badge-materia"><?= htmlspecialchars($dado['materia'] ?? '') ?></span>
                </div>

                <div class="trab-body">
                    <div class="trab-info">
                        <div>Entrega</div>
                        <div>
                            <?= date('d/m/Y', strtotime($dado['data_entrega'])) ?>
                            <?php if ($atrasado): ?>
                                <span class="trab-tag-atrasado">ATRASADO</span>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($dado['integrantes'])): ?>
                            <div class="trab-linha"></div>
                            <div>Integrantes</div>
                            <div><?= nl2br(htmlspecialchars($dado['integrantes'])) ?></div>
                        <?php endif; ?>

                        <?php if (!empty($dado['descricao'])): ?>
                            <div class="trab-linha"></div>
                            <div>Descrição</div>
                            <div><?= nl2br(htmlspecialchars($dado['descricao'])) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="trab-acoes">
                        <a href="?acao=editar&id=<?= $dado['id']; ?>" class="trab-btn-editar">Editar</a>
                        <a href="?acao=excluir&id=<?= $dado['id']; ?>" class="trab-btn-excluir"
                           onclick="return confirm('Tem certeza?')">Excluir</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="trab-vazio">Nenhum tarefa cadastrado ainda.</p>
    <?php endif; ?>
</div>