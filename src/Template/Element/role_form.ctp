<?php
    $domains = ['sistema' => 'Sistema', 'caps' => 'Caps', 'sisam' => 'Sisam', 'ubs' => 'UBS', 'residencia_terapeutica' => 'Residência Terapêutica'];
?>
<?php echo $this->Form->create($role); ?>
<div class="row">
    <div class="col-xs-12 col-sm-10 col-md-6 col-lg-4">
        <fieldset>
            <br/>
            <div class="form-group">
                <label class="control-label"><?= __('Nome do Papel') ?> *</label>
                <?php echo $this->Form->input('name', ['class' => 'form-control', 'label' => false]); ?>
            </div>
            <div class="form-group">
                <label class="control-label"><?= __('Domínio') ?> *</label>
                <?php echo $this->Form->input('domain', ['options' => $domains, 'empty' => true, 'class' => 'form-control', 'label' => false]); ?>
            </div>
            <div class="form-group">
                <label class="control-label"><?= __('Ações permitidas') ?> *</label>
                <?php echo $this->Form->input('actions._ids', ['options' => $actions, 'class' => 'form-control', 'label' => false]); ?>
            </div>
        </fieldset>
        <?= $this->Form->submit(__('Salvar'), ['class' => 'btn btn-success']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>