<legend><?= __('Cadastrar Novo Usuário') ?></legend>
<?= $this->Form->create($user); ?>
<div class="row">
    <div class="col-xs-12 col-sm-10 col-md-6 col-lg-4">
        <h6>(*) Campos Obrigatórios</h6>
        <fieldset>
            <br/>
            <div class="form-group" name="username_div">
                <label class="control-label"><?= __('Nome de Usuário') ?> *</label>
                <?php echo $this->Form->input('username', ['class' => 'form-control', 'label' => false]); ?>
            </div>
            <div class="form-group" name="password_div">
                <label class="control-label"><?= __('Senha') ?> *</label>
                <?php echo $this->Form->input('password', ['class' => 'form-control', 'label' => false]); ?>
            </div>
            <div class="form-group" name="retype_password_div">
                <label class="control-label"><?= __('Digita a senha novamente') ?> *</label>
                <?php echo $this->Form->input('retype_password', ['type' => 'password', 'class' => 'form-control', 'label' => false]); ?>
            </div>
            <div class="form-group" name="user_type_div">
                <?php
                echo $this->Form->radio('user_type', 
                    [
                        ['value' => 'professional', 'text' => 'Profissional', 'class' => 'load-professionals', 'checked' => 'checked'],
                        ['value' => 'organization', 'text' => 'Unidade', 'class' => 'load-organizations'],
                    ]
                );
                ?>
            </div>
            <div class="form-group users-list" name="users_list_div"></div>
            <?php echo $this->Form->input('admin_id', ['type' => 'hidden', 'value' => $this->request->session()->read('Auth.User.id')]); ?>
        </fieldset>
        <?= $this->Form->submit(__('Salvar'), ['class' => 'btn btn-success']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>