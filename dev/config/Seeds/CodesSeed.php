<?php
use Migrations\AbstractSeed;

/**
 * Codes seed.
 */
class CodesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'bank_id' => '11',
                'code' => '0504',
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
            [
                'id' => '2',
                'bank_id' => '11',
                'code' => '0028',
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
            [
                'id' => '3',
                'bank_id' => '11',
                'code' => '0039',
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
            [
                'id' => '4',
                'bank_id' => '11',
                'code' => '0033',
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
            [
                'id' => '5',
                'bank_id' => '11',
                'code' => '0027',
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
            [
                'id' => '6',
                'bank_id' => '11',
                'code' => '0016',
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
            [
                'id' => '7',
                'bank_id' => '11',
                'code' => '0507',
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
            [
                'id' => '8',
                'bank_id' => '11',
                'code' => '0012',
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
            [
                'id' => '9',
                'bank_id' => '11',
                'code' => '0049',
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
            [
                'id' => '10',
                'bank_id' => '11',
                'code' => '0014',
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
            [
                'id' => '11',
                'bank_id' => '11',
                'code' => '0037',
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
            [
                'id' => '12',
                'bank_id' => '11',
                'code' => '0051',
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
        ];

        $table = $this->table('codes');
        $table->insert($data)->save();
    }
}
