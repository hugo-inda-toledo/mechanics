<?php
use Migrations\AbstractSeed;

/**
 * CarModels seed.
 */
class CarModelsSeed extends AbstractSeed
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
                'car_brand_id' => '5',
                'model_name' => 'Spark LT',
                'active' => '1',
                'created' => '2017-03-09 17:27:59',
                'modified' => '2017-03-09 17:27:59',
            ],
        ];

        $table = $this->table('car_models');
        $table->insert($data)->save();
    }
}
