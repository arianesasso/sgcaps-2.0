<legend><?= __('Editar informações do Usuário') ?></legend>
<?php echo $this->Form->create($user); ?>
<div class="row">
    <div class="col-xs-12 col-sm-10 col-md-6 col-lg-4">
        <fieldset>
            <br/>
            <div class="form-group" name="username_div">
                <label class="control-label"><?= __('Nome de Usuário') ?></label>
                <?php echo $this->Form->input('username', ['class' => 'form-control', 'label' => false]); ?>
            </div>
            <div class="form-group" name="password_div">
                <label class="control-label"><?= __('Senha') ?></label>
                <?php echo $this->Form->input('password', ['class' => 'form-control', 'label' => false]); ?>
            </div>
        </fieldset>
        <?= $this->Form->submit(__('Salvar'), ['class' => 'btn btn-success']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>