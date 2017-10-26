<?php
use Migrations\AbstractMigration;

class AddFieldsToRequests extends AbstractMigration
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
        $table = $this->table('requests');
        $table->addColumn('start_time', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('finish_time', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->update();
    }
}
