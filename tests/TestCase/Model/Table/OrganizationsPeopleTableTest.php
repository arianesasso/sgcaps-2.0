<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrganizationsPeopleTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrganizationsPeopleTable Test Case
 */
class OrganizationsPeopleTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.organizations_people',
        'app.people',
        'app.users',
        'app.organizations',
        'app.addresses',
        'app.contacts',
        'app.permissions',
        'app.roles',
        'app.admins',
        'app.states',
        'app.patients',
        'app.professionals'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('OrganizationsPeople') ? [] : ['className' => 'App\Model\Table\OrganizationsPeopleTable'];
        $this->OrganizationsPeople = TableRegistry::get('OrganizationsPeople', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->OrganizationsPeople);

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
