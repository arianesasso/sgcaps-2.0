<?= $this->Form->create($user); ?>
<legend><?= __('Cadastrar Novo Usuário') ?></legend>
<div class="row"> 
    <div class="col-xs-12 col-sm-10 col-md-6 col-lg-4">     
        <fieldset>
            <br/>
            <div class="form-group">
                <label class="control-label"><?= __('Nome de Usuário') ?> *</label>
                <?php echo $this->Form->input('username', ['class' => 'form-control', 'label' => false, 'required' => 'required']); ?>
            </div>
            <div class="form-group">
                <label class="control-label"><?= __('Senha') ?> *</label>
                <?php echo $this->Form->input('password', ['class' => 'form-control', 'label' => false, 'required' => 'required']); ?>
            </div>
            <?php echo $this->Form->input('user_id', ['type' => 'hidden', 'value' => '1']);
            ?>
        </fieldset>
        <?= $this->Form->submit(__('Salvar'), ['class' => 'btn btn-success send-data inline-block']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>