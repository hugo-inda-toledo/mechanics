<?php
use Migrations\AbstractMigration;

class AddIsModToRequestAvailableServices extends AbstractMigration
{

    public function up()
    {

        $this->table('requests_available_services')
            ->removeColumn('status')
            ->update();
    }

    public function down()
    {

        $this->table('requests_available_services')
            ->addColumn('status', 'integer', [
                'after' => 'modified',
                'default' => null,
                'length' => 11,
                'null' => true,
            ])
            ->update();
    }
}
