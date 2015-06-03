<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Professional'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List People'), ['controller' => 'People', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Person'), ['controller' => 'People', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List States'), ['controller' => 'States', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New State'), ['controller' => 'States', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="professionals index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('person_id') ?></th>
            <th><?= $this->Paginator->sort('board_acronym') ?></th>
            <th><?= $this->Paginator->sort('board_number') ?></th>
            <th><?= $this->Paginator->sort('board_state_id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($professionals as $professional): ?>
        <tr>
            <td><?= $this->Number->format($professional->id) ?></td>
            <td>
                <?= $professional->has('person') ? $this->Html->link($professional->person->name, ['controller' => 'People', 'action' => 'view', $professional->person->id]) : '' ?>
            </td>
            <td><?= h($professional->board_acronym) ?></td>
            <td><?= h($professional->board_number) ?></td>
            <td>
                <?= $professional->has('state') ? $this->Html->link($professional->state->name, ['controller' => 'States', 'action' => 'view', $professional->state->id]) : '' ?>
            </td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $professional->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $professional->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $professional->id], ['confirm' => __('Are you sure you want to delete # {0}?', $professional->id)]) ?>
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
