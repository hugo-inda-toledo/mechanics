<?php
use Migrations\AbstractMigration;

class RequestsNewField extends AbstractMigration
{

    public function up()
    {
    	$this->table('requests')
            ->addColumn('sent_to_bill', 'integer', [
                'after' => 'ot_code',
                'default' => 0,
                'length' => 11,
                'null' => false,
            ])
            
            ->update();
    }

    public function down()
    {
    	$this->table('requests')
            ->removeColumn('sent_to_bill')
            ->update();
    }
}

