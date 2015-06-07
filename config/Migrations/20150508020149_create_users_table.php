<?php

use Phinx\Migration\AbstractMigration;

class CreateUsersTable extends AbstractMigration {
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
        $this->table('users')
                ->addColumn('username', 'string', ['length' => 60, 'null' => false])
                ->addColumn('password', 'string', ['length' => 256, 'null' => false])
                ->addColumn('active', 'boolean', ['null' => false, 'default' => 1])
                ->addColumn('admin_id', 'integer', ['null' => true, 'default' => null])
                ->addColumn('created', 'datetime', ['null' => false])
                ->addColumn('modified', 'datetime', ['null' => false])
                ->addIndex('admin_id')
                ->addIndex('username', ['unique' => true])
                ->addForeignKey('admin_id', 'users', 'id')
                ->save();
    }

    /**
     * Migrate Down.
     */
    public function down() {
        $this->dropTable('users');
    }

}
