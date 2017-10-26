<?php use Cake\I18n\Time;?>

<div class="users form large-9 medium-8 columns content">


    <?= $this->Form->create($user, ['type' => 'file']) ?>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingInfo">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#info" aria-expanded="true" aria-controls="info">
                            Información Personal
                        </a>
                    </h4>
                </div>
                <div id="info" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingInfo">
                    <div class="panel-body">
                        <fieldset>
                            <?php
                                echo $this->Form->input('User.role_id', ['options' => $roles, 'label' => 'Rol', 'onchange' => 'Javascript:validateMechanic();', 'id' => 'role_id', 'default' => $user->role_id, 'required' => true, 'disabled']);
                                echo $this->Form->input('User.name', ['label' => 'Nombre', 'value' => $user->name, 'required' => true]);
                                echo $this->Form->input('User.last_name',  ['label' => 'Apellido', 'value' => $user->last_name, 'required' => true]);
                                echo $this->Form->input('User.sex', [ 'label'=> 'Sexo','type' => 'select', 'options' => ['m' => 'Hombre', 'f' => 'Mujer'],  'empty' => 'Selecciona un género', 'value' => $user->sex, 'required' => true]);
                                if($user->photo_url != '')
                                {
                                    echo $this->Form->label('User.photo_data', 'Foto de Perfil');
                                    echo $this->Form->file('User.photo_data', ['label' => 'Foto de perfil']);
                                    echo $this->Html->image($user->photo_url, ['style' => 'width:80px;', 'id' => 'profile-pic']);
                                    echo $this->Form->button('Borrar foto', ['type' => 'button', 'onclick' => 'Javascript:deletePhoto();', 'id' => 'delete-foto-button']);
                                }
                                else
                                {
                                    echo $this->Form->label('User.photo_data', 'Foto de Perfil');
                                    echo $this->Form->file('User.photo_data', ['label' => 'Foto de perfil']);
                                }
                                echo $this->Form->input('User.phone1',  ['label' => 'Fono 1', 'value' => $user->phone1, 'required' => true, 'onkeyup' => 'Javascript:validate(this);']);
                                echo $this->Form->input('User.phone2',  ['label' => 'Fono 2', 'value' => $user->phone2]);
                               
                                echo $this->Form->input('User.city_id', [ 'label'=> 'Ciudad', 'type' => 'select', 'options' => $cities, 'default' => $user->city_id, 'required' => true] );
                                 echo $this->Form->input('User.commune_id', ['label'=> 'Comuna', 'type' => 'select', 'options' => $communes, 'empty' => 'Selecciona una comuna', 'required' => true, 'default' => $user->commune_id] );
                                echo $this->Form->input('User.password', ['label' => 'Contraseña', 'value' => $user->password]);
                                echo $this->Form->input('User.email',  ['label' => 'Email', 'value' => $user->email]);
                                echo $this->Form->input('User.active', ['label' => 'Activo' , 'default' => $user->active]);
                            ?>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingCommunes">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#communes" aria-expanded="true" aria-controls="communes">
                            Comunas Asociadas
                        </a>
                    </h4>
                </div>
                <div id="communes" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingCommunes">
                    <div class="panel-body">
                        <?php if($user->role->keyword == 'mechanic'):?>
                            <fieldset id="mechanic-communes-fieldset">
                        <?php else:?>
                            <fieldset id="mechanic-communes-fieldset" style="display:none;">
                        <?php endif;?>
                        

                            <?= $this->Form->label('UsersCommunes.commune_id', 'Comunas para mecanico');?>
                            <?= $this->Form->select('UsersCommunes.commune_id', $communes, ['multiple' => true, 'id' => 'mechanic_commune_id', 'default' => $ids]);?>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingCalendar">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#calendar" aria-expanded="true" aria-controls="calendar">
                            Calendario
                        </a>
                    </h4>
                </div>
                <div id="calendar" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingCalendar">
                    <div class="panel-body">
                        <table id="schedules-table">
                            <tr class="text-center">
                                <th></th>
                                <th><?= __('Lunes'); ?></th>
                                <th><?= __('Martes'); ?></th>
                                <th><?= __('Miercoles'); ?></th>
                                <th><?= __('Jueves'); ?></th>
                                <th><?= __('Viernes'); ?></th>
                                <th><?= __('Sábado'); ?></th>
                                <th><?= __('Domingo'); ?></th>
                            </tr>
                                
                            <?php for($x=0; $x < 24; $x++):?>
                                <?php
                                    $start_time = strptime($x, '%H');

                                    if(strlen($start_time['tm_hour']) == 1)
                                    {
                                        $start_time['tm_hour'] = '0'.$start_time['tm_hour'];
                                    }

                                    $end_time = strptime($x, '%H');

                                    if(strlen($end_time['tm_hour']) == 1)
                                    {
                                        $end_time['tm_hour'] = '0'.$end_time['tm_hour'];
                                    }
                                ?>
                                <tr>
                                    <td><?= $start_time['tm_hour'].':00 - '.$end_time['tm_hour'].':59'; ?></td>
                                    <?php for($d = 1; $d < 8; $d++):?>

                                        <?php if(count($user->schedules) > 0):?>
                                            <?php $exist = 0;?>
                                            <?php foreach($user->schedules as $schedule):?>
                                                <?php if($schedule->day_of_week == $d && $schedule->start_hour->format('H:i:s') == $start_time['tm_hour'].':00:00' && $schedule->end_hour->format('H:i:s') == $end_time['tm_hour'].':59:59'):?>

                                                    <td class="text-center">
                                                        <?= $this->Form->hidden('Schedules.'.$d.'.'.$x.'.id', ['value' => $schedule->id]); ?>
                                                        <?= $this->Form->hidden('Schedules.'.$d.'.'.$x.'.user_id', ['value' => $schedule->user_id]); ?>
                                                        <?= $this->Form->hidden('Schedules.'.$d.'.'.$x.'.day_of_week', ['value' => $schedule->day_of_week]); ?>
                                                        <?= $this->Form->hidden('Schedules.'.$d.'.'.$x.'.start_hour', ['value' => $schedule->start_hour->format('H:i:s')]); ?>   
                                                        <?= $this->Form->hidden('Schedules.'.$d.'.'.$x.'.end_hour', ['value' => $schedule->end_hour->format('H:i:s')]); ?>
                                                        <?= $this->Form->checkbox('Schedules.'.$d.'.'.$x.'.is_available', ['checked' => 'checked']); ?>
                                                        <?= $this->Form->hidden('Schedules.'.$d.'.'.$x.'.active', ['value' => 1]); ?>
                                                    </td>
                                                    <?php $exist = 1;?>
                                                    <?php break;?>
                                                <?php endif;?>
                                            <?php endforeach;?>

                                            <?php if($exist == 0):?>
                                                <td class="text-center">
                                                    <?= $this->Form->hidden('Schedules.'.$d.'.'.$x.'.user_id', ['value' => $user->id]); ?>
                                                    <?= $this->Form->hidden('Schedules.'.$d.'.'.$x.'.day_of_week', ['value' => $d]); ?>
                                                    <?= $this->Form->hidden('Schedules.'.$d.'.'.$x.'.start_hour', ['value' => $start_time['tm_hour'].':00:00']); ?>   
                                                    <?= $this->Form->hidden('Schedules.'.$d.'.'.$x.'.end_hour', ['value' => $end_time['tm_hour'].':59:59']); ?>
                                                    <?= $this->Form->checkbox('Schedules.'.$d.'.'.$x.'.is_available'); ?>
                                                    <?= $this->Form->hidden('Schedules.'.$d.'.'.$x.'.active', ['value' => 1]); ?>
                                                </td>
                                            <?php endif;?>
                                        <?php else:?>
                                            <td class="text-center">
                                                <?= $this->Form->hidden('Schedules.'.$d.'.'.$x.'.user_id', ['value' => $user->id]); ?>
                                                <?= $this->Form->hidden('Schedules.'.$d.'.'.$x.'.day_of_week', ['value' => $d]); ?>
                                                <?= $this->Form->hidden('Schedules.'.$d.'.'.$x.'.start_hour', ['value' => $start_time['tm_hour'].':00:00']); ?>   
                                                <?= $this->Form->hidden('Schedules.'.$d.'.'.$x.'.end_hour', ['value' => $end_time['tm_hour'].':59:59']); ?>
                                                <?= $this->Form->checkbox('Schedules.'.$d.'.'.$x.'.is_available'); ?>
                                                <?= $this->Form->hidden('Schedules.'.$d.'.'.$x.'.active', ['value' => 1]); ?>
                                            </td>
                                        <?php endif;?> 
                                    <?php endfor;?>
                                </tr>
                            <?php endfor;?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<?= $this->Html->css('bootstrap.min.css');?>
<?= $this->Html->script('https://code.jquery.com/jquery-2.2.4.js');?>
<?= $this->Html->script('bootstrap.min.js');?>
<script>
    

    function validateMechanic()
    {
        if($('#role_id').val() == 6)
        {
            $('#mechanic-communes-fieldset').show();
        }
        else
        {
            $('#mechanic-communes-fieldset').hide();
            $('#mechanic_commune_id > option').removeAttr("selected");
        }
    }

    <?php if($user->photo_url != ''):?>
        function deletePhoto()
        {
            if(confirm('¿Estas seguro de eliminar la foto de perfil?'))
            {
                $.ajax({
                    url: <?php echo "'".$this->Url->build('/users/deletePhoto/'.$user->id)."'";?>, 
                    success: function(data){
                    }
                });
                
                alert('Foto eliminada');
                $('#delete-foto-button').hide();
                $('#profile-pic').hide();
            }
        }
    <?php endif;?>

    function validate(evt){
        evt.value = evt.value.replace(/[^0-9]/g,"");
    }
</script>
