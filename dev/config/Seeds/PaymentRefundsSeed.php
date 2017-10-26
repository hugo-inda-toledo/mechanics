<?php
use Migrations\AbstractSeed;

/**
 * PaymentRefunds seed.
 */
class PaymentRefundsSeed extends AbstractSeed
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
                'bank_id' => '6',
                'account_number' => '80942342',
                'dni' => '76598365',
                'name' => 'Broches Chile',
                'email' => 'pagos@inalco.cl',
                'created' => '2017-02-28 15:58:49',
                'modified' => '2017-02-28 15:58:49',
            ],
            [
                'id' => '2',
                'bank_id' => '4',
                'account_number' => '652434258',
                'dni' => '98213562',
                'name' => 'Mecánico prueba cuenta de pago',
                'email' => 'mecanico@test.cl',
                'created' => '2017-02-28 15:58:49',
                'modified' => '2017-02-28 15:58:49',
            ],
        ];

        $table = $this->table('payment_refunds');
        $table->insert($data)->save();
    }
}
