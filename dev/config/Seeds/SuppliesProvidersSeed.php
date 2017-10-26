<?php
use Migrations\AbstractSeed;

/**
 * SuppliesProviders seed.
 */
class SuppliesProvidersSeed extends AbstractSeed
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
                'provider_id' => '1',
                'supply_id' => '2',
                'created' => '2017-03-15 15:46:56',
                'modified' => '2017-03-15 15:46:56',
            ],
            [
                'id' => '2',
                'provider_id' => '1',
                'supply_id' => '8',
                'created' => '2017-03-15 15:46:56',
                'modified' => '2017-03-15 15:46:56',
            ],
            [
                'id' => '3',
                'provider_id' => '1',
                'supply_id' => '14',
                'created' => '2017-03-15 15:46:56',
                'modified' => '2017-03-15 15:46:56',
            ],
            [
                'id' => '4',
                'provider_id' => '1',
                'supply_id' => '18',
                'created' => '2017-03-15 15:46:56',
                'modified' => '2017-03-15 15:46:56',
            ],
            [
                'id' => '5',
                'provider_id' => '2',
                'supply_id' => '2',
                'created' => '0000-00-00 00:00:00',
                'modified' => '0000-00-00 00:00:00',
            ],
            [
                'id' => '6',
                'provider_id' => '2',
                'supply_id' => '8',
                'created' => '0000-00-00 00:00:00',
                'modified' => '0000-00-00 00:00:00',
            ],
            [
                'id' => '7',
                'provider_id' => '2',
                'supply_id' => '14',
                'created' => '0000-00-00 00:00:00',
                'modified' => '0000-00-00 00:00:00',
            ],
            [
                'id' => '8',
                'provider_id' => '2',
                'supply_id' => '18',
                'created' => '0000-00-00 00:00:00',
                'modified' => '0000-00-00 00:00:00',
            ],
        ];

        $table = $this->table('supplies_providers');
        $table->insert($data)->save();
    }
}
