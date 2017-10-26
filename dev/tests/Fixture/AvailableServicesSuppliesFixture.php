<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AvailableServicesSuppliesFixture
 *
 */
class AvailableServicesSuppliesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'available_service_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'supply_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'available_service_id' => ['type' => 'index', 'columns' => ['available_service_id'], 'length' => []],
            'supply_id' => ['type' => 'index', 'columns' => ['supply_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'available_services_supplies_ibfk_2' => ['type' => 'foreign', 'columns' => ['supply_id'], 'references' => ['supplies', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'available_services_supplies_ibfk_1' => ['type' => 'foreign', 'columns' => ['available_service_id'], 'references' => ['available_services', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'available_service_id' => 1,
            'supply_id' => 1,
            'created' => '2017-03-13 19:10:17',
            'modified' => '2017-03-13 19:10:17'
        ],
    ];
}
