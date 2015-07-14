<ul class="nav main-menu">
    <li>
        <a href="<?php echo $this->Url->build(["controller" => "dashboard", "action" => "index"]); ?>">
            <i class="fa fa-dashboard"></i>
            <span class="hidden-xs">Dashboard</span>
        </a>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle">
            <i class="fa fa-user"></i>
            <span class="hidden-xs">Paciente</span>
        </a>
        <ul class="dropdown-menu">
            <li><a class="" href="<?php
                echo $this->Url->build(["controller" => "paciente", "action" => "cadastrar"]);
                ?>">Cadastrar</a></li>
            <li><a class="" href="<?php
                echo $this->Url->build(["controller" => "paciente", "action" => "listar"]);
                ?>">Listar</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle">
            <i class="fa fa-users"></i>
            <span class="hidden-xs">Usuários</span>
        </a>
        <ul class="dropdown-menu">
            <li><?php echo $this->Html->link('Cadastrar', ['controller' => 'usuario', 'action' => 'cadastrar']) ?></li>
            <li><?php echo $this->Html->link('Listar', ['controller' => 'usuario', 'action' => 'listar']) ?></li>
        </ul>
    </li>
    <li class="dropdown">
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
    </li>
</ul>