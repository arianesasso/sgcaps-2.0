<?php
$empty = __('NÃO PREENCHIDO');
if (empty($professional->person->occupation_id)) {
    $occupation = $empty;
} else {
    if (empty($professional->person->occupation->description)) {
        $occupation = $professional->person->occupation_id;
    } else {
        $occupation = $professional->person->occupation->description;
    }
}
?>
<legend><?= __('Visualizar Informações do Profissional') ?></legend>
<div class="row">
    <div class="col-xs-12 gray-frame">
<?php echo $this->element('professional_info', ['professional' => $professional]) ?>
    </div>
</div>
</div>
<div class ="row">
    <div class="col-xs-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#">Dados Gerais</a></li>
            <li><a href="#">Contatos</a></li>
            <li><a href="#">Endereços</a></li>
        </ul>
    </div>
</div>
<div class ="row">
    <div class="col-xs-8">
        <br/>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <label><?= __('Data de Nascimento') ?></label>
                <p><?= empty($professional->person->birthdate) ? $empty : h($professional->person->birthdate->format('d/m/Y')) ?></p>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <label><?= __('CPF') ?></label>
                <p><?= empty($professional->person->cpf) ? $empty : h($professional->person->cpf) ?></p>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <label><?= __('RG') ?></label>
                <p><?= empty($professional->person->rg) ? $empty : h($professional->person->rg) ?></p>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <label><?= __('RG - UF') ?></label>
                <p><?= empty($professional->person->rg_state_id) ? $empty :  mb_strtoupper(h($professional->person->state->name)) ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-lg-3">
                <label><?= __('Sigla do Conselho') ?></label>
                <p><?= empty($professional->board_acronym) ? $empty : mb_strtoupper(h($professional->board_acronym)) ?></p>
            </div>
            <div class="col-xs-12 col-sm-6 col-lg-3">
                <label><?= __('Número do conselho') ?></label>
                <p><?= empty($professional->board_number) ? $empty : mb_strtoupper(h($professional->board_number)) ?></p>
            </div>
            <div class="col-xs-12 col-sm-6 col-lg-3">
                <label><?= __('UF - Conselho') ?></label>
                <p><?= empty($professional->state->name) ? $empty : mb_strtoupper(h($professional->state->name)) ?></p>
            </div>
            <div class="col-xs-12 col-sm-6 col-lg-3">
                <label><?= __('Date de Cadastro') ?></label>
                <p><?= h($professional->person->created->format('d/m/Y')) ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <label><?= __('Ocupação') ?></label>
                <p><?= mb_strtoupper($occupation) ?></p>
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
    </div>
</div>