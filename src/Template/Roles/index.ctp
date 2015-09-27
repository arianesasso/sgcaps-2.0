<legend><?= __('Visualizar Papéis') ?></legend>
<br/>
<div class="row">
    <div class="col-xs-12">
        <table id="data-table" class="table table-striped" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><?= __('Nome') ?></th>
                    <th><?= __('Alias') ?></th>
                    <th><?= __('Domínio') ?></th>
                    <th><?= __('Data de Cadastro') ?></th>
                    <th class="actions"><?= __('Ações') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($roles as $role): ?>
                    <tr>
                        <td><?= h($role->name); ?></td>
                        <td><?= h($role->alias) ?></td>
                        <td><?= h($role->domain) ?></td>
                        <td><?= h($role->created->format('d/m/Y')) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('Editar'), ['controller' => 'papel', 'action' => 'editar', $role->id], ['class' => 'btn btn-default']) ?>
                            <?= $this->Form->postLink(__('Apagar'), ['action' => 'delete', $role->id], ['class' => 'btn btn-default', 'confirm' => __('Tem certeza que deseja apagar # {0}?', $role->alias)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>