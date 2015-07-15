<?php
if (empty($patient->person->occupation_id)) {
    $occupation = 'Não preenchido';
} else {
    if (empty($patient->person->occupation->description)) {
        $occupation = $patient->person->occupation_id;
    } else {
        $occupation = $patient->person->occupation->description;
    }
}
?>
<legend><?= __('Visualizar Informações do Paciente') ?></legend>
<div class="row">
    <div class="col-xs-12 gray-frame">
<?php echo $this->element('patient_info', ['patient' => $patient]) ?>
    </div>
</div>
</div>
<div class ="row">
    <div class="col-xs-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#">Dados Gerais</a></li>
            <li><a href="#">Contatos</a></li>
            <li><a href="#">Endereços</a></li>
            <li><a href="#">Atividades</a></li>
            <li><a href="#">Fichas</a></li>
        </ul>
    </div>
</div>
<div class ="row">
    <div class="col-xs-8">
        <br/>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <label><?= __('Data de Nascimento') ?></label>
                <p><?= empty($patient->person->birthdate) ? "Não preenchido" : h($patient->person->birthdate->format('d/m/Y')) ?></p>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <label><?= __('CPF') ?></label>
                <p><?= empty($patient->person->cpf) ? "Não preenchido" : h($patient->person->cpf) ?></p>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <label><?= __('RG') ?></label>
                <p><?= empty($patient->person->rg) ? "Não preenchido" : h($patient->person->rg) ?></p>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <label><?= __('RG - UF') ?></label>
                <p><?= empty($patient->person->rg_state_id) ? "Não preenchido" : h($patient->person->state->name) ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-lg-3">
                <label><?= __('Etnia') ?></label>
                <p><?= empty($patient->ethnicity) ? "Não preenchido" : mb_strtoupper(h($patient->ethnicity)) ?></p>  
            </div>
            <div class="col-xs-12 col-sm-6 col-lg-3">
                <label><?= __('Date de Cadastro') ?></label>
                <p><?= h($patient->created->format('d/m/Y')) ?></p>  
            </div>
            <div class="col-xs-12 col-sm-6 col-lg-3">
                <label><?= __('Estado Civil') ?></label>
                <p><?= empty($patient->marital_status) ? "Não preenchido" : mb_strtoupper(h($patient->marital_status)) ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <label><?= __('Ocupação') ?></label>
                <p><?= mb_strtoupper($occupation) ?></p>  
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <label><?= __('Observação') ?></label>
                <p><?php echo wordwrap("$patient->observation", 60, '<br />', true); ?></p>              
            </div>
        </div> 
    </div>
    <div class="col-xs-2 col-xs-offset-2">
        <a href="#" class="btn btn-success action-button fixed-width-button">
            <i class="fa fa-plus-square"></i> Novo contato
        </a>
        <a href="#" class="btn btn-success action-button fixed-width-button">
            <i class="fa fa-plus-square"></i> Novo endereço
        </a>
        <a href="#" class="btn btn-success action-button fixed-width-button">
            <i class="fa fa-clock-o"></i> Agendar Atividade
        </a>
        <a href="#" class="btn btn-success action-button fixed-width-button">
            <i class="fa fa-list"></i> Preencher Ficha
        </a>
    </div>
</div>