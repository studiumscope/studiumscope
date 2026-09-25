<a href="?acao=novo" class="disc-btn-novo">+ Nova Disciplina</a>

<div class="disc-container">
    <?php if (!empty($dados)): ?>
        <?php foreach ($dados as $dado): ?>
            <div class="disc-card">
                <div class="disc-header">
                    <strong><?= htmlspecialchars($dado['materia'] ?? '') ?></strong>
                    <span><?= htmlspecialchars($dado['professor'] ?? '') ?></span>
                </div>

                <div class="disc-body">
                    <div class="disc-info">
                        <div>Nota Atual</div>
                        <div><?= htmlspecialchars($dado['nota_atual'] ?? '0') ?></div>

                        <div class="disc-linha"></div>

                        <div>Nota Necessária</div>
                        <div><?= htmlspecialchars($dado['nota_necessaria'] ?? '0') ?></div>

                        <div class="disc-linha"></div>

                        <div>Contatos</div>
                        <div class="disc-contato"><?= htmlspecialchars($dado['contatos'] ?? '—') ?></div>
                    </div>

                    <div class="disc-acoes">
                        <a href="?acao=editar&id=<?= $dado['id'] ?>" class="disc-btn-editar">Editar</a>
                        <a href="?acao=excluir&id=<?= $dado['id'] ?>" class="disc-btn-excluir"
                           onclick="return confirm('Tem certeza?')">Excluir</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="disc-vazio">Nenhuma disciplina cadastrada ainda.</p>
    <?php endif; ?>
</div>