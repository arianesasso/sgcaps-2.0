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