<?php
use Migrations\AbstractMigration;

class PaymentsNewFields extends AbstractMigration
{

    public function up()
    {

        $this->table('payments')
            ->addColumn('penalty_payment', 'float', [
                'after' => 'active',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addColumn('penalty_paid', 'integer', [
                'after' => 'penalty_payment',
                'default' => null,
                'length' => 11,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('payments')
            ->removeColumn('penalty_payment')
            ->removeColumn('penalty_paid')
            ->update();
    }
}

