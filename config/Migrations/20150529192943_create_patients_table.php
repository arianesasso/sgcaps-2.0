<?php

use Phinx\Migration\AbstractMigration;

class CreatePatientsTable extends AbstractMigration
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
        $this->table('patients')
                ->addColumn('person_id', 'integer', ['null' => false])
                ->addColumn('cns', 'integer', ['length' => 20, 'null' => true, 'default' => null])
                ->addColumn('marital_status', 'string', ['length' => 45, 'null' => true, 'default' => null])
                ->addColumn('approximate_age', 'integer', ['length' => 3, 'null' => true, 'default' => null])
                ->addColumn('ethnicity', 'string', ['length' => 45, 'null' => true, 'default' => null])
                ->addColumn('observation', 'text', ['null' => true, 'default' => null])
                ->addColumn('created', 'datetime', ['null' => false])
                ->addColumn('modified', 'datetime', ['null' => false])
                ->addIndex('person_id')
                ->addForeignKey('person_id', 'people', 'id')
                ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->dropTable('patients');
    }
}