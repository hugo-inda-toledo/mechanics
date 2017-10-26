<?php
use Migrations\AbstractSeed;

/**
 * ReportQuestionCategories seed.
 */
class ReportQuestionCategoriesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'name' => 'PreCompra',
                'description' => 'Listado de preguntas para Informe de Precompra',
                'created' => '2017-02-24 13:45:08',
                'modified' => '2017-02-24 13:46:00',
                'active' => '1',
            ],
            [
                'id' => '2',
                'name' => 'Salud',
                'description' => 'Listado de preguntas para Informe de Salud',
                'created' => '2017-02-24 13:45:30',
                'modified' => '2017-02-24 13:45:30',
                'active' => '1',
            ],
            [
                'id' => '3',
                'name' => 'Servicio',
                'description' => 'Listado de preguntas para Informe de Servicio',
                'created' => '2017-02-24 13:45:48',
                'modified' => '2017-02-24 13:45:48',
                'active' => '1',
            ],
        ];

        $table = $this->table('report_question_categories');
        $table->insert($data)->save();
    }
}
