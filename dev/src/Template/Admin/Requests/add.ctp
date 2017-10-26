<section class="content-header">
    <h1>
        Nueva solicitud
        <small>Solicita un mecánico para tu problema automotríz</small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-dashboard']).' Dashboard', ['controller' => 'Pages', 'action' => 'dashboard'], ['escape' => false]); ?>
        </li>
        <li>
            <?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-wrench']).' Solicitudes', ['controller' => 'Requests', 'action' => 'index'], ['escape' => false]); ?>
        </li>
        <li class="active">Nueva Solicitud</li>
    </ol>
</section>


<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <?= $this->Form->create($request, ['id' => 'request-form']) ?>
                <div class="box">
                    <div class="box-header">
                      <h3 class="box-title">Nueva Solicitud</h3>
                    </div>
                    <div class="box-body">
                        <?php
                            echo $this->Form->label('Request.client_id', 'Cliente');
                            echo $this->Form->select('Request.client_id', $clients, ['type' => 'select', 'empty' => 'Selecciona un cliente', 'onchange' => 'Javascript:getCarsByClientId();getAddressByClientId();', 'id' => 'client-select', 'required' => true]);
                            echo '<br>';
                            echo $this->Form->input('Request.start_time_schedule_requested', ['type' => 'text', 'label' => 'Fecha de solicitud', 'id' => 'reservationtime']);
                            echo '<br>';
                            echo $this->Html->div(null, '', ['id' => 'car-select-div']);
                            echo '<br><br>';
                            echo $this->Html->div(null, '', ['id' => 'address-div']);
                        ?>

                        <fieldset id="services-fieldset" style="display:none;">
                            <?= $this->Form->label('AvailableServices.available_service_id', 'Selecciona los servicios a solicitar');?>
                            <?= $this->Form->select('AvailableServices.available_service_id', $services_list, ['multiple' => true, 'id' => 'available_service_id', 'required' => true, 'style' => 'height:300px;']);?>
                        </fieldset>
                        <strong id="available-service-id-error" class="text-danger"></strong>
                    </div>
                    <div class="box-footer">
                        <?= $this->Form->button(__('Enviar'), ['type' => 'button', 'onclick' => 'Javascript:doSubmit();', 'id' => 'send-button']) ?>
                    </div>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</section>

<?= $this->Html->script('AdminLTE./plugins/jQuery/jQuery-2.1.4.min.js');?>
<?= $this->Html->script('http://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js');?>
<?php echo $this->Html->script('AdminLTE./plugins/daterangepicker/moment'); ?>
<?= $this->Html->script('bootstrap.min.js');?>
<?php echo $this->Html->script('AdminLTE./plugins/daterangepicker/daterangepicker'); ?>
<?php echo $this->Html->css('AdminLTE./plugins/daterangepicker/daterangepicker-bs3'); ?>
<?php echo $this->Html->script('AdminLTE./plugins/datepicker/bootstrap-datepicker'); ?>
<?php echo $this->Html->script('AdminLTE./plugins/timepicker/bootstrap-timepicker.min'); ?>






<script>
    $( document ).ready(function() {
        $('#reservationtime').daterangepicker({
            "singleDatePicker": true,
            "timePicker": true,
            "timePicker24Hour": true,
            "timePickerIncrement": 60,
            "opens": "center",
            "minDate": moment().subtract(0, 'days'),
            "maxDate": moment().add(1, 'months'),
            "dateLimit": {
                "days": 30
            },
            "format": 'YYYY-MM-DD h:mm A',
            "locale": {
                "applyLabel": "Seleccionar",
                "cancelLabel": "Cancelar",
                "daysOfWeek": [
                    "Do",
                    "Lu",
                    "Ma",
                    "Mie",
                    "Jue",
                    "Vi",
                    "Sa"
                ],
                "monthNames": [
                    "Enero",
                    "Febrero",
                    "Marzo",
                    "Abril",
                    "Mayo",
                    "Junio",
                    "Julio",
                    "Agosto",
                    "Septiembre",
                    "Octubre",
                    "Noviembre",
                    "Diciembre"
                ],
                "firstDay": 1
            }
        });
    });
</script>


<script>
    function getCarsByClientId()
    {
        if($('#client-select').val() != '')
        {
            $("#car-select-div").html(<?= "'".$this->Html->image('ajax-load.gif')."'"; ?>);
            $("#services-fieldset").hide();
            $.ajax({
                url: <?php echo "'".$this->Url->build(['controller' => 'Cars', 'action' => 'getCarsByClientId'])."'";?> + '/' + $('#client-select').val(), 
                success: function(data){
                    $("#car-select-div").html(data);
                    $("#services-fieldset").show();
                    $('#available_service_id > option').removeAttr("selected");
                    
                }
            });  
        }
        else
        {
            $("#car-select-div").html('');
            $("#services-fieldset").hide();
            $('#available_service_id > option').removeAttr("selected");
        }
        
    }

    function getAddressByClientId()
    {
        if($('#client-select').val() != '')
        {
            $.ajax({
                url: <?php echo "'".$this->Url->build(['controller' => 'Users', 'action' => 'generateAddressRadioSelect'])."'";?> + '/' + $('#client-select').val(), 
                success: function(data){
                    $("#address-div").html(data);
                }
            });  
        }
        else
        {
            $("#address-div").html('');
        }
    }

    function doSubmit()
    {
        removeErrors();

        if($('#request-car-id').val() == '')
        {
            $('#car-select-div.form-group').addClass("has-error");
            $('#request-car-id-error').html('Debes seleccionar un vehiculo para la solicitud');
            $('#request-car-id').focus();
            return false;
        }

        if($('#available_service_id').val() == null)
        {
            $('#available-service-id-error').html('Debes seleccionar al menos un servicio a solicitar');
            $('#available_service_id').focus();
            return false;
        }

        $('#address-name-input').prop('disabled', false);
        $('#address-number-input').prop('disabled', false);
        $('#address-complement-input').prop('disabled', false);
        $('#city_id').prop("disabled", false);
        $('#commune_id').prop("disabled", false);

        if($('#request-form').submit())
        {
            $('#send-button').addClass('disabled');
            return true;
        }
        else
        {
            return false;
        }
    }

    function removeErrors()
    {
        $('#car-select-div.form-group').parent().removeClass("has-error");
        $('#request-car-id-error').html('');
        $('#available-service-id-error').html('');
    }
</script>
