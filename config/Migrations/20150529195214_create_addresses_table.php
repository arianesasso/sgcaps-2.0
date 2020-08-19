<?php

use Phinx\Migration\AbstractMigration;

class CreateAddressesTable extends AbstractMigration
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
         $this->table('addresses')
                ->addColumn('city_id', 'integer', ['null' => false])
                ->addColumn('street', 'string', ['length' => 255, 'null' => true, 'default' => null])
                ->addColumn('number', 'string', ['length' => 10, 'null' => true, 'default' => null])
                ->addColumn('complement', 'string', ['length' => 45, 'null' => true, 'default' => null])
                ->addColumn('district', 'string', ['length' => 255, 'null' => true, 'default' => null])
                ->addColumn('cep', 'string', ['length' => 20, 'null' => true, 'default' => null])
                ->addColumn('purpose', 'string', ['length' => 45, 'null' => true, 'default' => null])
                ->addColumn('observation', 'text', ['null' => true, 'default' => null])
                ->addColumn('created', 'datetime', ['null' => false])
                ->addColumn('modified', 'datetime', ['null' => false])
                ->addColumn('person_id', 'integer', ['null' => true, 'default' => null])
                ->addColumn('organization_id', 'integer', ['null' => true, 'default' => null])
                ->addIndex('city_id')
                ->addIndex('person_id')
                ->addIndex('organization_id')
                ->addForeignKey('city_id', 'cities', 'id')
                ->addForeignKey('person_id', 'people', 'id')
                ->addForeignKey('organization_id', 'organizations', 'id')
                ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
         $this->dropTable('addresses');
    }
}