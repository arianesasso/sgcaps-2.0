<legend><?= __('Visualizar Usuários') ?></legend>
<br/>
<div class="row">
    <div class="col-xs-12">
        <table id="data-table" class="table table-striped" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><?= __('Nome') ?></th>
                    <th><?= __('Usuário') ?></th>
                    <th><?= __('Ativo') ?></th>
                    <th><?= __('Cadastro') ?></th>
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
                            <?= $this->Html->link(__('Permissões'), ['controller' => 'usuario' , 'action' => 'visualizar', $user->id], ['class' => 'btn btn-default']) ?>
                            <?= $this->Html->link(__('Editar dados'), ['action' => 'edit', $user->id], ['class' => 'btn btn-default']) ?>
                            <?= $this->Form->postLink(($user->active? __('Desativar') : __('Ativar')), ['controller' => 'users', 'action' => 'changeActivation', $user->id, $user->active], ['confirm' => __('Tem certeza que deseja mudar o status do usuário: {0}?', $user->username), 'class' => 'btn btn-default']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>