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
                ->addColumn('person_id', 'integer', ['null' => true, 'default' => null])
                ->addColumn('organization_id', 'integer', ['null' => true, 'default' => null])
                ->addColumn('username', 'string', ['length' => 60, 'null' => false])
                ->addColumn('password', 'string', ['length' => 256, 'null' => false])
                ->addColumn('active', 'boolean', ['null' => false, 'default' => true])
                ->addColumn('created', 'datetime', ['null' => false])
                ->addColumn('modified', 'datetime', ['null' => false])
                ->addColumn('admin_id', 'integer', ['null' => true, 'default' => null])
                ->addIndex('admin_id')
                ->addIndex('person_id')
                ->addIndex('organization_id')
                ->addIndex('username', ['unique' => true])
                ->addForeignKey('admin_id', 'users', 'id')
                ->addForeignKey('person_id', 'people', 'id')
                ->addForeignKey('organization_id', 'organizations', 'id')
                ->save();
    }

    /**
     * Migrate Down.
     */
    public function down() {
        $this->dropTable('users');
    }

}
