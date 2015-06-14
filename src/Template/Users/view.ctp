<legend><?= __('Visualizar Permissões Válidas') ?></legend>
<div class='row'>
    <div class="col-xs-12 gray-frame">
        <div clas="row">
            <div class="col-xs-8">
                <ul class="list-inline" style="display: inline-block">
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
            <div class="col-xs-4 action-bar">
                <a href="<?= $this->Url->build(["controller" => "permissao", "action" => "adicionar", $user->id, ($user->person ? 'people' : 'organizations'), ($user->organization ? $user->organization->id : false)]) ?>" class="btn btn-success action-button">
                    <i class="fa fa-plus-square"></i> Nova permissão
                </a>
                <a href="#" class="btn btn-success action-button">
                    <i class="fa fa-clock-o"></i> Histórico
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <br/>
        <?php if (!empty($permissions)): ?>
            <table id="data-table" cellpadding="0" cellspacing="0" class="table table-striped">
                <thead>
                    <tr>
                        <th><?= __('Unidade') ?></th>
                        <th><?= __('Papel') ?></th>
                        <th><?= __('Início da Validade') ?></th>
                        <th><?= __('Fim da Validade') ?></th>
                        <th><?= __('Concedente') ?></th>
                        <th class="actions"><?= __('Ações') ?></th>
                    </tr>
                </thead>
                <tbody>
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
                                <?= $user->active ? $this->Form->postLink(__('Remover'), ['action' => 'delete', $permission->id], ['class' => 'btn btn-default'], ['confirm' => __('Tem certeza que deseja desativar? # {0}?', $user->username)]) : ''; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
