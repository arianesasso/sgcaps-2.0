<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Patient'), ['action' => 'edit', $patient->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Patient'), ['action' => 'delete', $patient->id], ['confirm' => __('Are you sure you want to delete # {0}?', $patient->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Patients'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Patient'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List People'), ['controller' => 'People', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Person'), ['controller' => 'People', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="patients view large-10 medium-9 columns">
    <h2><?= h($patient->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Person') ?></h6>
            <p><?= $patient->has('person') ? $this->Html->link($patient->person->name, ['controller' => 'People', 'action' => 'view', $patient->person->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Cns') ?></h6>
            <p><?= h($patient->cns) ?></p>
            <h6 class="subheader"><?= __('Marital Status') ?></h6>
            <p><?= h($patient->marital_status) ?></p>
            <h6 class="subheader"><?= __('Ethnicity') ?></h6>
            <p><?= h($patient->ethnicity) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($patient->id) ?></p>
            <h6 class="subheader"><?= __('Approximate Age') ?></h6>
            <p><?= $this->Number->format($patient->approximate_age) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($patient->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($patient->modified) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Observation') ?></h6>
            <?= $this->Text->autoParagraph(h($patient->observation)); ?>

        </div>
    </div>
</div>
