<?php
use Migrations\AbstractSeed;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
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
                'role_id' => '1',
                'name' => 'Admin',
                'last_name' => 'Test',
                'email' => 'superadmin@test.cl',
                'phone1' => '+5699999999',
                'phone2' => '',
                'address_name' => 'Julio Nieto',
                'address_number' => '2005',
                'address_complement' => '',
                'commune_id' => '23',
                'city_id' => '1',
                'password' => '$2y$10$9XrzVuzbhbqfwmjgI1qRDuw4MmDl.JV7kTqOWoTH3j.fkJLZay/5C',
                'photo_url' => NULL,
                'sex' => 'm',
                'active' => '1',
                'id_fcm1' => NULL,
                'id_fcm2' => NULL,
                'created' => '2017-02-24 20:29:48',
                'modified' => '2017-02-24 20:29:48',
                'hash_activate' => '35af682deab362bfd517e014b854720a84b3f0bf',
                'temp_pass' => NULL,
            ],
            [
                'id' => '2',
                'role_id' => '5',
                'name' => 'Cliente',
                'last_name' => 'Test',
                'email' => 'cliente@test.cl',
                'phone1' => '+569777777777',
                'phone2' => '',
                'address_name' => 'Julio Nieto',
                'address_number' => '2005',
                'address_complement' => '',
                'commune_id' => '23',
                'city_id' => '1',
                'password' => '$2y$10$56y8cpUMyikjsx4Ylq1R9.AK3RuMHiQO6PoN6Ti.fZG56dFg3v0U.',
                'photo_url' => NULL,
                'sex' => 'm',
                'active' => '1',
                'id_fcm1' => NULL,
                'id_fcm2' => NULL,
                'created' => '2017-02-24 21:05:48',
                'modified' => '2017-02-24 21:05:48',
                'hash_activate' => '7504b6ba8525ac27d8d5e1668d1fb5aa798f8ccc',
                'temp_pass' => NULL,
            ],
            [
                'id' => '3',
                'role_id' => '6',
                'name' => 'Mecánico',
                'last_name' => 'Test',
                'email' => 'mecanico@test.cl',
                'phone1' => '+56988888888',
                'phone2' => '',
                'address_name' => 'Julio Nieto',
                'address_number' => '2005',
                'address_complement' => '',
                'commune_id' => '23',
                'city_id' => '1',
                'password' => '$2y$10$w6x.mhOxPEVDP.RvUhM3AeEWvzCbWNzqX6viq6YxDc7VthnG4b3Ba',
                'photo_url' => NULL,
                'sex' => 'm',
                'active' => '1',
                'id_fcm1' => NULL,
                'id_fcm2' => NULL,
                'created' => '2017-02-24 21:08:11',
                'modified' => '2017-02-24 21:08:11',
                'hash_activate' => '7b1bb36872733cb21369124f9d8dbf2ad551fc07',
                'temp_pass' => NULL,
            ],
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
