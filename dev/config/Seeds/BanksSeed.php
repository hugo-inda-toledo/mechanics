<?php
use Migrations\AbstractSeed;

/**
 * Banks seed.
 */
class BanksSeed extends AbstractSeed
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
                'short_name' => 'Banco BBVA',
                'long_name' => 'Banco Bilbao Vizcaya Argentaria, Chile',
                'active' => '1',
                'enabled_to_export' => '0',
                'origin_account_number' => NULL,
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:41',
            ],
            [
                'id' => '2',
                'short_name' => 'Banco Bice',
                'long_name' => 'Banco Bice',
                'active' => '1',
                'enabled_to_export' => '0',
                'origin_account_number' => NULL,
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
            [
                'id' => '3',
                'short_name' => 'Banco Itau',
                'long_name' => 'Banco Itau Chile',
                'active' => '1',
                'enabled_to_export' => '0',
                'origin_account_number' => NULL,
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
            [
                'id' => '4',
                'short_name' => 'Banco de Chile - CITIBANK',
                'long_name' => 'Banco de Chile - CITIBANK',
                'active' => '1',
                'enabled_to_export' => '0',
                'origin_account_number' => NULL,
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
            [
                'id' => '5',
                'short_name' => 'Corpbanca',
                'long_name' => 'Corpbanca',
                'active' => '1',
                'enabled_to_export' => '0',
                'origin_account_number' => NULL,
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
            [
                'id' => '6',
                'short_name' => 'Banco BCI',
                'long_name' => 'Banco de Credito e Inversiones',
                'active' => '1',
                'enabled_to_export' => '0',
                'origin_account_number' => NULL,
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
            [
                'id' => '7',
                'short_name' => 'Banco del Desarrollo',
                'long_name' => 'Banco del Desarrollo',
                'active' => '1',
                'enabled_to_export' => '0',
                'origin_account_number' => NULL,
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
            [
                'id' => '8',
                'short_name' => 'Banco Estado',
                'long_name' => 'Banco del Estado de Chile',
                'active' => '1',
                'enabled_to_export' => '0',
                'origin_account_number' => NULL,
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
            [
                'id' => '9',
                'short_name' => 'Banco Security',
                'long_name' => 'Banco Security',
                'active' => '1',
                'enabled_to_export' => '0',
                'origin_account_number' => NULL,
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
            [
                'id' => '10',
                'short_name' => 'Scotiabank',
                'long_name' => 'Scotiabank Sud Americano',
                'active' => '1',
                'enabled_to_export' => '0',
                'origin_account_number' => NULL,
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
            [
                'id' => '11',
                'short_name' => 'Banco Santander',
                'long_name' => 'Banco Santander-Chile',
                'active' => '1',
                'enabled_to_export' => '1',
                'origin_account_number' => '255845693',
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
            [
                'id' => '12',
                'short_name' => 'Banco Falabella',
                'long_name' => 'Banco Falabella',
                'active' => '1',
                'enabled_to_export' => '0',
                'origin_account_number' => NULL,
                'created' => '2017-02-28 15:17:38',
                'modified' => '2017-02-28 15:17:38',
            ],
        ];

        $table = $this->table('banks');
        $table->insert($data)->save();
    }
}
