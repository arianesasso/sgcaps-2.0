<legend><?= __('Visualizar Permissões') ?></legend>
<div class='row-fluid'>
    <div class="col-xs-12">
        <ul class="list-inline">
            <li>
                <h4><?= __('Usuário') ?></h4>
                <p><?= h($user->username) ?></p>
            </li>
            <li>
                <h4><?= __('Data de criação') ?></h4>
                <p><?= h($user->created) ?></p>
            </li>
            <li>
                <h4><?= __('Ativo') ?></h4>
                <p><?= $user->active ? __('Sim') : __('Não'); ?></p>
            </li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <?php if (!empty($user->permissions)): ?>
            <table cellpadding="0" cellspacing="0" class="table">
                <tr>
                    <th><?= __('Unidade') ?></th>
                    <th><?= __('Papel') ?></th>
                    <th><?= __('Início da Validade') ?></th>
                    <th><?= __('Fim da Validade') ?></th>
                    <th><?= __('Concedente') ?></th>
                    <th class="actions"><?= __('Ações') ?></th>
                </tr>
                <?php foreach ($user->permissions as $permissions): ?>
                    <tr>
                        <td><?= h($permissions->organization_id) ?></td>
                        <td><?= h($permissions->role_id) ?></td>
                        <td><?= h($permissions->beginning) ?></td>
                        <td><?= h($permissions->ending) ?></td>
                        <td><?= h($permissions->admin_id) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Permissions', 'action' => 'view', $permissions->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Permissions', 'action' => 'edit', $permissions->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Permissions', 'action' => 'delete', $permissions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $permissions->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</div>
