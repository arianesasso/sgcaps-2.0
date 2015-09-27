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
        $this->execute("INSERT INTO `roles` VALUES (1,'Gestor Caps','gestor','caps','2015-06-14 00:00:00','2015-06-14 00:00:00'),(2,'Técnico Caps','tecnico','caps','2015-06-14 00:00:00','2015-06-14 00:00:00'),(3,'Secretário Caps','secretario','caps','2015-06-14 00:00:00','2015-06-14 00:00:00'),(4,'Gestor RT','gestor','residencia_terapeutica','2015-06-14 00:00:00','2015-06-14 00:00:00'),(5,'Gestor Sisam','gestor','sisam','2015-06-14 00:00:00','2015-06-14 00:00:00'),(6,'Secretário UBS','secretario','ubs','2015-06-14 00:00:00','2015-06-14 00:00:00')");
        //pessoas
        $this->execute("INSERT INTO `people` VALUES (1,'ADMINISTRADOR','F',NULL,NULL,NULL,NULL,NULL,'2015-06-13 00:00:00','2015-06-13 21:27:17')");
        //estado
        $this->execute("insert into states values (1,'São Paulo','SP')");
        //profissionais
        $this->execute("INSERT INTO `professionals` VALUES (1,1,'CIBM','1234', 1)");
        //usuários
        $this->execute("INSERT INTO `users` VALUES (1, 1, NULL, 'admin'," . "'$2y$10\$SCrZo/RtBtXV2CZVqArVzOvmEkH7qAbLZHsZQmIfIW8fsBAS25BEy', 1, '2015-06-13 20:49:28','2015-06-15 01:13:53', NULL)");
        //permissões
        $this->execute("INSERT INTO `permissions` VALUES (1,1,1,1,'2015-06-13 00:00:00','2020-06-14 00:00:00','2015-06-14 00:00:00','2015-06-14 16:56:43',1)");
        //pessoas vinculadas à uma organizaćão
        $this->execute("INSERT INTO `organizations_people` VALUES (1,1,1,'2015-06-14 00:00:00',NULL)");  
        //ações
        $this->execute("INSERT INTO `actions` VALUES (1,'Cadastrar Usário', 'cadastrar_usuario', 'Users', 'add', now(), now()), (2,'Listar Usários', 'listar_usuario', 'Users', 'index', now(), now()), (3,'Visualizar Usário', 'visualizar_usuario', 'Users', 'view', now(), now()), (4,'Editar Usário', 'editar_usuario', 'Users', 'edit', now(), now()), (5,'Mudar Status do Usário', 'mudar_status_usuario', 'Users', 'changeActivation', now(), now())");
       //ações que um papel pode executar
        $this->execute("INSERT INTO `actions_roles` VALUES (1,1,1,now(),now()), (2,1,2,now(),now()), (3,1,3,now(),now())    , (4,1,4,now(),now()), (5,1,5,now(),now())");
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