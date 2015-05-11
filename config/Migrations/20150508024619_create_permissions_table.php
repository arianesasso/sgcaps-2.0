<?php

use Phinx\Migration\AbstractMigration;

class CreatePermissionsTable extends AbstractMigration {
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
        $this->table('permissions')
                ->addColumn('user_id', 'integer', ['null' => false])
                ->addColumn('organization_id', 'integer', ['null' => false])
                ->addColumn('role_id', 'integer', ['null' => false])
                ->addIndex('user_id')
                ->addIndex('organization_id')
                ->addIndex('role_id')
                ->addForeignKey('user_id', 'users', 'id')
                ->addForeignKey('organization_id', 'organizations', 'id')
                ->addForeignKey('role_id', 'roles', 'id')
                ->save();
    }

    /**
     * Migrate Down.
     */
    public function down() {
        $this->dropTable('permissions');
    }

}
