<section class="content-header">
    <h1>
      Sueldos Pagados
      <small>Detalle general</small>
    </h1>
    <ol class="breadcrumb">
      <li>
        <?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-dashboard']).' Dashboard', ['controller' => 'Pages', 'action' => 'dashboard'], ['escape' => false]);?>
      </li>
      <li>
        <?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-files-o']).' Reportes', ['controller' => 'Reports', 'action' => 'index'], ['escape' => false]);?>
      </li>
      <li class="active">Sueldos Pagados</li>
    </ol> 
</section>

<section class="content">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Listado de Pagos</h3>
    </div>

    <div class="box-body">
      <table class="table table-striped">
        <tbody><tr>
          <th>Orden de Trabajo</th>
          <th>Auto</th>
          <th>Cliente</th>
          <th>Mecánico</th>
          <th>Servicios a realizar</th>
          <th>Pago total</th>
          <th>Pago mecánico</th>
        </tr>
        <?php foreach($done_payments as $payment):?>
          <tr>
            <td><?= $payment->request->ot_code;?></td>
            <td><?= '('.$payment->request->car->year.') '.$payment->request->car->car_brand->brand_name.' '.$payment->request->car->car_model->model_name.' ['.$payment->request->car->patent.']';?></td>
            <td><?= $payment->request->client->name.' '.$payment->request->client->last_name;?></td>
            <td><?= $payment->request->mechanic->name.' '.$payment->request->mechanic->last_name;?></td>
            <td>
              <?php foreach($payment->request->available_services as $service):?>
                <?= $this->Html->tag('span', $service->name, ['class' => 'label label-primary']).'<br>';?>
              <?php endforeach;?>
            </td>
            <td><?= $this->Number->format($payment->amount, ['before' => '$ ','after' => ' CLP']);?></td>
            <td><?= $this->Number->format($payment->amount_mechanic, ['before' => '$ ','after' => ' CLP']);?></td>
          </tr>
        <?php endforeach;?>
      </tbody>
      </table>
    </div>
    
    <div class="box-footer">
      <?= $this->Html->link('< Volver a buscar', ['controller' => 'Payments', 'action' => 'salaryPaidSearch'], ['class' => 'btn btn-default']);?>

      <?= $this->Form->postLink($this->Html->tag('i', '', ['class' => 'fa fa-file-excel-o']).' Exportar', ['controller' => 'Payments', 'action' => 'salaryPaidResultExport', '_ext'=>'xlsx'], ['data' => array('year' => $year, 'month' => $month), 'class' => 'btn btn-success', 'escape' => false])?>
    </div>
  </div>
</section>
