<?php

use Phinx\Migration\AbstractMigration;

class CreateCitiesTable extends AbstractMigration
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
         $this->table('cities')
                ->addColumn('state_id', 'integer', ['null' => false])
                ->addColumn('name', 'string', ['length' => 255, 'null' => false])
                ->addIndex('state_id')
                ->addForeignKey('state_id', 'states', 'id')
                ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->dropTable('cities');
    }
}