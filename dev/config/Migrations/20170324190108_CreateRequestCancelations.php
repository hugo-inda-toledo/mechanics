<?php
use Migrations\AbstractMigration;

class CreateRequestCancelations extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('request_cancelations');
        $table->addColumn('request_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('request_cancelation_option_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('comment', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        // campo, tabla, campo tabla
        $table->addForeignKey(
            'request_cancelation_option_id',
            'request_cancelation_options',
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
}
