<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Patient'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List People'), ['controller' => 'People', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Person'), ['controller' => 'People', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="patients index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('person_id') ?></th>
            <th><?= $this->Paginator->sort('cns') ?></th>
            <th><?= $this->Paginator->sort('marital_status') ?></th>
            <th><?= $this->Paginator->sort('approximate_age') ?></th>
            <th><?= $this->Paginator->sort('ethnicity') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($patients as $patient): ?>
        <tr>
            <td><?= $this->Number->format($patient->id) ?></td>
            <td>
                <?= $patient->has('person') ? $this->Html->link($patient->person->name, ['controller' => 'People', 'action' => 'view', $patient->person->id]) : '' ?>
            </td>
            <td><?= h($patient->cns) ?></td>
            <td><?= h($patient->marital_status) ?></td>
            <td><?= $this->Number->format($patient->approximate_age) ?></td>
            <td><?= h($patient->ethnicity) ?></td>
            <td><?= h($patient->created) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $patient->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $patient->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $patient->id], ['confirm' => __('Are you sure you want to delete # {0}?', $patient->id)]) ?>
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
