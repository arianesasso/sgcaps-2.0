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
                ->addColumn('organization_id', 'integer', ['null' => true, 'default' => null])
                ->addColumn('name', 'string', ['length' => 255, 'null' => false])
                ->addColumn('region', 'string', ['length' => 255, 'null' => true, 'default' => null])
                ->addColumn('care_type', 'string', ['length' => 45, 'null' => true, 'default' => null])
                ->addColumn('active', 'boolean', ['null' => false, 'default' => true])
                ->addColumn('created', 'datetime', ['null' => false])
                ->addColumn('modified', 'datetime', ['null' => false])
                ->addIndex('organization_id')
                ->addForeignKey('organization_id', 'organizations', 'id')
                ->save();
    }

    /**
     * Migrate Down.
     */
    public function down() {
        $this->dropTable('organizations');
    }

}
