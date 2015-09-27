<ul class="nav main-menu">
    <li>
        <a href="<?php echo $this->Url->build(["controller" => "dashboard", 
                                               "action" => "index"]); ?>">
            <i class="fa fa-dashboard"></i>
            <span class="hidden-xs">Dashboard</span>
        </a>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle">
            <i class="fa fa-medkit"></i>
            <span class="hidden-xs">Pacientes</span>
        </a>
        <ul class="dropdown-menu">
            <li>
                <?php echo $this->Html->Link("Cadastrar", ["controller" => "paciente", 
                                                           "action" => "cadastrar"]); ?>
            </li>
            <li>
                <?php echo $this->Html->Link("Listar", ["controller" => "paciente", 
                                                        "action" => "listar"]) ?>
            </li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle">
            <i class="fa fa-list-alt"></i>
            <span class="hidden-xs">Atividades</span>
        </a>
        <ul class="dropdown-menu">
            <li><a class="" href="#">Cadastrar</a></li>
            <li><a class="" href="#">Listar</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle">
            <i class="fa fa-user"></i>
            <span class="hidden-xs">Profissionais</span>
        </a>
        <ul class="dropdown-menu">
            <li>
                <?php echo $this->Html->link("Cadastrar", ["controller" => "profissional", 
                                                           "action" => "cadastrar"]); ?>
            </li>
            <li>
                <?php echo $this->Html->link("Listar", ["controller" => "profissional", 
                                                        "action" => "listar"]); ?>
            </li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle">
            <i class="fa fa-hospital-o"></i>
            <span class="hidden-xs">Unidades</span>
        </a>
        <ul class="dropdown-menu">
            <li><a class="" href="#">Cadastrar</a></li>
            <li><a class="" href="#">Listar</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle">
            <i class="fa fa-bar-chart"></i>
            <span class="hidden-xs">Indicadores</span>
        </a>
        <ul class="dropdown-menu">
            <li>
                <?php echo $this->Html->Link("Demográficos", ["controller" => "indicadores", 
                                                              "action" => "demograficos"]); ?>
            </li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle">
            <i class="fa fa-users"></i>
            <span class="hidden-xs">Usuários</span>
        </a>
        <ul class="dropdown-menu">
            <li>
                <?php echo $this->Html->link("Cadastrar", ["controller" => "usuario", 
                                                           "action" => "cadastrar"]) ?>
            </li>
            <li>
                <?php echo $this->Html->link("Listar", ["controller" => "usuario", 
                                                        "action" => "listar"]) ?>
            </li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle">
            <i class="fa fa-cogs"></i>
            <span class="hidden-xs">Administração</span>
        </a>
        <ul class="dropdown-menu">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle">
                    <i class="fa fa-archive"></i>
                    <span class="hidden-xs">Papéis</span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <?php echo $this->Html->link("Cadastrar", ["controller" => "papel",
                            "action" => "cadastrar"])
                        ?>
                    </li>
                    <li>
                        <?php echo $this->Html->link("Listar", ["controller" => "papel",
                            "action" => "listar"])
                        ?>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle">
                    <i class="fa fa-briefcase"></i>
                    <span class="hidden-xs">Ações</span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <?php echo $this->Html->link("Cadastrar", ["controller" => "acao",
                            "action" => "cadastrar"])
                        ?>
                    </li>
                    <li>
                        <?php echo $this->Html->link("Listar", ["controller" => "acao",
                            "action" => "listar"])
                        ?>
                    </li>
                </ul>
            </li>
        </ul>
    </li>

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