<?php
use Migrations\AbstractMigration;

class RequestsMechanicModsTable extends AbstractMigration
{

    public function up()
    {

        $this->table('requests_mechanic_mod_items')
            ->addColumn('request_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('request_mechanic_mod_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('active', 'boolean', [
                'default' => true,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'request_id',
                ]
            )
            ->addIndex(
                [
                    'request_mechanic_mod_id',
                ]
            )
            ->create();

        $this->table('requests_mechanic_mods')
            ->addColumn('request_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('mechanic_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('active', 'boolean', [
                'default' => true,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'mechanic_id',
                ]
            )
            ->addIndex(
                [
                    'request_id',
                ]
            )
            ->create();

        $this->table('requests_mechanic_mod_items')
            ->addForeignKey(
                'request_id',
                'requests',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'request_mechanic_mod_id',
                'requests_mechanic_mods',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();

        $this->table('requests_mechanic_mods')
            ->addForeignKey(
                'mechanic_id',
                'users',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'request_id',
                'requests',
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
                'request_id'
            )
            ->dropForeignKey(
                'request_mechanic_mod_id'
            );

        $this->table('requests_mechanic_mods')
            ->dropForeignKey(
                'mechanic_id'
            )
            ->dropForeignKey(
                'request_id'
            );

        $this->dropTable('requests_mechanic_mod_items');

        $this->dropTable('requests_mechanic_mods');
    }
}
