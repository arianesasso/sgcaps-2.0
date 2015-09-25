<div class="container-fluid expanded-panel">
    <div class="row">
        <div id="logo" class="col-xs-12 col-sm-3 col-md-2">
            <?= $this->Html->link('SGCaps', ['controller' => 'dashboard', 'action' => 'index']); ?>
        </div>
        <div id="top-panel" class="col-xs-12 col-sm-9 col-md-10">
            <div class="row">
                <div class="col-xs-12 top-panel-right">
                    <ul class="nav navbar-nav pull-right panel-menu">
<!--                        <li class="hidden-xs">
                            <a href="#" class="modal-link">
                                <i class="fa fa-bell"></i>
                                <span class="badge">7</span>
                            </a>
                        </li>-->
                        <li class="hidden-xs">
                            <a class="ajax-link" href="#">
                                <i class="fa fa-calendar"></i>
                                <span class="badge">1</span>
                            </a>
                        </li>
<!--                        <li class="hidden-xs">
                            <a href="#" class="ajax-link">
                                <i class="fa fa-envelope"></i>
                                <span class="badge">7</span>
                            </a>
                        </li>-->
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
                                    <a href="<?php echo $this->Url->build([
                                                    "controller" => "usuario",
                                                    "action" => "editar", $user['id']]);
                                             ?>">
                                        <i class="fa fa-user"></i>
                                        <span><?= __('Meus Dados') ?></span>
                                    </a>
                                </li>
                                 <li>
                                    <a href="#">
                                        <i class="fa fa-calendar"></i>
                                        <span>Calendário</span>
                                    </a>
                                </li>
<!--                            <li>
                                    <a href="#" class="ajax-link">
                                        <i class="fa fa-envelope"></i>
                                        <span><?= __('Mensagens') ?></span>
                                    </a>
                                </li>-->
                                <li>
                                    <a href="#" class="ajax-link">
                                        <i class="fa fa-tasks"></i>
                                        <span>Tarefas</span>
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