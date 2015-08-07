<legend><?= __('Visualizar Profissionais') ?></legend>
<br/>
<div class="row">
    <div class="col-xs-12">
        <table id="data-table" class="table table-striped" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><?= __('Nome') ?></th>
                    <th><?= __('CPF') ?></th>
                    <th><?= __('Conselho') ?></th>
                    <th><?= __('Nro/UF do Conselho') ?></th>
                    <th class="actions"><?= __('Ações') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($professionals as $professional): ?>
                    <tr>
                        <td><?= h($professional->person->name); ?></td>
                        <td><?= h($professional->person->cpf) ?></td>
                        <td><?= empty($professional->board_acronym) ? "Não disponível" : h($professional->board_acronym) ?></td>
                        <td><?= empty($professional->board_number) ? "Não disponível" : h($professional->board_number) . ' - ' . $professional->state->acronym ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('Ver informações'), ['controller' => 'profissional', 'action' => 'visualizar', $professional->id], ['class' => 'btn btn-default']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>