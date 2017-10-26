<?php
use Migrations\AbstractSeed;

/**
 * BanksCodes seed.
 */
class BanksCodesSeed extends AbstractSeed
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
                'bank_id' => '1',
                'code_id' => '1',
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
            [
                'id' => '2',
                'bank_id' => '2',
                'code_id' => '2',
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
            [
                'id' => '3',
                'bank_id' => '3',
                'code_id' => '3',
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
            [
                'id' => '4',
                'bank_id' => '4',
                'code_id' => '4',
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
            [
                'id' => '5',
                'bank_id' => '5',
                'code_id' => '5',
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
            [
                'id' => '6',
                'bank_id' => '6',
                'code_id' => '6',
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
            [
                'id' => '7',
                'bank_id' => '7',
                'code_id' => '7',
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
            [
                'id' => '8',
                'bank_id' => '8',
                'code_id' => '8',
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
            [
                'id' => '9',
                'bank_id' => '9',
                'code_id' => '9',
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
            [
                'id' => '10',
                'bank_id' => '10',
                'code_id' => '10',
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
            [
                'id' => '11',
                'bank_id' => '11',
                'code_id' => '11',
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
            [
                'id' => '14',
                'bank_id' => '12',
                'code_id' => '12',
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
        ];

        $table = $this->table('banks_codes');
        $table->insert($data)->save();
    }
}
