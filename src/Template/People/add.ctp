<legend><?= __('Cadastrar Novo Paciente') ?></legend>
<div class="row">
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
        <?= $this->Form->create($person, ['class' => 'form-inline']); ?>
        <fieldset>      
            <div class="form-group">
                <label class="control-label"><?= __('Nome') ?> *</label>
                <?php echo $this->Form->input('name', ['class' => 'form-control', 'label' => false]); ?>
            </div>
            <div class="form-group">
                <label class="control-label"><?= __('Gênero') ?> *</label>
                <?php echo $this->Form->input('gender', ['options' => ['F' => 'Femnino', 'M' => 'Masculino'],
                                                         'empty' => true,
                                                         'class' => 'form-control', 'label' => false]); ?>
            </div>
            <div class="form-group">
                <label class="control-label"><?= __('Data de Nascimento') ?></label>
                <?php echo $this->Form->input('birthdate', ['id' => 'birthdate', 'type' => 'text', 'class' => 'form-control', 'label' => false]); ?>
            </div>
            <div class="form-group">
                <label class="control-label"><?= __('CPF') ?></label>
                <?php echo $this->Form->input('cpf', ['class' => 'form-control', 'label' => false]); ?>
            </div>
            <div class="form-group">
                <label class="control-label"><?= __('RG') ?></label>
                <?php echo $this->Form->input('rg', ['class' => 'form-control', 'label' => false]); ?>
            </div>
            <div class="form-group">
                <label class="control-label"><?= __('RG - UF') ?></label>
                <?php echo $this->Form->input('rg_state_id', ['options' => $states, 'empty' => true, 'class' => 'form-control', 'label' => false]); ?>
            </div>
            <div class="form-group">
                <label class="control-label"><?= __('Ocupacão') ?></label>
                <?php echo $this->Form->input('occupation', ['class' => 'form-control', 'label' => false]); ?>
            </div>
        </fieldset>
        <?= $this->Form->submit(__('Salvar'), ['class' => 'btn btn-success']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
