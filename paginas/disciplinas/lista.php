<a href="?acao=novo" class="btn-voltar">Nova Disciplina</a>

<div class="disciplinas-container">
    <?php if (!empty($dados)): ?>
        <?php foreach ($dados as $dado): ?>
            <div class="disciplina-card">
                <div class="disciplina-header">
                    <strong><?= htmlspecialchars($dado['materia'] ?? ''); ?></strong>
                    <strong><?= htmlspecialchars($dado['professor'] ?? ''); ?></strong>
                </div>

                <div class="disciplina-body">
                    <div class="informacoes">
                        <div>Nota Atual</div>
                        <div><?= htmlspecialchars($dado['nota_atual'] ?? ''); ?></div>

                        <div class="linha"></div>

                        <div>Contatos</div>
                        <div><?= htmlspecialchars($dado['contatos'] ?? ''); ?></div>
                    </div>

                    <div class="acoes">
                        <a href="?acao=editar&id=<?= $dado['id']; ?>" class="btn-editar">Editar</a>
                        <a href="?acao=excluir&id=<?= $dado['id']; ?>" class="btn-excluir" onclick="return confirm('Tem certeza?')">Excluir</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nenhuma disciplina encontrada.</p>
    <?php endif; ?>
</div>
