<legend><?= __('Visualizar Uuários') ?></legend>
<br/>
<div class="row">
    <div class="col-xs-12">
        <table cellpadding="0" cellspacing="0" class="table">
            <thead>
                <tr>
                    <th><?= 'Nome' ?></th>
                    <th><?= $this->Paginator->sort('username', 'Usuário') ?></th>
                    <th><?= $this->Paginator->sort('active', 'Ativo') ?></th>
                    <th><?= $this->Paginator->sort('created', 'Cadastro') ?></th>
                    <th class="actions"><?= __('Ações') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo (!empty($user->person->name) ? h($user->person->name) : h($user->organization->name)); ?></td>
                        <td><?= h($user->username) ?></td>
                        <td><?= $user->active ? __('Sim') : __('Não'); ?></td>
                        <td><?= h($user->created->format('d/m/Y')) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('Permissões'), ['action' => 'view', $user->id], ['class' => 'btn btn-default']) ?>
                            <?= $this->Html->link(__('Editar dados'), ['action' => 'edit', $user->id], ['class' => 'btn btn-default link-ajax']) ?>
                            <?= $this->Form->postLink(__('Desativar'), ['action' => 'delete', $user->id], ['class' => 'btn btn-default link-ajax'], ['confirm' => __('Tem certeza que deseja desativar? # {0}?', $user->username)]) ?>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
            </ul>
            <p><?= $this->Paginator->counter() ?></p>
        </div>
    </div>
</div>
