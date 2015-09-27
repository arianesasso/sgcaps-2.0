<?php

use Phinx\Migration\AbstractMigration;

class CreateTableActions extends AbstractMigration {
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
        $this->table('actions')
                ->addColumn('name', 'string', ['length' => 255, 'null' => false])
                ->addColumn('alias', 'string', ['length' => 255, 'null' => false])
                ->addColumn('controller', 'string', ['length' => 255, 'null' => false])
                ->addColumn('action', 'string', ['length' => 255, 'null' => false])
                ->addColumn('role_id', 'integer', ['null' => false])
                ->addColumn('created', 'datetime', ['null' => false])
                ->addColumn('modified', 'datetime', ['null' => false])
                ->addIndex('role_id')
                ->addForeignKey('role_id', 'roles', 'id')
                ->save();
    }

    /**
     * Migrate Down.
     */
    public function down() {
        $this->dropTable('actions');
    }

}
