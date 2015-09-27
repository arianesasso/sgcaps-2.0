<?php

use Phinx\Migration\AbstractMigration;

class CreateTableActionsRoles extends AbstractMigration
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
    public function up() {
    $this->table('actions_roles')
                ->addColumn('role_id', 'integer', ['null' => false])
                ->addColumn('action_id', 'integer', ['null' => false])
                ->addColumn('created', 'datetime', ['null' => false])
                ->addColumn('modified', 'datetime', ['null' => false])
                ->addIndex('role_id')
                ->addIndex('action_id')
                ->addForeignKey('role_id', 'roles', 'id')
                ->addForeignKey('action_id', 'actions', 'id')
                ->save();
    }

    /**
     * Migrate Down.
     */
    public function down() {
        $this->dropTable('actions_roles');
    }
}