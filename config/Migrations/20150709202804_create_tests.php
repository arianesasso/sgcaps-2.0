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
        //usuários
        $this->execute("INSERT INTO `users` VALUES (1,'admin'," . "'$2y$10\$SCrZo/RtBtXV2CZVqArVzOvmEkH7qAbLZHsZQmIfIW8fsBAS25BEy',1,NULL,'2015-06-13 20:49:28','2015-06-15 01:13:53')");
        //organizations
        $this->execute("INSERT INTO `organizations` VALUES (1,NULL,NULL,'Caps I','DRS XIII','Atenção Especializada','2015-05-14 00:00:00'),(2,NULL,NULL,'Caps II','DRS XIII','Atenção Especializada','2015-05-14 00:00:00')");
        //papéis
        $this->execute("INSERT INTO `roles` VALUES (1,'Gestor Caps','gestor','caps','2015-06-14 00:00:00'),(2,'Gestor Sisam','gestor','geral','2015-06-14 00:00:00'),(3,'Técnico Caps','tecnico','caps','2015-06-14 00:00:00'),(4,'Gestor RT','gestor','residencia_terapeutica','2015-06-14 00:00:00'),(5,'Secretaria do Caps','secretaria','caps','2015-06-14 00:00:00'),(6,'Secretaria da UBS','secretaria','ubs','2015-06-14 00:00:00')");
        //pessoas
        $this->execute("INSERT INTO `people` VALUES (1,1,'ADMINISTRADOR','F',NULL,NULL,NULL,NULL,NULL,'2015-06-13 00:00:00','2015-06-13 21:27:17'),(2,NULL,'PROFISSIONAL 1','M',NULL,NULL,NULL,NULL,NULL,'2015-06-13 00:00:00','2015-06-14 14:14:52'),(3,NULL,'PROFISSIONAL 2','M',NULL,NULL,NULL,NULL,NULL,'2015-06-13 00:00:00','2015-06-14 14:15:37')");
        //profissionais
        $this->execute("INSERT INTO `professionals` VALUES (1,1,'CIBM','1234',NULL),(2,2,'CIBM','1235',NULL),(3,3,'CIBM','1235',NULL)");
        //permissões
        $this->execute("INSERT INTO `permissions` VALUES (1,1,1,2,'2015-06-13 00:00:00','2020-06-14 00:00:00','2015-06-14 00:00:00','2015-06-14 16:56:43',1)");
        //pessoas vinculadas à uma organizaćão
        $this->execute("INSERT INTO `organizations_people` VALUES (1,1,1,'2015-06-14 00:00:00',NULL),(2,2,2,'2015-06-14 00:00:00',NULL),(3,3,1,'2015-06-13 00:00:00',NULL)");
        //estado
        $this->execute("insert into states values (1,'São Paulo','SP')");
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