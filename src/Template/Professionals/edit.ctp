<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $professional->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $professional->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Professionals'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List People'), ['controller' => 'People', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Person'), ['controller' => 'People', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List States'), ['controller' => 'States', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New State'), ['controller' => 'States', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="professionals form large-10 medium-9 columns">
    <?= $this->Form->create($professional); ?>
    <fieldset>
        <legend><?= __('Edit Professional') ?></legend>
        <?php
            echo $this->Form->input('person_id', ['options' => $people]);
            echo $this->Form->input('board_acronym');
            echo $this->Form->input('board_number');
            echo $this->Form->input('board_state_id', ['options' => $states, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
