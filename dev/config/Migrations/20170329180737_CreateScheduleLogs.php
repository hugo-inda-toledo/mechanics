<?php
use Migrations\AbstractMigration;

class CreateScheduleLogs extends AbstractMigration
{

    public function up()
    {

    	$this->table('requests')
            ->addColumn('mechanic_search_count', 'integer', [
                'after' => 'sent_to_bill',
                'default' => 0,
                'length' => 11,
                'null' => false,
            ])
            ->update();


        $table = $this->table('schedule_logs');
        $table->addColumn('schedule_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('mechanic_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('request_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('notified', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('answered', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ]);

        // campo, tabla, campo tabla
        $table->addForeignKey(
            'schedule_id',
            'schedules',
            'id',
            [
                'update' => 'NO_ACTION',
                'delete' => 'NO_ACTION'
            ]
        );
        $table->addForeignKey(
            'mechanic_id',
            'users',
            'id',
            [
                'update' => 'NO_ACTION',
                'delete' => 'NO_ACTION'
            ]
        );
        $table->addForeignKey(
            'request_id',
            'requests',
            'id',
            [
                'update' => 'NO_ACTION',
                'delete' => 'NO_ACTION'
            ]
        );

        $table->create();
    }

    public function down()
    {
    	$this->table('requests')
            ->removeColumn('sent_to_bill')
            ->update();
    }
}

