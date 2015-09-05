<?php
$people = null;
foreach($professionals as $professional) :
    foreach($professional->_matchingData as $p):
        $people[$p->id] = $p->name;
    endforeach;
endforeach;
?>

<label class="control-label"><?= __('Escolha um profissional') ?> *</label>
<ul class="list-inline">
    <li>
        <?php
        echo $this->Form->input('person_id', ['options' => $people, 'empty' => true,
            'label' => false,
            'class' => 'form-control',
            'required' => true]);
        ?>
    </li>
    <li>
        <a href="<?php echo $this->Url->build(["controller" => "profissional", 
                                               "action" => "cadastrar"]); ?>">
            <i class="fa fa-plus-square txt-success" data-toggle="tooltip" data-placement="right" title="Clique para adicionar um novo profissional"></i>
        </a>
    </li>
</ul>

