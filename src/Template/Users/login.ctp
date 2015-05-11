<!-- Using Login Page (modified) from Devoops Template v. 2.0 -->
<div class="container-fluid">
    <div id="page-login" class="row">
        <div class="col-xs-12 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
            <div class="box">
                <div class="box-content">
                    <div class="text-center page-header">
                        <ul class="list-inline">
                            <li><?= $this->Html->image('icons/sisam_icons/health_unity.png', ['alt' => 'Unidade de Saúde']); ?></li>
                            <li><h3>SGCaps Login</h3></li>  
                        </ul>
                    </div>
                    <?= $this->Form->create() ?>
                    <div class="form-group">
                        <label class="control-label">Usuário</label>
                        <input type="text" class="form-control" name="username" id="username" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Senha</label>
                        <input type="password" class="form-control" name="password" id="password" />
                    </div>
                    <div class="text-center">
                        <?= $this->Form->submit('Entrar', ['class' => 'btn btn-primary']) ?>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>