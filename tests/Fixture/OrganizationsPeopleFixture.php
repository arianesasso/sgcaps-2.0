<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrganizationsPeopleFixture
 *
 */
class OrganizationsPeopleFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'organizations_people';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'person_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'organization_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'ended' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'person_id' => ['type' => 'index', 'columns' => ['person_id'], 'length' => []],
            'organization_id' => ['type' => 'index', 'columns' => ['organization_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'organizations_people_ibfk_1' => ['type' => 'foreign', 'columns' => ['person_id'], 'references' => ['people', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'organizations_people_ibfk_2' => ['type' => 'foreign', 'columns' => ['organization_id'], 'references' => ['organizations', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'person_id' => 1,
            'organization_id' => 1,
            'created' => '2015-06-04 21:51:12',
            'ended' => '2015-06-04 21:51:12'
        ],
    ];
}
