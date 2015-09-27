<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ActionsRolesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ActionsRolesTable Test Case
 */
class ActionsRolesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.actions_roles',
        'app.roles',
        'app.permissions',
        'app.users',
        'app.organizations',
        'app.addresses',
        'app.contacts',
        'app.people',
        'app.states',
        'app.occupations',
        'app.patients',
        'app.professionals',
        'app.organizations_people',
        'app.admins',
        'app.actions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ActionsRoles') ? [] : ['className' => 'App\Model\Table\ActionsRolesTable'];
        $this->ActionsRoles = TableRegistry::get('ActionsRoles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ActionsRoles);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
