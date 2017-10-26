<?php
use Migrations\AbstractSeed;

/**
 * Roles seed.
 */
class RolesSeed extends AbstractSeed
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
                'name' => 'Super Admin',
                'description' => 'Super Administrador',
                'keyword' => 'super_admin',
                'active' => '1',
                'created' => '0000-00-00 00:00:00',
                'modified' => '0000-00-00 00:00:00',
            ],
            [
                'id' => '2',
                'name' => 'Admin Básico',
                'description' => 'Administrador Básico',
                'keyword' => 'basic_admin',
                'active' => '1',
                'created' => '0000-00-00 00:00:00',
                'modified' => '0000-00-00 00:00:00',
            ],
            [
                'id' => '3',
                'name' => 'Admin Medio',
                'description' => 'Administrador Medio',
                'keyword' => 'medium_admin',
                'active' => '1',
                'created' => '0000-00-00 00:00:00',
                'modified' => '0000-00-00 00:00:00',
            ],
            [
                'id' => '4',
                'name' => 'Admin Avanzado',
                'description' => 'Administrador Avanzado',
                'keyword' => 'advanced_admin',
                'active' => '1',
                'created' => '0000-00-00 00:00:00',
                'modified' => '0000-00-00 00:00:00',
            ],
            [
                'id' => '5',
                'name' => 'Cliente',
                'description' => 'Cliente',
                'keyword' => 'client',
                'active' => '1',
                'created' => '0000-00-00 00:00:00',
                'modified' => '0000-00-00 00:00:00',
            ],
            [
                'id' => '6',
                'name' => 'Mecánico',
                'description' => 'Mecánico',
                'keyword' => 'mechanic',
                'active' => '1',
                'created' => '0000-00-00 00:00:00',
                'modified' => '0000-00-00 00:00:00',
            ],
        ];

        $table = $this->table('roles');
        $table->insert($data)->save();
    }
}
