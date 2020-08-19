<?php
if(!empty($user['person_id'])) {
    $userDataUrl = $this->Url->build(["controller" => "profissional",
                                      "action" => "visualizar",
                                      $user['person_id'], 'person']);
} else {
    $userDataUrl = $this->Url->build(["controller" => "organizacao",
                                      "action" => "visualizar",
                                      $user['organization_id']]);
}

?>
<div class="container-fluid expanded-panel">
    <div class="row">
        <div id="logo" class="col-xs-12 col-sm-3 col-md-2">
            <?= $this->Html->link('SGCaps', ['controller' => 'dashboard', 'action' => 'index']); ?>
        </div>
        <div id="top-panel" class="col-xs-12 col-sm-9 col-md-10">
            <div class="row">
                <div class="col-xs-12 top-panel-right">
                    <ul class="nav navbar-nav pull-right panel-menu">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle account" data-toggle="dropdown">
                                <div class="avatar">
                                    <img src="http://www.gravatar.com/avatar?d=mm" class="img-circle" alt="avatar" />
                                </div>
                                <i class="fa fa-angle-down pull-right"></i>
                                <div class="user-mini pull-right">
                                    <span class="welcome"><?= __('Seja bem-vindo') ?>,</span>
                                    <span><?php echo !empty($this->request->session()->read('Auth.User.person.name'))?
                                                        $this->request->session()->read('Auth.User.person.name') :
                                                        $this->request->session()->read('Auth.User.organization.name');
                                          ?></span>
                                </div>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?= $userDataUrl ?>">
                                        <i class="fa fa-user"></i>
                                        <span><?= __('Meus Dados') ?></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Url->build([
                                                    "controller" => "usuario",
                                                    "action" => "editar", $user['id']]);
                                             ?>">
                                        <i class="fa fa-key"></i>
                                        <span><?= __('Mudar senha') ?></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Url->build([
                                                    "controller" => "usuario",
                                                    "action" => "logout"]);
                                             ?>">
                                        <i class="fa fa-power-off"></i>
                                        <span>Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>