<legend><?= __('Cadastrar Novo Paciente') ?></legend>
<div class="row">
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
        <?= $this->Form->create($patient, ['class' => 'form-inline']); ?>
        <fieldset>  
            <div class="form-group some-height">
                <label class="control-label"><?= __('Nome') ?> *</label>
                <?php echo $this->Form->input('person.name', ['class' => 'form-control', 'label' => false]); ?>
            </div>
            <div class="form-group some-height">
                <label class="control-label"><?= __('Gênero') ?> *</label>
                <?php echo $this->Form->input('person.gender', ['options' => ['F' => 'Femnino', 'M' => 'Masculino'], 'class' => 'form-control', 'label' => false]); ?>
            </div>
            <div class="form-group some-height">
                <label class="control-label"><?= __('Data de Nascimento') ?></label>
                <?php echo $this->Form->input('person.birthdate', ['id' => 'birthdate', 'type' => 'text', 'class' => 'form-control date-mask', 'placeholder' => 'dd/mm/yyyy', 'label' => false]); ?>
            </div>
            <div class="form-group some-height">
                <label class="control-label"><?= __('Idade aproximada') ?></label>
                <?php echo $this->Form->input('approximate_age', ['class' => 'form-control', 'label' => false, 'max' => 150, 'min' => '1']); ?>
            </div>
            <div class="form-group some-height">
                <label class="control-label"><?= __('CPF') ?></label>
                <?php echo $this->Form->input('person.cpf', ['type' => 'text', 'class' => 'form-control cpf-mask', 'label' => false, 'placeholder' => '999.999.999-99']); ?>
            </div>
            <div class="form-group some-height">
                <label class="control-label"><?= __('CNS') ?></label>
                <?php echo $this->Form->input('cns', ['class' => 'form-control', 'label' => false]); ?>
            </div>
            <div class="form-group some-height">
                <label class="control-label"><?= __('RG') ?></label>
                <?php echo $this->Form->input('person.rg', ['class' => 'form-control', 'label' => false]); ?>
            </div>
            <div class="form-group some-height">
                <label class="control-label"><?= __('RG - UF') ?></label>
                <?php echo $this->Form->input('person.rg_state_id', ['options' => $states, 'empty' => true, 'class' => 'form-control', 'label' => false]); ?>
            </div>
            <div class="form-group some-height">
                <label class="control-label"><?= __('Ocupação') ?></label>
                <?php echo $this->Form->input('person.occupation', ['class' => 'form-control', 'label' => false]); ?>
            </div>
            <div class="form-group some-height">
                <label class="control-label"><?= __('Estado Civil') ?></label>
                <?php echo $this->Form->input('marital_status', ['options' => ["solteiro" => "Solteiro", "casado" => "Casado", "viuvo" => "Viúvo"], 'empty' => true, 'class' => 'form-control', 'label' => false]); ?>
            </div>
            <div class="form-group some-height">
                <label class="control-label"><?= __('Etnia') ?></label>
                <?php echo $this->Form->input('ethnicity', ['options' => ["branco" => "Branco", "pardo" => "Pardo", "negro" => "Negro"], 'empty' => true, 'class' => 'form-control', 'label' => false]); ?>
            </div>
            <div class="form-group">
                <label class="control-label"><?= __('Observação') ?></label>
                <?php echo $this->Form->input('observation', ['class' => 'form-control', 'label' => false, "rows" => "4", "cols" => "70"]); ?>
            </div>
        </fieldset>
        <?= $this->Form->submit(__('Salvar'), ['class' => 'btn btn-success']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
