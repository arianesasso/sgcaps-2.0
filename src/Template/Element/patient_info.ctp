<?php
if (empty($patient->person->birthdate)) {
    $age = $patient->approximate_age . " ANOS (aproximada)";
} else {
    $birthdate = DateTime::createFromFormat("Y-m-d", $patient->person->birthdate->format('Y-m-d'));
    $age = $birthdate->diff(new DateTime())->format('%Y') . " ANOS";
}

if ($patient->person->gender == "M") {
    $gender = 'MASCULINO';
} elseif ($patient->person->gender == "F") {
    $gender = 'FEMININO';
} else {
    $gender = 'TRANSSEXUAL';
}
?>

<ul class="list-inline">
    <li>
        <h4><?= __('Nome') ?></h4>
        <p class="blue-text white-box"><?php echo $patient->person->name; ?></p>
    </li>
    <li>
        <h4><?= __('CNS') ?></h4>
        <p class="blue-text white-box"><?php echo empty($patient->cns) ? __('NÃO DISPONÍVEL') : $patient->cns; ?></p>
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