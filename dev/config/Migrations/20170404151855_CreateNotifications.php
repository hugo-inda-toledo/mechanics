<?php
use Migrations\AbstractMigration;

class CreateNotifications extends AbstractMigration
{

    public function up()
    {
    	$table = $this->table('notifications')
        // Campos
        ->addColumn('user_id', 'integer', [
            'limit' => 11,
            'null' => false,
        ])
        ->addColumn('title', 'string', [
            'limit' => 255,
            'null' => false,
        ])
        ->addColumn('controller', 'string', [
            'limit' => 45,
            'null' => false,
        ])
        ->addColumn('action', 'string', [
            'limit' => 45,
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
        // Foráneas
        ->addForeignKey(
            'user_id',
            'users',
            'id',
            [
                'update' => 'NO_ACTION',
                'delete' => 'NO_ACTION'
            ]
        );

        // Crear Tabla
        $table->create();
    }

    public function down()
    {
    }
}

