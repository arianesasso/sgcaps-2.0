<?php

use Phinx\Migration\AbstractMigration;

class CreateContactsTable extends AbstractMigration
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
        $this->table('contacts')
                ->addColumn('contact_type', 'string', ['length' => 45, 'null' => true, 'default' => null])
                ->addColumn('value', 'string', ['length' => 45, 'null' => false])
                ->addColumn('created', 'datetime', ['null' => false])
                ->addColumn('modified', 'datetime', ['null' => false])
                ->addColumn('person_id', 'integer', ['null' => true, 'default' => null])
                ->addColumn('organization_id', 'integer', ['null' => true, 'default' => null])
                ->addIndex('person_id')
                ->addIndex('organization_id')
                ->addForeignKey('person_id', 'people', 'id')
                ->addForeignKey('organization_id', 'organizations', 'id')
                ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
         $this->dropTable('contacts');
    }
}