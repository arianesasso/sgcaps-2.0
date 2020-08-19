<?php

use Phinx\Migration\AbstractMigration;

class CreateOrganizationsPeopleTable extends AbstractMigration
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
        $this->table('organizations_people')
                ->addColumn('person_id', 'integer', ['null' => false])
                ->addColumn('organization_id', 'integer', ['null' => false])
                ->addColumn('created', 'datetime', ['null' => false])
                ->addColumn('ended', 'datetime', ['null' => true, 'default' => null])
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
         $this->dropTable('organizations_people');
    }
}