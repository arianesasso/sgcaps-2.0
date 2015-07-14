<?php
//http://www.saude.sp.gov.br/resources/ses/perfil/profissional-da-saude/grupo-tecnico-de-acoes-estrategicas-gtae/saude-da-populacao-negra/livros-e-revistas/manual_quesito_cor.pdf
$ethnicities = ["branca" => "Branca", "parda" => "Parda", "negra" => "Negra", 'amarela' => 'Amarela', "indigena" => 'Indígena'];

//http://www.ibge.gov.br/home/estatistica/populacao/trabalhoerendimento/pnad2012/sintese_defaultpdf_dados.shtm
//http://seriesestatisticas.ibge.gov.br/glossario.aspx
$maritalStatus = ["solteiro" => "Solteiro(a)", "casado" => "Casado(a)", "desquitado" => "Desquitado(a) ou separado(a) judicialmente ", "divorciado" => "Divorciado(a)", "viuvo" => "Viúvo(a)"];

$genders = ['F' => 'Femnino', 'M' => 'Masculino', 'T' => 'Transsexual'];
?>  

<legend><?= __('Cadastrar Novo Paciente') ?></legend>
<div class="row">
    <div class="col-xs-12">
        <h6>(*) Campos Obrigatórios</h6>
        <?= $this->Form->create($patient, ['class' => 'form-inline']); ?>
        <fieldset>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <div class="form-group some-height">
                        <label class="control-label"><?= __('Nome') ?> *</label>
                        <?php echo $this->Form->input('person.name', ['class' => 'form-control', 'label' => false]); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <div class="form-group some-height">
                        <label class="control-label"><?= __('Gênero') ?> *</label>
                        <?php echo $this->Form->input('person.gender', ['options' => $genders, 'empty' => true, 'class' => 'form-control', 'label' => false]); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <div class="form-group some-height">
                        <label class="control-label"><?= __('Data de Nascimento') ?></label>
                        <?php echo $this->Form->input('person.birthdate', ['id' => 'birthdate', 'type' => 'text', 'class' => 'form-control date-mask', 'placeholder' => 'dd/mm/yyyy', 'label' => false]); ?>
                    </div>
                </div>            
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <div class="form-group some-height">
                        <label class="control-label"><?= __('Idade aproximada') ?><span id="mandatory_aprox_age"> *</span></label>
                        <?php echo $this->Form->input('approximate_age', ['id' => 'aprox_age', 'class' => 'form-control', 'label' => false, 'max' => 150, 'min' => 1]); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <div class="form-group some-height">
                        <label class="control-label"><?= __('CPF') ?></label>
                        <?php echo $this->Form->input('person.cpf', ['type' => 'text', 'class' => 'form-control cpf-mask', 'label' => false, 'placeholder' => '999.999.999-99']); ?>
                    </div>
                </div>
                <!-- http://cartaonet.datasus.gov.br/ -->
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <div class="form-group some-height">
                        <label class="control-label"><?= __('CNS') ?></label>
                        <?php echo $this->Form->input('cns', ['type' => 'text', 'class' => 'form-control cns-mask', 'label' => false, 'placeholder' => '999999999999999']); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <div class="form-group some-height">
                        <label class="control-label"><?= __('RG') ?></label>
                        <?php echo $this->Form->input('person.rg', ['class' => 'form-control rg-mask', 'label' => false, 'placeholder' => 'Somente números e letras']); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <div class="form-group some-height">
                        <label class="control-label"><?= __('RG - UF') ?></label>
                        <?php echo $this->Form->input('person.rg_state_id', ['options' => $states, 'empty' => true, 'class' => 'form-control', 'label' => false]); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="form-group some-height">
                        <label class="control-label"><?php echo __('Ocupação'); ?></label>
                        <span class="not-found"><?php echo "( " . __('Outra') . " " . $this->Form->checkbox('not_found', ['id' => 'not_found']) . " )"; ?></span>
                        <?php echo $this->Form->input('person.occupation', ['id' => 'occupations_select', 'options' => $occupations, 'empty' => true, 'class' => 'form-control basic-select', 'label' => false]); ?>
                        <?php echo $this->Form->input('person.occupation', ['type' => 'text', 'id' => 'occupations_text', 'class' => 'form-control', 'label' => false, 'disabled']); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="form-group some-height">
                        <label class="control-label"><?= __('Etnia') ?></label>
                        <?php echo $this->Form->input('ethnicity', ['options' => $ethnicities, 'empty' => true, 'class' => 'form-control', 'label' => false]); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group some-height">
                        <label class="control-label"><?= __('Estado Civil') ?></label>
                        <?php echo $this->Form->input('marital_status', ['options' => $maritalStatus, 'empty' => true, 'class' => 'form-control', 'label' => false]); ?>
                    </div>
                </div>             
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label class="control-label"><?= __('Observação') ?></label>
                        <?php echo $this->Form->input('observation', ['class' => 'form-control', 'label' => false, "rows" => "4", "cols" => "70"]); ?>
                    </div>
                    <?= $this->Form->submit(__('Salvar'), ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </fieldset>
    </div>
    <?= $this->Form->end() ?>
</div>