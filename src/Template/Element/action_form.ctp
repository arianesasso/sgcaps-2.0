<?php echo $this->Form->create($action); ?>
<div class="row">
    <div class="col-xs-12 col-sm-10 col-md-6 col-lg-4">
        <fieldset>
            <br/>
            <div class="form-group">
                <label class="control-label"><?= __('Nome da Acão') ?> *</label>
                <?php echo $this->Form->input('name', ['class' => 'form-control', 'label' => false]); ?>
            </div>
            <div class="form-group">
                <label class="control-label"><?= __('Controller') ?> *</label>
                <?php echo $this->Form->input('controller', ['class' => 'form-control', 'label' => false]); ?>
            </div>
            <div class="form-group">
                <label class="control-label"><?= __('Action') ?> *</label>
                <?php echo $this->Form->input('action', ['class' => 'form-control', 'label' => false]); ?>
            </div>
            <div class="form-group">
                <label class="control-label"><?= __('Vincular a papéis') ?> *</label>
                <?php echo $this->Form->input('roles._ids', ['options' => $roles, 'class' => 'form-control', 'label' => false]); ?>
            </div>
        </fieldset>
        <?= $this->Form->submit(__('Salvar'), ['class' => 'btn btn-success']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>