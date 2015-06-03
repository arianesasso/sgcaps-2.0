<label class="control-label"><?= __('Escolha um profissional: ') ?> *</label>
<ul class="list-inline">
    <li>
        <?php
        echo $this->Form->input('professional_id', ['options' => $professionals, 'empty' => true,
            'label' => false,
            'class' => 'form-control',
            'required' => true]);
        ?>
    </li>
    <li>
        <a href="#">
            <i class="fa fa-plus-square txt-success" data-toggle="tooltip" data-placement="right" title="Clique para adicionar um novo profissional"></i>
        </a>
    </li>
</ul>

