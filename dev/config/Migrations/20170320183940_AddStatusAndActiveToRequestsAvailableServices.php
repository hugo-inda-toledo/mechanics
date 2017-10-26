<?php
use Migrations\AbstractMigration;

class AddStatusAndActiveToRequestsAvailableServices extends AbstractMigration
{

    public function up()
    {

        $this->table('requests_available_services')
            ->addColumn('status', 'integer', [
                'after' => 'modified',
                'default' => null,
                'length' => 11,
                'null' => true,
            ])
            ->addColumn('active', 'boolean', [
                'after' => 'status',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('requests_available_services')
            ->removeColumn('status')
            ->removeColumn('active')
            ->update();
    }
}

