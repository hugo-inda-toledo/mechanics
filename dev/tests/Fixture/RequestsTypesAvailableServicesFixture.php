<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RequestsTypesAvailableServicesFixture
 *
 */
class RequestsTypesAvailableServicesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'requests_type_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'available_service_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'fk_type_request_available_services_available_services1_idx' => ['type' => 'index', 'columns' => ['available_service_id'], 'length' => []],
            'fk_requests_types_available_services_requests_types1_idx' => ['type' => 'index', 'columns' => ['requests_type_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_type_request_available_services_available_services1' => ['type' => 'foreign', 'columns' => ['available_service_id'], 'references' => ['available_services', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_requests_types_available_services_requests_types1' => ['type' => 'foreign', 'columns' => ['requests_type_id'], 'references' => ['requests_types', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'requests_type_id' => 1,
            'available_service_id' => 1,
            'created' => '2017-02-03 14:24:48',
            'modified' => '2017-02-03 14:24:48'
        ],
    ];
}
