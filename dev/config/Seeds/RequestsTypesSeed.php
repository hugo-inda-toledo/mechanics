<?php
use Migrations\AbstractSeed;

/**
 * RequestsTypes seed.
 */
class RequestsTypesSeed extends AbstractSeed
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
                'name' => 'Reparación',
                'description' => NULL,
                'active' => '1',
                'created' => '0000-00-00 00:00:00',
                'modified' => '0000-00-00 00:00:00',
                'car_is_optional' => '0',
            ],
            [
                'id' => '2',
                'name' => 'Mantenimiento',
                'description' => NULL,
                'active' => '1',
                'created' => '0000-00-00 00:00:00',
                'modified' => '0000-00-00 00:00:00',
                'car_is_optional' => '0',
            ],
            [
                'id' => '3',
                'name' => 'Inspección',
                'description' => NULL,
                'active' => '1',
                'created' => '0000-00-00 00:00:00',
                'modified' => '0000-00-00 00:00:00',
                'car_is_optional' => '0',
            ],
            [
                'id' => '4',
                'name' => 'Visita para asesoría',
                'description' => 'Se solicita la visita de un mecánico.',
                'active' => '1',
                'created' => '0000-00-00 00:00:00',
                'modified' => '0000-00-00 00:00:00',
                'car_is_optional' => '1',
            ],
        ];

        $table = $this->table('requests_types');
        $table->insert($data)->save();
    }
}
