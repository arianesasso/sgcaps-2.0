<?php $actions = $this->request->session()->read('Auth.User.actions'); ?>
<ul class="nav main-menu">
    <li>
        <a href="<?php echo $this->Url->build(["controller" => "dashboard", 
                                               "action" => "index"]); ?>">
            <i class="fa fa-dashboard"></i>
            <span class="hidden-xs">Dashboard</span>
        </a>
    </li>
    <?php if (in_array('menu_pacientes', $actions)) { ?>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle">
            <i class="fa fa-medkit"></i>
            <span class="hidden-xs">Pacientes</span>
        </a>
        <ul class="dropdown-menu">
            <?php if (in_array('cadastrar_paciente', $actions)) { ?>
            <li>
                <?php echo $this->Html->Link("Cadastrar", ["controller" => "paciente", 
                                                           "action" => "cadastrar"]); ?>
            </li>
            <?php }
            if (in_array('listar_pacientes', $actions)) { ?>
            <li>
                <?php echo $this->Html->Link("Listar", ["controller" => "paciente", 
                                                        "action" => "listar"]) ?>
            </li>
            <?php } ?>
        </ul>
    </li>
    <?php }
    if (in_array('menu_atividades', $actions)) { ?>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle">
            <i class="fa fa-list-alt"></i>
            <span class="hidden-xs">Atividades</span>
        </a>
        <ul class="dropdown-menu">
            <?php if (in_array('cadastrar_atividade', $actions)) { ?>
            <li><a class="" href="#">Cadastrar</a></li>
            <?php } 
            if (in_array('listar_atividades', $actions)) { ?>
            <li><a class="" href="#">Listar</a></li>
            <?php } ?>
        </ul>
    </li>
    <?php }
    if (in_array('menu_profissionais', $actions)) { ?>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle">
            <i class="fa fa-user"></i>
            <span class="hidden-xs">Profissionais</span>
        </a>
        <ul class="dropdown-menu">
            <?php if (in_array('cadastrar_profissional', $actions)) { ?>
            <li>
                <?php echo $this->Html->link("Cadastrar", ["controller" => "profissional", 
                                                           "action" => "cadastrar"]); ?>
            </li>
            <?php }
            if (in_array('listar_profissionais', $actions)) { ?>
            <li>
                <?php echo $this->Html->link("Listar", ["controller" => "profissional", 
                                                        "action" => "listar"]); ?>
            </li>
            <?php } ?>
        </ul>
    </li>
    <?php } 
    if (in_array('menu_organizacoes', $actions)) { ?>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle">
            <i class="fa fa-hospital-o"></i>
            <span class="hidden-xs">Unidades</span>
        </a>
        <ul class="dropdown-menu">
            <?php if (in_array('cadastrar_organizacao', $actions)) { ?>
            <li><a class="" href="#">Cadastrar</a></li>
            <?php } 
            if (in_array('listar_organizacoes', $actions)) { ?>
            <li><a class="" href="#">Listar</a></li>
            <?php } ?>
        </ul>
    </li>
    <?php } if (in_array('menu_indicadores', $actions)) { ?>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle">
            <i class="fa fa-bar-chart"></i>
            <span class="hidden-xs">Indicadores</span>
        </a>
        <ul class="dropdown-menu">
            <?php if (in_array('visualizar_indicadores_demograficos', $actions)) { ?>
            <li>
                <?php echo $this->Html->Link("Demográficos", ["controller" => "indicadores", 
                                                              "action" => "demograficos"]); ?>
            </li>
            <?php } ?>
        </ul>
    </li>
    <?php } if (in_array('menu_usuarios', $actions)) { ?>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle">
            <i class="fa fa-users"></i>
            <span class="hidden-xs">Usuários</span>
        </a>
        <ul class="dropdown-menu">
            <?php if (in_array('cadastrar_usuario', $actions)) { ?>
            <li>
                <?php echo $this->Html->link("Cadastrar", ["controller" => "usuario", 
                                                           "action" => "cadastrar"]) ?>
            </li>
            <?php } 
            if (in_array('listar_todos_usuarios', $actions) || in_array('listar_usuarios_locais', $actions)) { ?>
            <li>
                <?php echo $this->Html->link("Listar", ["controller" => "usuario", 
                                                        "action" => "listar"]) ?>
            </li>
            <?php } ?>
        </ul>
    </li>
    <?php } if (in_array('menu_administracao', $actions)) { ?>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle">
            <i class="fa fa-cogs"></i>
            <span class="hidden-xs">Administração</span>
        </a>   
        <ul class="dropdown-menu">
            <?php if (in_array('submenu_papeis', $actions)) { ?>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle">
                    <i class="fa fa-archive"></i>
                    <span class="hidden-xs">Papéis</span>
                </a>
                <ul class="dropdown-menu">
                    <?php if (in_array('cadastrar_papel', $actions)) { ?>
                    <li>
                        <?php echo $this->Html->link("Cadastrar", ["controller" => "papel",
                            "action" => "cadastrar"])
                        ?>
                    </li>
                    <?php } 
                    if (in_array('listar_papeis', $actions)) { ?>
                    <li>
                        <?php echo $this->Html->link("Listar", ["controller" => "papel",
                            "action" => "listar"])
                        ?>
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <?php } if (in_array('submenu_acoes', $actions)) { ?>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle">
                    <i class="fa fa-briefcase"></i>
                    <span class="hidden-xs">Ações</span>
                </a>
                <ul class="dropdown-menu">
                    <?php if (in_array('cadastrar_acao', $actions)) { ?>
                    <li>
                        <?php echo $this->Html->link("Cadastrar", ["controller" => "acao",
                            "action" => "cadastrar"])
                        ?>
                    </li>
                    <?php } if (in_array('listar_acoes', $actions)) { ?>
                    <li>
                        <?php echo $this->Html->link("Listar", ["controller" => "acao",
                            "action" => "listar"])
                        ?>
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
        </ul>
    </li>
    <?php } ?>

    <!--    <li class="dropdown">
            <a href="#" class="dropdown-toggle">
                <i class="fa fa-picture-o"></i>
                <span class="hidden-xs">Multilevel menu</span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="#">First level menu</a></li>
                <li><a href="#">First level menu</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle">
                        <i class="fa fa-plus-square"></i>
                        <span class="hidden-xs">Second level menu group</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Second level menu</a></li>
                        <li><a href="#">Second level menu</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle">
                                <i class="fa fa-plus-square"></i>
                                <span class="hidden-xs">Three level menu group</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Three level menu</a></li>
                                <li><a href="#">Three level menu</a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle">
                                        <i class="fa fa-plus-square"></i>
                                        <span class="hidden-xs">Four level menu group</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Four level menu</a></li>
                                        <li><a href="#">Four level menu</a></li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle">
                                                <i class="fa fa-plus-square"></i>
                                                <span class="hidden-xs">Five level menu group</span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">Five level menu</a></li>
                                                <li><a href="#">Five level menu</a></li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle">
                                                        <i class="fa fa-plus-square"></i>
                                                        <span class="hidden-xs">Six level menu group</span>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#">Six level menu</a></li>
                                                        <li><a href="#">Six level menu</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="#">Three level menu</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>-->
</ul>