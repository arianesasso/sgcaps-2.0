<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ActionsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ActionsController Test Case
 */
class ActionsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.actions',
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
        'app.actions_roles'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
