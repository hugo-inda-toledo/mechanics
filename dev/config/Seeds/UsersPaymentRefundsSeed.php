<?php
use Migrations\AbstractSeed;

/**
 * UsersPaymentRefunds seed.
 */
class UsersPaymentRefundsSeed extends AbstractSeed
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
                'user_id' => '3',
                'payment_refund_id' => '2',
                'created' => '2017-02-28 15:58:49',
                'modified' => '2017-02-28 15:58:49',
            ],
        ];

        $table = $this->table('users_payment_refunds');
        $table->insert($data)->save();
    }
}
