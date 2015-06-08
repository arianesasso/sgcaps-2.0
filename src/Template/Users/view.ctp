<legend><?= __('Visualizar Permissões Válidas') ?></legend>
<div class='row'>
    <div class="col-xs-12">
        <ul class="list-inline gray-frame">
            <li>
                <h4><?= __('Nome') ?></h4>
                <p class="blue-text"><?php echo (!empty($user->person->name) ? h($user->person->name) : h($user->organization->name)); ?></p>
            </li>
            <li>
                <h4><?= __('Cadastro') ?></h4>
                <p class="blue-text"><?= h($user->created->format('d/m/Y')) ?></p>
            </li>
            <li>
                <h4><?= __('Ativo') ?></h4>
                <p class="blue-text"><?= $user->active ? __('Sim') : __('Não'); ?></p>
            </li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <?php if (!empty($permissions)): ?>
            <table cellpadding="0" cellspacing="0" class="table">
                <tr>
                    <th><?= __('Unidade') ?></th>
                    <th><?= __('Papel') ?></th>
                    <th><?= __('Início da Validade') ?></th>
                    <th><?= __('Fim da Validade') ?></th>
                    <th><?= __('Concedente') ?></th>
                    <th class="actions"><?= __('Ações') ?></th>
                </tr>
                <?php foreach ($permissions as $permission): ?>
                    <tr>
                        <td><?= h($permission->organization->name) ?></td>
                        <td><?= h($permission->role->name) ?></td>
                        <td><?= h($permission->beginning->format('d/m/Y')) ?></td>
                        <td><?php
                            if (!is_null($permission->ending)) {
                                echo h($permission->ending->format('d/m/Y'));
                            } else {
                                echo h($permission->ending);
                            }
                            ?></td>
                        <td><?= h($permission->admin->person->name) ?></td>
                        <td class="actions">
                            <?= $user->active? $this->Form->postLink(__('Remover'), ['action' => 'delete', $permission->id], ['class' => 'btn btn-default'], ['confirm' => __('Tem certeza que deseja desativar? # {0}?', $user->username)]) : ''; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</div>
