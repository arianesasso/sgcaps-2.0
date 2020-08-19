<div class="container-fluid">
    <div id="page-login" class="row">
        <div class="col-xs-12 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
            <div class="box">
                <div class="box-content">
                    <div class="text-center page-header">
                        <ul class="list-inline">
                            <li><?= $this->Html->image('icons/sisam_icons/health_unity.png', ['alt' => 'Unidade de Saúde']); ?></li>
                            <li><h3><?= __('Escolha uma Unidade') ?></h3></li>
                        </ul>
                    </div>
                    <?= $this->Form->create() ?>
                    <div class="form-group">
                        <select class="form-control" name="unidade" id="unidade" />
                        <?php
                            if(isset($permissions)) {
                                foreach ($permissions as $permission): ?>
                                    <option value="<?= $permission->organization->id ?>/<?= $permission->organization->name ?>"><?= $permission->organization->name ?></option>
                                <?php endforeach;
                            }?>
                        </select>
                    </div>
                    <div class="text-center">
                        <?= $this->Form->submit(__('Entrar'), ['class' => 'btn btn-primary']) ?>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>