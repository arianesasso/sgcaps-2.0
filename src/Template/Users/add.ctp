<div class="col-xs-12 col-md-6 col-sm-8" style='margin-top: 20px'>
    <?= $this->Form->create($user); ?>
    <fieldset>
        <legend><?= __('Cadastrar Novo Usuário') ?></legend>    
        <div class="form-group">
            <label class="control-label"><?= __('Nome de Usuário') ?></label>
            <?php echo $this->Form->input('username', ['class' => 'form-control', 'label' => false]); ?>
        </div>
        <div class="form-group">
            <label class="control-label"><?= __('Senha') ?></label>
            <?php echo $this->Form->input('password', ['class' => 'form-control', 'label' => false]); ?>
        </div>
        <?php echo $this->Form->input('user_id', ['type' => 'hidden', 'value' => '1']);
        ?>
    </fieldset>
    <?= $this->Form->submit(__('Salvar'), ['class' => 'btn btn-success']) ?>
    <?= $this->Form->end() ?>
</div>
