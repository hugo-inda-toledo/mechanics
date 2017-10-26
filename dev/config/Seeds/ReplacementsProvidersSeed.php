<?php
use Migrations\AbstractSeed;

/**
 * ReplacementsProviders seed.
 */
class ReplacementsProvidersSeed extends AbstractSeed
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
                'replacement_id' => '5',
                'active' => '1',
                'default' => '1',
                'created' => '2017-03-15 15:46:56',
                'modified' => '2017-03-15 15:46:56',
            ],
            [
                'id' => '2',
                'provider_id' => '1',
                'replacement_id' => '14',
                'active' => '1',
                'default' => '1',
                'created' => '2017-03-15 15:46:56',
                'modified' => '2017-03-15 15:46:56',
            ],
            [
                'id' => '3',
                'provider_id' => '1',
                'replacement_id' => '15',
                'active' => '1',
                'default' => '1',
                'created' => '2017-03-15 15:46:56',
                'modified' => '2017-03-15 15:46:56',
            ],
            [
                'id' => '4',
                'provider_id' => '1',
                'replacement_id' => '16',
                'active' => '1',
                'default' => '1',
                'created' => '2017-03-15 15:46:56',
                'modified' => '2017-03-15 15:46:56',
            ],
            [
                'id' => '5',
                'provider_id' => '1',
                'replacement_id' => '18',
                'active' => '1',
                'default' => '1',
                'created' => '2017-03-15 15:46:56',
                'modified' => '2017-03-15 15:46:56',
            ],
            [
                'id' => '6',
                'provider_id' => '1',
                'replacement_id' => '52',
                'active' => '1',
                'default' => '1',
                'created' => '2017-03-15 15:46:56',
                'modified' => '2017-03-15 15:46:56',
            ],
            [
                'id' => '7',
                'provider_id' => '1',
                'replacement_id' => '55',
                'active' => '1',
                'default' => '1',
                'created' => '2017-03-15 15:46:56',
                'modified' => '2017-03-15 15:46:56',
            ],
            [
                'id' => '8',
                'provider_id' => '2',
                'replacement_id' => '5',
                'active' => '1',
                'default' => '0',
                'created' => '2017-03-15 15:46:56',
                'modified' => '2017-03-15 15:46:56',
            ],
            [
                'id' => '9',
                'provider_id' => '2',
                'replacement_id' => '14',
                'active' => '1',
                'default' => '0',
                'created' => '2017-03-15 15:46:56',
                'modified' => '2017-03-15 15:46:56',
            ],
            [
                'id' => '10',
                'provider_id' => '2',
                'replacement_id' => '15',
                'active' => '1',
                'default' => '0',
                'created' => '2017-03-15 15:46:56',
                'modified' => '2017-03-15 15:46:56',
            ],
            [
                'id' => '11',
                'provider_id' => '2',
                'replacement_id' => '16',
                'active' => '1',
                'default' => '0',
                'created' => '2017-03-15 15:46:56',
                'modified' => '2017-03-15 15:46:56',
            ],
            [
                'id' => '12',
                'provider_id' => '2',
                'replacement_id' => '18',
                'active' => '1',
                'default' => '0',
                'created' => '2017-03-15 15:46:56',
                'modified' => '2017-03-15 15:46:56',
            ],
            [
                'id' => '13',
                'provider_id' => '2',
                'replacement_id' => '52',
                'active' => '1',
                'default' => '0',
                'created' => '2017-03-15 15:46:56',
                'modified' => '2017-03-15 15:46:56',
            ],
            [
                'id' => '14',
                'provider_id' => '2',
                'replacement_id' => '55',
                'active' => '1',
                'default' => '0',
                'created' => '2017-03-15 15:46:56',
                'modified' => '2017-03-15 15:46:56',
            ],
        ];

        $table = $this->table('replacements_providers');
        $table->insert($data)->save();
    }
}
