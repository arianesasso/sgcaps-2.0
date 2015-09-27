<legend><?= __('Visualizar Ações') ?></legend>
<br/>
<div class="row">
    <div class="col-xs-12">
        <table id="data-table" class="table table-striped" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><?= __('Nome') ?></th>
                    <th><?= __('Alias') ?></th>
                    <th><?= __('Controller') ?></th>
                    <th><?= __('Action') ?></th>
                    <th><?= __('Data de Cadastro') ?></th>
                    <th class="actions"><?= __('Ações') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($actions as $action): ?>
                    <tr>
                        <td><?= h($action->name); ?></td>
                        <td><?= h($action->alias) ?></td>
                        <td><?= h($action->controller) ?></td>
                        <td><?= h($action->action) ?></td>
                        <td><?= h($action->created->format('d/m/Y')) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('Editar'), ['controller' => 'acao', 'action' => 'editar', $action->id], ['class' => 'btn btn-default']) ?>
                            <?= $this->Form->postLink(__('Apagar'), ['action' => 'delete', $action->id], ['class' => 'btn btn-default', 'confirm' => __('Tem certeza que deseja apagar # {0}?', $action->alias)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>