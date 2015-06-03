<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Person'), ['action' => 'edit', $person->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Person'), ['action' => 'delete', $person->id], ['confirm' => __('Are you sure you want to delete # {0}?', $person->id)]) ?> </li>
        <li><?= $this->Html->link(__('List People'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Person'), ['action' => 'add']) ?> </li>
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
<div class="people view large-10 medium-9 columns">
    <h2><?= h($person->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('User') ?></h6>
            <p><?= $person->has('user') ? $this->Html->link($person->user->id, ['controller' => 'Users', 'action' => 'view', $person->user->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($person->name) ?></p>
            <h6 class="subheader"><?= __('Gender') ?></h6>
            <p><?= h($person->gender) ?></p>
            <h6 class="subheader"><?= __('Rg') ?></h6>
            <p><?= h($person->rg) ?></p>
            <h6 class="subheader"><?= __('State') ?></h6>
            <p><?= $person->has('state') ? $this->Html->link($person->state->name, ['controller' => 'States', 'action' => 'view', $person->state->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Occupation') ?></h6>
            <p><?= h($person->occupation) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($person->id) ?></p>
            <h6 class="subheader"><?= __('Cpf') ?></h6>
            <p><?= $this->Number->format($person->cpf) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Birthdate') ?></h6>
            <p><?= h($person->birthdate) ?></p>
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($person->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($person->modified) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Addresses') ?></h4>
    <?php if (!empty($person->addresses)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('City Id') ?></th>
            <th><?= __('Purpose') ?></th>
            <th><?= __('Street') ?></th>
            <th><?= __('Number') ?></th>
            <th><?= __('District') ?></th>
            <th><?= __('Cep') ?></th>
            <th><?= __('Complement') ?></th>
            <th><?= __('Observation') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th><?= __('Person Id') ?></th>
            <th><?= __('Organization Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($person->addresses as $addresses): ?>
        <tr>
            <td><?= h($addresses->id) ?></td>
            <td><?= h($addresses->city_id) ?></td>
            <td><?= h($addresses->purpose) ?></td>
            <td><?= h($addresses->street) ?></td>
            <td><?= h($addresses->number) ?></td>
            <td><?= h($addresses->district) ?></td>
            <td><?= h($addresses->cep) ?></td>
            <td><?= h($addresses->complement) ?></td>
            <td><?= h($addresses->observation) ?></td>
            <td><?= h($addresses->created) ?></td>
            <td><?= h($addresses->modified) ?></td>
            <td><?= h($addresses->person_id) ?></td>
            <td><?= h($addresses->organization_id) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Addresses', 'action' => 'view', $addresses->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Addresses', 'action' => 'edit', $addresses->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Addresses', 'action' => 'delete', $addresses->id], ['confirm' => __('Are you sure you want to delete # {0}?', $addresses->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Contacts') ?></h4>
    <?php if (!empty($person->contacts)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Contact Type') ?></th>
            <th><?= __('Value') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th><?= __('Person Id') ?></th>
            <th><?= __('Organization Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($person->contacts as $contacts): ?>
        <tr>
            <td><?= h($contacts->id) ?></td>
            <td><?= h($contacts->contact_type) ?></td>
            <td><?= h($contacts->value) ?></td>
            <td><?= h($contacts->created) ?></td>
            <td><?= h($contacts->modified) ?></td>
            <td><?= h($contacts->person_id) ?></td>
            <td><?= h($contacts->organization_id) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Contacts', 'action' => 'view', $contacts->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Contacts', 'action' => 'edit', $contacts->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Contacts', 'action' => 'delete', $contacts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contacts->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Patients') ?></h4>
    <?php if (!empty($person->patients)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Person Id') ?></th>
            <th><?= __('Cns') ?></th>
            <th><?= __('Marital Status') ?></th>
            <th><?= __('Approximate Age') ?></th>
            <th><?= __('Ethnicity') ?></th>
            <th><?= __('Observation') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($person->patients as $patients): ?>
        <tr>
            <td><?= h($patients->id) ?></td>
            <td><?= h($patients->person_id) ?></td>
            <td><?= h($patients->cns) ?></td>
            <td><?= h($patients->marital_status) ?></td>
            <td><?= h($patients->approximate_age) ?></td>
            <td><?= h($patients->ethnicity) ?></td>
            <td><?= h($patients->observation) ?></td>
            <td><?= h($patients->created) ?></td>
            <td><?= h($patients->modified) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Patients', 'action' => 'view', $patients->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Patients', 'action' => 'edit', $patients->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Patients', 'action' => 'delete', $patients->id], ['confirm' => __('Are you sure you want to delete # {0}?', $patients->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Professionals') ?></h4>
    <?php if (!empty($person->professionals)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Person Id') ?></th>
            <th><?= __('Board Acronym') ?></th>
            <th><?= __('Board Number') ?></th>
            <th><?= __('Board State Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($person->professionals as $professionals): ?>
        <tr>
            <td><?= h($professionals->id) ?></td>
            <td><?= h($professionals->person_id) ?></td>
            <td><?= h($professionals->board_acronym) ?></td>
            <td><?= h($professionals->board_number) ?></td>
            <td><?= h($professionals->board_state_id) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Professionals', 'action' => 'view', $professionals->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Professionals', 'action' => 'edit', $professionals->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Professionals', 'action' => 'delete', $professionals->id], ['confirm' => __('Are you sure you want to delete # {0}?', $professionals->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
