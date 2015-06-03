<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Person'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List States'), ['controller' => 'States', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New State'), ['controller' => 'States', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Addresses'), ['controller' => 'Addresses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Address'), ['controller' => 'Addresses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Patients'), ['controller' => 'Patients', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Patient'), ['controller' => 'Patients', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Professionals'), ['controller' => 'Professionals', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Professional'), ['controller' => 'Professionals', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="people index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('user_id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('gender') ?></th>
            <th><?= $this->Paginator->sort('cpf') ?></th>
            <th><?= $this->Paginator->sort('rg') ?></th>
            <th><?= $this->Paginator->sort('rg_state_id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($people as $person): ?>
        <tr>
            <td><?= $this->Number->format($person->id) ?></td>
            <td>
                <?= $person->has('user') ? $this->Html->link($person->user->id, ['controller' => 'Users', 'action' => 'view', $person->user->id]) : '' ?>
            </td>
            <td><?= h($person->name) ?></td>
            <td><?= h($person->gender) ?></td>
            <td><?= $this->Number->format($person->cpf) ?></td>
            <td><?= h($person->rg) ?></td>
            <td>
                <?= $person->has('state') ? $this->Html->link($person->state->name, ['controller' => 'States', 'action' => 'view', $person->state->id]) : '' ?>
            </td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $person->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $person->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $person->id], ['confirm' => __('Are you sure you want to delete # {0}?', $person->id)]) ?>
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
