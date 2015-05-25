<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $permission->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $permission->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Permissions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Organizations'), ['controller' => 'Organizations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Organization'), ['controller' => 'Organizations', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="permissions form large-10 medium-9 columns">
    <?= $this->Form->create($permission); ?>
    <fieldset>
        <legend><?= __('Edit Permission') ?></legend>
        <?php
            echo $this->Form->input('user_id');
            echo $this->Form->input('organization_id', ['options' => $organizations]);
            echo $this->Form->input('role_id', ['options' => $roles]);
            echo $this->Form->input('beginning');
            echo $this->Form->input('ending');
            echo $this->Form->input('admin_id', ['options' => $users]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
