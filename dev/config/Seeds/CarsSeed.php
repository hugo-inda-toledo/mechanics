<?php
use Migrations\AbstractSeed;

/**
 * Cars seed.
 */
class CarsSeed extends AbstractSeed
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
                'user_id' => '2',
                'car_brand_id' => '5',
                'car_model_id' => '1',
                'patent' => 'FSVG97',
                'year' => '2013',
                'mileage' => '90000',
                'active' => '1',
                'created' => '2017-02-24 21:09:36',
                'modified' => '2017-02-24 21:09:36',
                'observations' => NULL,
            ],
        ];

        $table = $this->table('cars');
        $table->insert($data)->save();
    }
}
