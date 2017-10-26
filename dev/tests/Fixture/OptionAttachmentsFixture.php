<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OptionAttachmentsFixture
 *
 */
class OptionAttachmentsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'election_option_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'survey_option_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'priorization_option_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'motion_option_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'name' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'type' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'size' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'dir' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'election_option_id' => ['type' => 'index', 'columns' => ['election_option_id'], 'length' => []],
            'motion_option_id' => ['type' => 'index', 'columns' => ['motion_option_id'], 'length' => []],
            'priorization_option_id' => ['type' => 'index', 'columns' => ['priorization_option_id'], 'length' => []],
            'survey_option_id' => ['type' => 'index', 'columns' => ['survey_option_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'option_attachments_ibfk_1' => ['type' => 'foreign', 'columns' => ['election_option_id'], 'references' => ['election_options', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'option_attachments_ibfk_2' => ['type' => 'foreign', 'columns' => ['motion_option_id'], 'references' => ['motion_options', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'option_attachments_ibfk_3' => ['type' => 'foreign', 'columns' => ['priorization_option_id'], 'references' => ['priorization_options', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'option_attachments_ibfk_4' => ['type' => 'foreign', 'columns' => ['survey_option_id'], 'references' => ['survey_options', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'election_option_id' => 1,
            'survey_option_id' => 1,
            'priorization_option_id' => 1,
            'motion_option_id' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
            'type' => 'Lorem ipsum dolor sit amet',
            'size' => 1,
            'dir' => 'Lorem ipsum dolor sit amet',
            'created' => '2016-10-24 14:58:30',
            'modified' => '2016-10-24 14:58:30'
        ],
    ];
}
