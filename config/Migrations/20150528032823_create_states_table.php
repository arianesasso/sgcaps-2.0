<?php

use Phinx\Migration\AbstractMigration;

class CreateStatesTable extends AbstractMigration
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
         $this->table('states')
                ->addColumn('name', 'string', ['length' => 255, 'null' => false])
                ->addColumn('acronym', 'string', ['length' => 2, 'null' => false])
                ->addIndex('acronym', ['unique' => true])
                ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
         $this->dropTable('states');
    }
}