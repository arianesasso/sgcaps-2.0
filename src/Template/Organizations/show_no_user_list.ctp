<label class="control-label"><?= __('Escolha uma unidade: ') ?> *</label>
<ul class="list-inline">
    <li>
        <?php
        echo $this->Form->input('organization_id', ['options' => $organizations,
                                'empty' => true,
                                'label' => false,
                                'class' => 'form-control',
                                'required' => true]);
        ?>
    </li>
    <li>
        <a href="#">
            <i class="fa fa-plus-square txt-success"></i>
        </a>
    </li>
</ul>
