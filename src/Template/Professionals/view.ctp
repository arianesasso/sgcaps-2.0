<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Professional'), ['action' => 'edit', $professional->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Professional'), ['action' => 'delete', $professional->id], ['confirm' => __('Are you sure you want to delete # {0}?', $professional->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Professionals'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Professional'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List People'), ['controller' => 'People', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Person'), ['controller' => 'People', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List States'), ['controller' => 'States', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New State'), ['controller' => 'States', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="professionals view large-10 medium-9 columns">
    <h2><?= h($professional->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Person') ?></h6>
            <p><?= $professional->has('person') ? $this->Html->link($professional->person->name, ['controller' => 'People', 'action' => 'view', $professional->person->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Board Acronym') ?></h6>
            <p><?= h($professional->board_acronym) ?></p>
            <h6 class="subheader"><?= __('Board Number') ?></h6>
            <p><?= h($professional->board_number) ?></p>
            <h6 class="subheader"><?= __('State') ?></h6>
            <p><?= $professional->has('state') ? $this->Html->link($professional->state->name, ['controller' => 'States', 'action' => 'view', $professional->state->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($professional->id) ?></p>
        </div>
    </div>
</div>
