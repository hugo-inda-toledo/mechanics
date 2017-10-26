<?php
use Migrations\AbstractSeed;

/**
 * PaymentMethods seed.
 */
class PaymentMethodsSeed extends AbstractSeed
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
                'type_payment' => 'Webpay',
                'keyword' => 'webpay',
                'token' => NULL,
                'active' => '1',
                'created' => NULL,
                'modified' => NULL,
            ],
        ];

        $table = $this->table('payment_methods');
        $table->insert($data)->save();
    }
}
