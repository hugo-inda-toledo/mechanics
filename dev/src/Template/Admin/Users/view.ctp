<section class="content-header">
  <h1>
    <?php echo __('User'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'index'], ['escape' => false])?>
    </li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-info"></i>
                <h3 class="box-title"><?php echo __('Information'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <dl class="dl-horizontal">
                                                                                                        <dt><?= __('Role') ?></dt>
                                <dd>
                                    <?= $user->has('role') ? $user->role->name : '' ?>
                                </dd>
                                                                                                                        <dt><?= __('Name') ?></dt>
                                        <dd>
                                            <?= h($user->name) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Last Name') ?></dt>
                                        <dd>
                                            <?= h($user->last_name) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Email') ?></dt>
                                        <dd>
                                            <?= h($user->email) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Phone1') ?></dt>
                                        <dd>
                                            <?= h($user->phone1) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Phone2') ?></dt>
                                        <dd>
                                            <?= h($user->phone2) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Address Name') ?></dt>
                                        <dd>
                                            <?= h($user->address_name) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Address Complement') ?></dt>
                                        <dd>
                                            <?= h($user->address_complement) ?>
                                        </dd>
                                                                                                                                                    <dt><?= __('Commune') ?></dt>
                                <dd>
                                    <?= $user->has('commune') ? $user->commune->name : '' ?>
                                </dd>
                                                                                                                <dt><?= __('City') ?></dt>
                                <dd>
                                    <?= $user->has('city') ? $user->city->name : '' ?>
                                </dd>
                                                                                                                                                                                                        <dt><?= __('Photo Url') ?></dt>
                                        <dd>
                                            <?= h($user->photo_url) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Sex') ?></dt>
                                        <dd>
                                            <?= h($user->sex) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Id Fcm1') ?></dt>
                                        <dd>
                                            <?= h($user->id_fcm1) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Id Fcm2') ?></dt>
                                        <dd>
                                            <?= h($user->id_fcm2) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Hash Activate') ?></dt>
                                        <dd>
                                            <?= h($user->hash_activate) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Temp Pass') ?></dt>
                                        <dd>
                                            <?= h($user->temp_pass) ?>
                                        </dd>
                                                                                                                                    
                                                                        <dt><?= __('Payment Method') ?></dt>
                            <dd>
                                <?= $user->has('payment_method') ? $this->Html->link($user->payment_method->id, ['controller' => 'UsersPaymentMethods', 'action' => 'view', $user->payment_method->id]) : '' ?>
                            </dd>
                                                                    
                                                                                                                                                            <dt><?= __('Address Number') ?></dt>
                                <dd>
                                    <?= $this->Number->format($user->address_number) ?>
                                </dd>
                                                                                                
                                                                                                                                                                                                
                                                                        <dt><?= __('Active') ?></dt>
                            <dd>
                            <?= $user->active ? __('Yes') : __('No'); ?>
                            </dd>
                                                                    
                                    </dl>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- ./col -->
</div>
<!-- div -->

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['Answered Surveys']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($user->answered_surveys)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Survey Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    User Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Request Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Active
                                    </th>
                                        
                                                                                                                                            
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($user->answered_surveys as $answeredSurveys): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($answeredSurveys->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($answeredSurveys->survey_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($answeredSurveys->user_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($answeredSurveys->request_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($answeredSurveys->active) ?>
                                    </td>
                                                                                                            
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'AnsweredSurveys', 'action' => 'view', $answeredSurveys->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'AnsweredSurveys', 'action' => 'edit', $answeredSurveys->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'AnsweredSurveys', 'action' => 'delete', $answeredSurveys->id], ['confirm' => __('Are you sure you want to delete # {0}?', $answeredSurveys->id), 'class'=>'btn btn-danger btn-xs']) ?>    
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                                    
                        </tbody>
                    </table>

                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['Cars']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($user->cars)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    User Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Car Brand Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Car Model Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Patent
                                    </th>
                                        
                                                                    
                                    <th>
                                    Year
                                    </th>
                                        
                                                                    
                                    <th>
                                    Mileage
                                    </th>
                                        
                                                                    
                                    <th>
                                    Active
                                    </th>
                                        
                                                                                                                                            
                                    <th>
                                    Observations
                                    </th>
                                        
                                                                    
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($user->cars as $cars): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($cars->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($cars->user_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($cars->car_brand_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($cars->car_model_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($cars->patent) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($cars->year) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($cars->mileage) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($cars->active) ?>
                                    </td>
                                                                                                                                                
                                    <td>
                                    <?= h($cars->observations) ?>
                                    </td>
                                    
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Cars', 'action' => 'view', $cars->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Cars', 'action' => 'edit', $cars->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Cars', 'action' => 'delete', $cars->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cars->id), 'class'=>'btn btn-danger btn-xs']) ?>    
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                                    
                        </tbody>
                    </table>

                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['Schedules']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($user->schedules)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    User Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Day Of Week
                                    </th>
                                        
                                                                    
                                    <th>
                                    Start Hour
                                    </th>
                                        
                                                                    
                                    <th>
                                    End Hour
                                    </th>
                                        
                                                                    
                                    <th>
                                    Is Available
                                    </th>
                                        
                                                                    
                                    <th>
                                    Active
                                    </th>
                                        
                                                                                                                                            
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($user->schedules as $schedules): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($schedules->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($schedules->user_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($schedules->day_of_week) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($schedules->start_hour) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($schedules->end_hour) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($schedules->is_available) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($schedules->active) ?>
                                    </td>
                                                                                                            
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Schedules', 'action' => 'view', $schedules->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Schedules', 'action' => 'edit', $schedules->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Schedules', 'action' => 'delete', $schedules->id], ['confirm' => __('Are you sure you want to delete # {0}?', $schedules->id), 'class'=>'btn btn-danger btn-xs']) ?>    
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                                    
                        </tbody>
                    </table>

                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['Session']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($user->session)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    User Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Active
                                    </th>
                                        
                                                                                                                                            
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($user->session as $session): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($session->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($session->user_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($session->active) ?>
                                    </td>
                                                                                                            
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Session', 'action' => 'view', $session->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Session', 'action' => 'edit', $session->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Session', 'action' => 'delete', $session->id], ['confirm' => __('Are you sure you want to delete # {0}?', $session->id), 'class'=>'btn btn-danger btn-xs']) ?>    
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                                    
                        </tbody>
                    </table>

                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['User Abilities']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($user->user_abilities)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    User Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Ability Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Type
                                    </th>
                                        
                                                                    
                                    <th>
                                    Name
                                    </th>
                                        
                                                                    
                                    <th>
                                    Certification
                                    </th>
                                        
                                                                    
                                    <th>
                                    Active
                                    </th>
                                        
                                                                                                                                            
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($user->user_abilities as $userAbilities): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($userAbilities->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($userAbilities->user_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($userAbilities->ability_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($userAbilities->type) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($userAbilities->name) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($userAbilities->certification) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($userAbilities->active) ?>
                                    </td>
                                                                                                            
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'UserAbilities', 'action' => 'view', $userAbilities->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'UserAbilities', 'action' => 'edit', $userAbilities->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserAbilities', 'action' => 'delete', $userAbilities->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userAbilities->id), 'class'=>'btn btn-danger btn-xs']) ?>    
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                                    
                        </tbody>
                    </table>

                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['Workloads']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($user->workloads)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    User Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Date Init
                                    </th>
                                        
                                                                    
                                    <th>
                                    Date End
                                    </th>
                                        
                                                                                                                                            
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($user->workloads as $workloads): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($workloads->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($workloads->user_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($workloads->date_init) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($workloads->date_end) ?>
                                    </td>
                                                                                                            
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Workloads', 'action' => 'view', $workloads->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Workloads', 'action' => 'edit', $workloads->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Workloads', 'action' => 'delete', $workloads->id], ['confirm' => __('Are you sure you want to delete # {0}?', $workloads->id), 'class'=>'btn btn-danger btn-xs']) ?>    
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                                    
                        </tbody>
                    </table>

                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['Communes']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($user->communes)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Name
                                    </th>
                                        
                                                                    
                                    <th>
                                    Active
                                    </th>
                                        
                                                                                                                                            
                                    <th>
                                    City Id
                                    </th>
                                        
                                                                    
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($user->communes as $communes): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($communes->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($communes->name) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($communes->active) ?>
                                    </td>
                                                                                                                                                
                                    <td>
                                    <?= h($communes->city_id) ?>
                                    </td>
                                    
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Communes', 'action' => 'view', $communes->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Communes', 'action' => 'edit', $communes->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Communes', 'action' => 'delete', $communes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $communes->id), 'class'=>'btn btn-danger btn-xs']) ?>    
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                                    
                        </tbody>
                    </table>

                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['Tools']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($user->tools)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Name
                                    </th>
                                        
                                                                    
                                    <th>
                                    Description
                                    </th>
                                        
                                                                    
                                    <th>
                                    Active
                                    </th>
                                        
                                                                                                                                            
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($user->tools as $tools): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($tools->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($tools->name) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($tools->description) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($tools->active) ?>
                                    </td>
                                                                                                            
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Tools', 'action' => 'view', $tools->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Tools', 'action' => 'edit', $tools->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tools', 'action' => 'delete', $tools->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tools->id), 'class'=>'btn btn-danger btn-xs']) ?>    
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                                    
                        </tbody>
                    </table>

                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['Payment Refunds']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($user->payment_refunds)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Bank Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Account Number
                                    </th>
                                        
                                                                    
                                    <th>
                                    Dni
                                    </th>
                                        
                                                                    
                                    <th>
                                    Name
                                    </th>
                                        
                                                                    
                                    <th>
                                    Email
                                    </th>
                                        
                                                                                                                                            
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($user->payment_refunds as $paymentRefunds): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($paymentRefunds->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($paymentRefunds->bank_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($paymentRefunds->account_number) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($paymentRefunds->dni) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($paymentRefunds->name) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($paymentRefunds->email) ?>
                                    </td>
                                                                                                            
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'PaymentRefunds', 'action' => 'view', $paymentRefunds->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'PaymentRefunds', 'action' => 'edit', $paymentRefunds->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'PaymentRefunds', 'action' => 'delete', $paymentRefunds->id], ['confirm' => __('Are you sure you want to delete # {0}?', $paymentRefunds->id), 'class'=>'btn btn-danger btn-xs']) ?>    
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                                    
                        </tbody>
                    </table>

                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
