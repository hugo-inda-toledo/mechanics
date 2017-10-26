<?php
use Migrations\AbstractSeed;

/**
 * ProvidersPaymentRefunds seed.
 */
class ProvidersPaymentRefundsSeed extends AbstractSeed
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
                'payment_refund_id' => '1',
                'created' => '2017-02-28 16:15:00',
                'modified' => '2017-02-28 16:15:03',
            ],
        ];

        $table = $this->table('providers_payment_refunds');
        $table->insert($data)->save();
    }
}
