<?php
use Migrations\AbstractMigration;

class RequestsMechanicModsAddFields extends AbstractMigration
{

    public function up()
    {

        $this->table('requests_mechanic_mod_items')
            ->addColumn('available_service_id', 'integer', [
                'after' => 'request_mechanic_mod_id',
                'default' => null,
                'length' => 11,
                'null' => false,
            ])
            ->addIndex(
                [
                    'available_service_id',
                ],
                [
                    'name' => 'available_service_id',
                ]
            )
            ->update();

        $this->table('requests_mechanic_mods')
            ->addColumn('total_price', 'float', [
                'after' => 'active',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addColumn('status', 'integer', [
                'after' => 'total_price',
                'default' => null,
                'length' => 11,
                'null' => true,
            ])
            ->update();

        $this->table('requests_mechanic_mod_items')
            ->addForeignKey(
                'available_service_id',
                'available_services',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();
    }

    public function down()
    {
        $this->table('requests_mechanic_mod_items')
            ->dropForeignKey(
                'available_service_id'
            );

        $this->table('requests_mechanic_mod_items')
            ->removeIndexByName('available_service_id')
            ->update();

        $this->table('requests_mechanic_mod_items')
            ->removeColumn('available_service_id')
            ->update();

        $this->table('requests_mechanic_mods')
            ->removeColumn('total_price')
            ->removeColumn('status')
            ->update();
    }
}
