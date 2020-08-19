<?php $genders = ['F' => 'Femnino', 'M' => 'Masculino', 'T' => 'Transsexual']; ?>

<legend><?= __('Cadastrar Novo Profissional') ?></legend>
<div class="row">
    <div class="col-xs-12">
        <h6>(*) Campos Obrigatórios</h6>
        <?= $this->Form->create($professional, ['class' => 'form-inline']); ?>
        <fieldset>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <div class="form-group some-height">
                        <label class="control-label"><?= __('Nome') ?> *</label>
                        <?php echo $this->Form->input('person.name', ['class' => 'form-control', 'label' => false]); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <div class="form-group some-height">
                        <label class="control-label"><?= __('Gênero') ?> *</label>
                        <?php echo $this->Form->input('person.gender', ['options' => $genders, 'empty' => true, 'class' => 'form-control', 'label' => false]); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <div class="form-group some-height">
                        <label class="control-label"><?= __('Data de Nascimento') ?></label>
                        <?php echo $this->Form->input('person.birthdate', ['id' => 'birthdate', 'type' => 'text', 'class' => 'form-control date-mask', 'placeholder' => 'dd/mm/yyyy', 'label' => false]); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <div class="form-group some-height">
                        <label class="control-label"><?= __('CPF') ?></label>
                        <?php echo $this->Form->input('person.cpf', ['type' => 'text', 'class' => 'form-control cpf-mask', 'label' => false, 'placeholder' => '999.999.999-99']); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <div class="form-group some-height">
                        <label class="control-label"><?= __('RG') ?></label>
                        <?php echo $this->Form->input('person.rg', ['id' => 'rg', 'class' => 'form-control rg-mask', 'label' => false, 'placeholder' => 'Somente números e letras']); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <div class="form-group some-height">
                        <label class="control-label"><?= __('RG - UF') ?></label><span id="mandatory_rg_state"> *</span>
                        <?php echo $this->Form->input('person.rg_state_id', ['id' => 'rg_state_id', 'options' => $states, 'empty' => true, 'class' => 'form-control', 'label' => false]); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="form-group some-height">
                        <label class="control-label"><?php echo __('Ocupação'); ?></label>
                        <span class="not-found"><?php echo "( " . __('Outra') . " " . $this->Form->checkbox('not_found', ['id' => 'not_found']) . " )"; ?></span>
                        <?php echo $this->Form->input('person.occupation_id', ['id' => 'occupations_select', 'options' => $occupations, 'empty' => true, 'class' => 'form-control basic-select', 'label' => false]); ?>
                        <?php echo $this->Form->input('person.occupation_id', ['type' => 'text', 'id' => 'occupations_text', 'class' => 'form-control', 'label' => false, 'disabled']); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="form-group some-height">
                        <label class="control-label"><?= __('Sigla do Conselho') ?></label>
                        <?php echo $this->Form->input('board_acronym', ['class' => 'form-control board-mask', 'label' => false, 'placeholder' => 'Somente letras']); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="form-group some-height">
                        <label class="control-label"><?= __('Número do Conselho') ?></label>
                        <?php echo $this->Form->input('board_number', ['class' => 'form-control board-number-mask', 'label' => false, 'placeholder' => 'Somente números e letras']); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="form-group">
                        <label class="control-label"><?= __('Conselho - UF') ?></label>
                        <?php echo $this->Form->input('board_state_id', ['options' => $states, 'empty' => true, 'class' => 'form-control', 'label' => false, "rows" => "4", "cols" => "70"]); ?>
                    </div>
                </div>
            </div>
            <?= $this->Form->submit(__('Salvar'), ['class' => 'btn btn-success']) ?>
        </fieldset>
    </div>
    <?= $this->Form->end() ?>
</div>