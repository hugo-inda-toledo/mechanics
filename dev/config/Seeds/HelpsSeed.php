<?php
use Migrations\AbstractSeed;

/**
 * Roles seed.
 */
class HelpsSeed extends AbstractSeed
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
       //  revisar si existen datos
        $check = $this->fetchRow('SELECT count(*) AS q FROM helps_wheres');
        if($check['q'] == 0){
          $data1 = [
            ['id'=>1,  'where_name' => 'Frenos','active'=> true],
            ['id'=>2,  'where_name' => 'Motor','active'=> true],
            ['id'=>3,  'where_name' => 'Suspensión','active'=> true],
            ['id'=>4,  'where_name' => 'Dirección','active'=> true],
            ['id'=>5,  'where_name' => 'Transmisión','active'=> true],
            ['id'=>6,  'where_name' => 'Electricidad','active'=> true],
            ['id'=>7,  'where_name' => 'Accesorios','active'=> true],
            ['id'=>8,  'where_name' => 'Refrigeración','active'=> true],
            ['id'=>9,  'where_name' => 'A/C','active'=> true],
            ['id'=>10, 'where_name' => 'No se','active'=> true],
            ['id'=>11, 'where_name' => 'Chequeo pre Rev. técnica','active'=> true],
            ['id'=>12, 'where_name' => 'Quiero que  me contacten','active'=> true],
            ['id'=>13, 'where_name' => 'Calefacción','active'=> true],
            ['id'=>14, 'where_name' => 'Otro','active'=> true],
          ];

          $table = $this->table('helps_wheres');
          $table->insert($data1)->save();


          $data2 = [
            ['id'=>1,  'helps_where_id' => 1, 'whatsup_name' => 'Chirrido','active'=> true],
            ['id'=>2,  'helps_where_id' => 2, 'whatsup_name' => 'Ruido agudo','active'=> true],
            ['id'=>3,  'helps_where_id' => 2, 'whatsup_name' => 'Ruido grave','active'=> true],
            ['id'=>4,  'helps_where_id' => 2, 'whatsup_name' => 'Vibración','active'=> true],
            ['id'=>5,  'helps_where_id' => 2, 'whatsup_name' => 'Deja manchado','active'=> true],
            ['id'=>6,  'helps_where_id' => 2, 'whatsup_name' => 'Luz en el tablero','active'=> true],
            ['id'=>7,  'helps_where_id' => 2, 'whatsup_name' => 'Otro','active'=> true],
          ];

          $table = $this->table('helps_whatsups');
          $table->insert($data2)->save();

          $data3 = [
            ['id'=>1,  'helps_whatsup_id' => 1, 'when_name' => 'Al frenar suave','active'=> true],
            ['id'=>2,  'helps_whatsup_id' => 1, 'when_name' => 'Al frenar brusco','active'=> true],
            ['id'=>3,  'helps_whatsup_id' => 2, 'when_name' => 'a baja velocidad','active'=> true],
            ['id'=>4,  'helps_whatsup_id' => 2, 'when_name' => 'en carretera','active'=> true],
          ];

          $table = $this->table('helps_whens');
          $table->insert($data3)->save();

          $data4 = [
            ['id'=>1,  'helps_when_id' => 1, 'situation_name' => 'Siempre','active'=> true],
            ['id'=>2,  'helps_when_id' => 1, 'situation_name' => 'con lluvia','active'=> true],
            ['id'=>3,  'helps_when_id' => 2, 'situation_name' => 'siempre','active'=> true],
            ['id'=>4,  'helps_when_id' => 2, 'situation_name' => 'con lluvia','active'=> true],
          ];

          $table = $this->table('helps_situations');
          $table->insert($data4)->save();

          $data5 = [
            ['id'=>1,  'helps_situation_id' => 1, 'how_often_name' => 'siempre','active'=> true],
            ['id'=>2,  'helps_situation_id' => 2, 'how_often_name' => 'a veces','active'=> true],
            ['id'=>3,  'helps_situation_id' => 2, 'how_often_name' => 'siempre','active'=> true],
          ];

          $table = $this->table('helps_how_oftens');
          $table->insert($data5)->save();


        }

    }
}
















