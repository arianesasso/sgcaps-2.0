<?php

use Phinx\Migration\AbstractMigration;

class CreatePeopleTable extends AbstractMigration {
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
    public function up() {
        $this->table('people')
                ->addColumn('name', 'string', ['length' => 255, 'null' => false])
                ->addColumn('gender', 'string', ['length' => 1, 'null' => true, 'default' => null])
                ->addColumn('cpf', 'string', ['length' => 20, 'null' => true, 'default' => null])
                ->addColumn('rg', 'string', ['length' => 20, 'null' => true, 'default' => null])
                ->addColumn('rg_state_id', 'integer', ['null' => true, 'default' => null])
                ->addColumn('birthdate', 'date', ['null' => true, 'default' => null])
                ->addColumn('occupation_id', 'string', ['length' => 255, 'null' => true, 'default' => null])
                ->addColumn('created', 'datetime', ['null' => false])
                ->addColumn('modified', 'datetime', ['null' => false])
                ->addIndex(['rg', 'rg_state_id'], ['unique' => true])
                ->addIndex(['cpf'], ['unique' => true])
                ->addForeignKey('rg_state_id', 'states', 'id')
                ->save();
    }

    /**
     * Migrate Down.
     */
    public function down() {
        $this->dropTable('people');
    }

}