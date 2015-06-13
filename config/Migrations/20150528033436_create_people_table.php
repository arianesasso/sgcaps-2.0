<?php

use Phinx\Migration\AbstractMigration;

class CreatePeopleTable extends AbstractMigration
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
         $this->table('people')
                ->addColumn('user_id', 'integer', ['null' => true, 'default' => null])
                ->addColumn('name', 'string', ['length' => 255, 'null' => false])
                ->addColumn('gender', 'string', ['length' => 1, 'null' => true, 'default' => null])
                ->addColumn('cpf', 'integer', ['length' => 20, 'null' => true, 'default' => null])
                ->addColumn('rg', 'string', ['length' => 20, 'null' => true, 'default' => null])
                ->addColumn('rg_state_id', 'integer', ['null' => true, 'default' => null])
                ->addColumn('birthdate', 'date', ['null' => true, 'default' => null])
                ->addColumn('occupation', 'string', ['length' => 255, 'null' => true, 'default' => null])
                ->addColumn('created', 'datetime', ['null' => false])
                ->addColumn('modified', 'datetime', ['null' => false])
                ->addIndex('user_id')
                ->addIndex('rg_state_id')
                ->addForeignKey('user_id', 'users', 'id')
                ->addForeignKey('rg_state_id', 'states', 'id')
                ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
         $this->dropTable('people');
    }
}