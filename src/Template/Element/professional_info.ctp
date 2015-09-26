<?php
if ($professional->person->gender == "M") {
    $gender = 'MASCULINO';
} elseif ($professional->person->gender == "F") {
    $gender = 'FEMININO';
} else {
    $gender = 'TRANSSEXUAL';
}
?>

<ul class="list-inline">
    <li>
        <h4><?= __('Nome') ?></h4>
        <p class="blue-text white-box"><?php echo $professional->person->name; ?></p>
    </li>
    <li>
        <h4><?= __('Sexo') ?></h4>
        <p class="blue-text white-box"><?= h($gender) ?></p>
    </li>
</ul>