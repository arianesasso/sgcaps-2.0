<?php
if (empty($patient->person->birthdate)) {
    $age = $patient->approximate_age . " anos (aproximada)";
} else {
    $birthdate = DateTime::createFromFormat("Y-m-d", $patient->person->birthdate->format('Y-m-d'));
    $age = $birthdate->diff(new DateTime())->format('%Y') . " anos";
}

if ($patient->person->gender == "M") {
    $gender = 'Masculino';
} elseif ($patient->person->gender == "F") {
    $gender = 'Feminino';
} else {
    $gender = 'Transsexual';
}
?>

<ul class="list-inline">
    <li>
        <h4><?= __('Nome') ?></h4>
        <p class="blue-text white-box"><?php echo $patient->person->name; ?></p>
    </li>
    <li>
        <h4><?= __('CNS') ?></h4>
        <p class="blue-text white-box"><?php echo empty($patient->cns) ? 'Não disponível' : $patient->cns; ?></p>
    </li>
    <li>
        <h4><?= __('Sexo') ?></h4>
        <p class="blue-text white-box"><?= h($gender) ?></p>
    </li>
    <li>
        <h4><?= __('Idade') ?></h4>
        <p class="blue-text white-box"><?php echo $age; ?></p>
    </li>
</ul>