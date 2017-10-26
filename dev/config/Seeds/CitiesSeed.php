<?php
use Migrations\AbstractSeed;

/**
 * Cities seed.
 */
class CitiesSeed extends AbstractSeed
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
                'name' => 'Santiago',
                'active' => '1',
                'created' => '0000-00-00 00:00:00',
                'modified' => '0000-00-00 00:00:00',
            ],
        ];

        $table = $this->table('cities');
        $table->insert($data)->save();
    }
}
