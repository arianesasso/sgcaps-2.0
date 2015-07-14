<?php

function verifyData($patient) {
    $result = array();
    if (empty($patient->person->birthdate)) {
        $result['age'] = $patient->approximate_age . " (aproximada)";
    } else {
        $birthdate = DateTime::createFromFormat("Y-m-d", $patient->person->birthdate->format('Y-m-d'));
        $result['age'] = $birthdate->diff(new DateTime())->format('%Y');
    }

    if ($patient->person->gender == "M") {
        $result['gender'] = 'Masculino';
    } elseif ($patient->person->gender == "F") {
        $result['gender'] = 'Feminino';
    } else {
        $result['gender'] = 'Transsexual';
    }
    return $result;
}
?>

<legend><?= __('Visualizar Pacientes') ?></legend>
<br/>
<div class="row">
    <div class="col-xs-12">
        <table id="data-table" class="table table-striped" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><?= __('Nome') ?></th>
                    <th><?= __('Sexo') ?></th>
                    <th><?= __('CNS') ?></th>
                    <th><?= __('CPF') ?></th>
                    <th><?= __('Idade (anos)') ?></th>
                    <th class="actions"><?= __('Ações') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($patients as $patient):
                    $value = verifyData($patient);
                    ?>
                    <tr>
                        <td><?= h($patient->person->name); ?></td>
                        <td><?= h($value['gender']); ?></td>
                        <td><?= h($patient->cns) ?></td>
                        <td><?= h($patient->person->cpf) ?></td>
                        <td><?= h($value['age']) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('Ver informações'), ['controller' => 'paciente', 'action' => 'visualizar', $patient->id], ['class' => 'btn btn-default']) ?>
                            <?php //echo $this->Form->postLink(($user->active? __('Desativar') : __('Ativar')), ['controller' => 'users', 'action' => 'changeActivation', $user->id, $user->active], ['confirm' => __('Tem certeza que deseja mudar o status do usuário: {0}?', $user->username), 'class' => 'btn btn-default'])  ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>