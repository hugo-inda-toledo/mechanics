<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PurchaseOrdersReplacementsFixture
 *
 */
class PurchaseOrdersReplacementsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'purchase_order_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'replacement_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'provider_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'provider_id' => ['type' => 'index', 'columns' => ['provider_id'], 'length' => []],
            'purchase_order_id' => ['type' => 'index', 'columns' => ['purchase_order_id'], 'length' => []],
            'replacement_id' => ['type' => 'index', 'columns' => ['replacement_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'purchase_orders_replacements_ibfk_3' => ['type' => 'foreign', 'columns' => ['replacement_id'], 'references' => ['replacements', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'purchase_orders_replacements_ibfk_1' => ['type' => 'foreign', 'columns' => ['provider_id'], 'references' => ['providers', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'purchase_orders_replacements_ibfk_2' => ['type' => 'foreign', 'columns' => ['purchase_order_id'], 'references' => ['purchase_orders', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'purchase_order_id' => 1,
            'replacement_id' => 1,
            'provider_id' => 1,
            'created' => '2017-03-13 19:14:25',
            'modified' => '2017-03-13 19:14:25'
        ],
    ];
}
