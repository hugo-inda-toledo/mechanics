<?php
use Migrations\AbstractSeed;

/**
 * RequestCancelationOptions seed.
 */
class RequestCancelationOptionsSeed extends AbstractSeed
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
                'name' => 'Dirección equivocada',
                'description' => 'Dirección equivocada',
                'active' => '1',
            ],
            [
                'id' => '2',
                'name' => 'No contesta',
                'description' => 'No contesta timbre/teléfono.',
                'active' => '1',
            ],
            [
                'id' => '3',
                'name' => 'Sin condiciones mínimas',
                'description' => 'Lugar no reúne las condiciones mínimas para realizar el trabajo.',
                'active' => '1',
            ],
            [
                'id' => '4',
                'name' => 'Sin permiso',
                'description' => 'No hay permiso para trabajar.',
                'active' => '1',
            ],
            [
                'id' => '5',
                'name' => 'Vehículo no corresponde',
                'description' => 'Vehículo no corresponde al de la solicitud.',
                'active' => '1',
            ],
            [
                'id' => '6',
                'name' => 'Servicio no corresponde',
                'description' => 'Servicio solicitado no corresponde.',
                'active' => '1',
            ],
            [
                'id' => '7',
                'name' => 'No se quiere servicio',
                'description' => 'Cliente no quiere recibir el servicio.',
                'active' => '1',
            ],
            [
                'id' => '8',
                'name' => 'Otro',
                'description' => 'Otro',
                'active' => '1',
            ],
        ];

        $table = $this->table('request_cancelation_options');
        $table->insert($data)->save();
    }
}
