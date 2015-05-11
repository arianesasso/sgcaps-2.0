<?php

use Phinx\Migration\AbstractMigration;

class CreateValiditiesTable extends AbstractMigration {
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
        $this->table('validities')
                ->addColumn('beginning', 'datetime', ['null' => false])
                ->addColumn('ending', 'datetime', ['null' => true, 'default' => null])
                ->addColumn('created', 'datetime', ['null' => false])
                ->addColumn('modified', 'datetime', ['null' => false])
                ->addColumn('user_id', 'integer', ['null' => false])
                ->addColumn('permission_id', 'integer', ['null' => false])
                ->addIndex('user_id')
                ->addIndex('permission_id')
                ->addIndex('ending')
                ->addForeignKey('user_id', 'users', 'id')
                ->addForeignKey('permission_id', 'permissions', 'id')
                ->save();
    }

    /**
     * Migrate Down.
     */
    public function down() {
        $this->dropTable('validities');
    }

}
