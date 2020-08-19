<?php

use Phinx\Migration\AbstractMigration;

class CreateProfessionalsTable extends AbstractMigration
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
        $this->table('professionals')
                ->addColumn('person_id', 'integer', ['null' => false])
                ->addColumn('board_acronym', 'string', ['length' => 10, 'null' => true, 'default' => null])
                ->addColumn('board_number', 'string', ['length' => 45, 'null' => true, 'default' => null])
                ->addColumn('board_state_id', 'integer', ['null' => true, 'default' => null])
                ->addIndex('person_id')
                ->addIndex('board_state_id')
                ->addForeignKey('person_id', 'people', 'id')
                ->addForeignKey('board_state_id', 'states', 'id')
                ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->dropTable('professionals');
    }
}