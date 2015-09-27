<?php

use Phinx\Migration\AbstractMigration;

class CreateTests extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * Uncomment this method if you would like to use it.
     *
    public function change()
    {
    }
    */
    
    /**
     * Migrate Up.
     */
    public function up()
    {
        //organizations
        $this->execute("INSERT INTO `organizations` VALUES (1,NULL,'Caps I','DRS XIII','Atenção Especializada','1','2015-05-14 00:00:00','2015-05-14 00:00:00'),(2,NULL,'Caps II','DRS XIII','Atenção Especializada','1','2015-05-14 00:00:00','2015-05-14 00:00:00')");
        //papéis
        $this->execute("INSERT INTO `roles` VALUES (1,'Gestor Caps','gestor','caps','2015-06-14 00:00:00','2015-06-14 00:00:00'),(2,'Técnico Caps','tecnico_caps','caps','2015-06-14 00:00:00','2015-06-14 00:00:00'),(3,'Secretário Caps','secretario','caps','2015-06-14 00:00:00','2015-06-14 00:00:00'),(4,'Administrador','administrador','sistema', now(), now())");
        //pessoas
        $this->execute("INSERT INTO `people` VALUES (1,'ADMINISTRADOR','F',NULL,NULL,NULL,NULL,NULL,'2015-06-13 00:00:00','2015-06-13 21:27:17')");
        //estado
        $this->execute("insert into states values (1,'SÃO PAULO','SP')");
        //profissionais
        $this->execute("INSERT INTO `professionals` VALUES (1,1,'CIBM','1234', 1)");
        //usuários
        $this->execute("INSERT INTO `users` VALUES (1, 1, NULL, 'admin'," . "'$2y$10\$SCrZo/RtBtXV2CZVqArVzOvmEkH7qAbLZHsZQmIfIW8fsBAS25BEy', 1, '2015-06-13 20:49:28','2015-06-15 01:13:53', NULL)");
        //permissões
        $this->execute("INSERT INTO `permissions` VALUES (1,1,1,4,'2015-06-13 00:00:00','2020-06-14 00:00:00','2015-06-14 00:00:00','2015-06-14 16:56:43',1)");
        //pessoas vinculadas à uma organizaćão
        $this->execute("INSERT INTO `organizations_people` VALUES (1,1,1,'2015-06-14 00:00:00',NULL)");  
        //ações
        $this->execute("INSERT INTO `actions` VALUES (1,'Cadastrar Usário', 'cadastrar_usuario', 'Users', 'add', now(), now()), (2,'Listar Usários', 'listar_usuarios', 'Users', 'index', now(), now()), (3,'Visualizar Usário', 'visualizar_usuario', 'Users', 'view', now(), now()), (4,'Editar Usário', 'editar_usuario', 'Users', 'edit', now(), now()), (5,'Mudar Status do Usário', 'mudar_status_usuario', 'Users', 'changeActivation', now(), now()), (6,'Cadastrar Paciente', 'cadastrar_paciente', 'Patients', 'add', now(), now()), (7,'Listar Pacientes', 'listar_pacientes', 'Patients', 'index', now(), now()), (8,'Visualizar Pacientes', 'visualizar_paciente', 'Patients', 'view', now(), now()),  (9,'Editar Paciente', 'editar_paciente', 'Patients', 'edit', now(), now()),  (10,'Cadastrar Ação', 'cadastrar_acao', 'Actions', 'add', now(), now()), (11,'Listar Ações', 'listar_acoes', 'Actions', 'index', now(), now()), (12,'Visualizar Ação', 'visualizar_acao', 'Actions', 'view', now(), now()), (13,'Deletar Ação', 'deletar_acao', 'Actions', 'delete', now(), now()),  (14,'Cadastrar Papel', 'cadastrar_papel', 'Roles', 'add', now(), now()), (15,'Listar Papéis', 'listar_papeis', 'Roles', 'index', now(), now()), (16,'Visualizar Papel', 'visualizar_papel', 'Roles', 'view', now(), now()), (17,'Deletar Papel', 'deletar_papel', 'Roles', 'delete', now(), now()),  (18,'Visualizar indicadores demográficos', 'visualizar_indicadores_demograficos', 'Indicators', 'demographic', now(), now()),  (19,'Cadastrar Organização', 'cadastrar_organizacao', 'Organizations', 'add', now(), now()), (20,'Listar Organizações', 'listar_organizacoes', 'Organizations', 'index', now(), now()), (21,'Visualizar Organização', 'visualizar_organizacao', 'Organizations', 'view', now(), now()), (22,'Editar Organização', 'editar_organizacao', 'Organizations', 'edit', now(), now()),   (23,'Cadastrar Profissional', 'cadastrar_profissional', 'Professionals', 'add', now(), now()), (24,'Listar Profissionais', 'listar_profissionais', 'Professionals', 'index', now(), now()), (25,'Visualizar Profissional', 'visualizar_profissional', 'Professionals', 'view', now(), now()), (26,'Editar Profissional', 'editar_profissional', 'Professionals', 'edit', now(), now()),  (27,'Adicionar Permissão', 'adicionar_permissao', 'Permissions', 'add', now(), now()), (28,'Cancelar Permissão', 'cancelar_permissao', 'Permissions', 'cancel', now(), now()),  (29,'Visualizar Menu Pacientes', 'menu_pacientes', 'Menu', 'patients', now(), now()), (30,'Visualizar Menu Profissionais', 'menu_profissionais', 'Menu', 'professionals', now(), now()), (31,'Visualizar Menu Atividades', 'menu_atividades', 'Menu', 'activities', now(), now()), (32,'Visualizar Menu Organizações', 'menu_organizacoes', 'Menu', 'organizations', now(), now()), (33,'Visualizar Menu Usuário', 'menu_usuarios', 'Menu', 'users', now(), now()), (34,'Visualizar Menu Indicadores', 'menu_indicadores', 'Menu', 'indicators', now(), now()), (35,'Visualizar Menu Administração', 'menu_administracao', 'Menu', 'administration', now(), now()), (36,'Visualizar SubMenu Papéis', 'submenu_papeis', 'Menu', 'roles', now(), now()), (37,'Visualizar SubMenu Ações', 'submenu_acoes', 'Menu', 'actions', now(), now())");
        //ações que um papel pode executar
        $this->execute("INSERT INTO `actions_roles` VALUES (1,4,1,now(),now()), (2,4,2,now(),now()), (3,4,3,now(),now()), (4,4,4,now(),now()), (5,4,5,now(),now()), (6,4,6,now(),now()), (7,4,7,now(),now()), (8,4,8,now(),now()), (9,4,9,now(),now()), (10,4,10,now(),now()), (11,4,11,now(),now()), (12,4,12,now(),now()), (13,4,13,now(),now()), (14,4,14,now(),now()), (15,4,15,now(),now()), (16,4,16,now(),now()), (17,4,17,now(),now()), (18,4,18,now(),now()), (19,4,19,now(),now()), (20,4,20,now(),now()), (21,4,21,now(),now()), (22,4,22,now(),now()), (23,4,23,now(),now()), (24,4,24,now(),now()), (25,4,25,now(),now()), (26,4,26,now(),now()), (27,4,27,now(),now()), (28,4,28,now(),now()), (29,4,29,now(),now()), (30,4,30,now(),now()), (31,4,31,now(),now()), (32,4,32,now(),now()), (33,4,33,now(),now()), (34,4,34,now(),now()), (35,4,35,now(),now()), (36,4,36,now(),now()), (37,4,37,now(),now())");
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->execute("Delete FROM states");
        $this->execute("Delete FROM organizations_people");
        $this->execute("Delete FROM permissions");
        $this->execute("Delete FROM professionals");
        $this->execute("Delete FROM people");
        $this->execute("Delete FROM roles");
        $this->execute("Delete FROM organizations");
        $this->execute("Delete FROM users");    
    }
}