<?php
use Migrations\AbstractSeed;

/**
 * ReportQuestionGroups seed.
 */
class ReportQuestionGroupsSeed extends AbstractSeed
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
                'name' => 'Documentos',
                'description' => 'Documentos e información del Vehículo.',
                'active' => '1',
                'created' => '2017-02-24 17:42:02',
                'modified' => '2017-02-24 17:42:02',
            ],
            [
                'id' => '2',
                'name' => 'Equipamiento',
                'description' => 'Características del Vehículo (Airbags, Sensores, Dirección, etc..)',
                'active' => '1',
                'created' => '2017-02-24 17:43:15',
                'modified' => '2017-02-24 17:43:15',
            ],
            [
                'id' => '3',
                'name' => 'Motor',
                'description' => 'Componentes relacionados al Motor del Vehículo',
                'active' => '1',
                'created' => '2017-02-24 17:44:06',
                'modified' => '2017-02-24 17:44:06',
            ],
            [
                'id' => '4',
                'name' => 'Electricidad',
                'description' => 'Componentes eléctricos del Vehículo (Luces, Fusibles, Batería, etc...)',
                'active' => '1',
                'created' => '2017-02-24 17:45:10',
                'modified' => '2017-02-24 17:45:10',
            ],
            [
                'id' => '5',
                'name' => 'Interior y Exterior',
                'description' => 'componentes y Piezas generales del auto (neumático repuesto, estado parabrisas, seguro de niños, etc...)',
                'active' => '1',
                'created' => '2017-02-24 17:47:14',
                'modified' => '2017-02-24 17:47:14',
            ],
            [
                'id' => '6',
                'name' => 'Frenos',
                'description' => 'Características asociados a los frenos Vehículo (freno de mano, luz de freno, estado líquido frenos, etc...)',
                'active' => '1',
                'created' => '2017-02-24 17:48:29',
                'modified' => '2017-02-24 17:48:29',
            ],
            [
                'id' => '7',
                'name' => 'Suspención',
                'description' => 'Componentes asociados a la Suspensión del Vehículo (tren delantero, juego de masas,  llantas, etc...)',
                'active' => '1',
                'created' => '2017-02-24 17:50:32',
                'modified' => '2017-02-24 17:50:32',
            ],
            [
                'id' => '8',
                'name' => 'Carrocería',
                'description' => 'Partes metálicas/plásticas exteriores del Vehículo',
                'active' => '1',
                'created' => '2017-02-24 18:34:08',
                'modified' => '2017-02-24 18:34:08',
            ],
            [
                'id' => '9',
                'name' => 'Pruebas de Ruta',
                'description' => 'Pruebas para estudiar al vehículo en movimiento.',
                'active' => '1',
                'created' => '2017-02-24 18:36:37',
                'modified' => '2017-02-24 18:36:37',
            ],
        ];

        $table = $this->table('report_question_groups');
        $table->insert($data)->save();
    }
}
