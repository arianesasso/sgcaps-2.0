<legend><?= __('Adicionar Nova Permissão') ?></legend>
<div class='row'>
    <div class="col-xs-12 gray-frame">
        <?php echo $this->element('user_info', ['user' => $user])?>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-xs-12 col-sm-10 col-md-6 col-lg-4">
        <?= $this->Form->create($permission); ?>
        <fieldset>
            <?php if ($user_type === 'people') { ?>
                <div class="form-group" >
                    <label class="control-label"><?= __('Unidade:') ?> *</label>
                    <?php
                    echo $this->Form->input(
                            'organization_id', ['options' => $organizations, 'class' => 'form-control', 'label' => false, 'empty' => true]);
                    ?>
                </div>
            <?php } else {
                echo $this->Form->input('organization_id', ['type' => 'hidden', 'value' => $organization_id]);
            } ?>
                <div class="form-group" >
                    <label class="control-label"><?= __('Papel:') ?> *</label>
    <?php echo $this->Form->input('role_id', ['options' => $roles, 'class' => 'form-control', 'label' => false, 'empty' => true]); ?>
                </div>
                <div class="form-group" >
                    <label class="control-label"><?= __('Início da Validade:') ?> *</label>
                    <?php
                    echo $this->Form->input('beginning', ['type' => 'date',
                        'minYear' => date('Y'),
                        'maxYear' => date('Y') + 5,
                        'class' => 'form-control',
                        'label' => false,
                        'default' => date('Y-m-d')]);
                    ?>
                </div>
                <div class="form-group" >
                    <label class="control-label"><?= __('Fim da Validade:') ?></label>
                    <?php
                    echo $this->Form->input('ending', ['type' => 'date',
                        'minYear' => date('Y'),
                        'maxYear' => date('Y') + 5,
                        'class' => 'form-control',
                        'label' => false,
                        'default' => date('Y-m-d', strtotime('+5 years'))]);
                    ?>
                </div>
                <?php echo $this->Form->input('user_id', ['type' => 'hidden', 'value' => $user->id]); ?>
            <?php echo $this->Form->input('admin_id', ['type' => 'hidden', 'value' => $this->request->session()->read('Auth.User.id')]); ?>
            </fieldset>
            <?= $this->Form->submit(__('Salvar'), ['class' => 'btn btn-success']) ?>
    <?= $this->Form->end() ?>
    </div>
</div>
