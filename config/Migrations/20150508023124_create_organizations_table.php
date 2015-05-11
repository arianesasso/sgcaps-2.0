<?php

use Phinx\Migration\AbstractMigration;

class CreateOrganizationsTable extends AbstractMigration {
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
        $this->table('organizations')
                ->addColumn('name', 'string', ['length' => 255, 'null' => false])
                ->addColumn('user_id', 'integer', ['null' => true, 'default' => null])
                ->addColumn('created', 'datetime', ['null' => false])
                ->addIndex('user_id')
                ->addForeignKey('user_id', 'users', 'id')
                ->save();
    }

    /**
     * Migrate Down.
     */
    public function down() {
        $this->dropTable('organizations');
    }

}
