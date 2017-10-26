<section class="content-header">
  <h1>
    <?php echo __('Role'); ?>
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
                                                                                                                <dt><?= __('Name') ?></dt>
                                        <dd>
                                            <?= h($role->name) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Description') ?></dt>
                                        <dd>
                                            <?= h($role->description) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Keyword') ?></dt>
                                        <dd>
                                            <?= h($role->keyword) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                            
                                                                                                                                                                                                
                                                                        <dt><?= __('Active') ?></dt>
                            <dd>
                            <?= $role->active ? __('Yes') : __('No'); ?>
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
                    <h3 class="box-title"><?= __('Related {0}', ['Users']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($role->users)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Role Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Name
                                    </th>
                                        
                                                                    
                                    <th>
                                    Last Name
                                    </th>
                                        
                                                                    
                                    <th>
                                    Email
                                    </th>
                                        
                                                                    
                                    <th>
                                    Phone1
                                    </th>
                                        
                                                                    
                                    <th>
                                    Phone2
                                    </th>
                                        
                                                                    
                                    <th>
                                    Address Name
                                    </th>
                                        
                                                                    
                                    <th>
                                    Address Number
                                    </th>
                                        
                                                                    
                                    <th>
                                    Address Complement
                                    </th>
                                        
                                                                    
                                    <th>
                                    Commune Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    City Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Password
                                    </th>
                                        
                                                                    
                                    <th>
                                    Photo Url
                                    </th>
                                        
                                                                    
                                    <th>
                                    Sex
                                    </th>
                                        
                                                                    
                                    <th>
                                    Active
                                    </th>
                                        
                                                                    
                                    <th>
                                    Id Fcm1
                                    </th>
                                        
                                                                    
                                    <th>
                                    Id Fcm2
                                    </th>
                                        
                                                                                                                                            
                                    <th>
                                    Hash Activate
                                    </th>
                                        
                                                                    
                                    <th>
                                    Temp Pass
                                    </th>
                                        
                                                                    
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($role->users as $users): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($users->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($users->role_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($users->name) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($users->last_name) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($users->email) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($users->phone1) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($users->phone2) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($users->address_name) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($users->address_number) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($users->address_complement) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($users->commune_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($users->city_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($users->password) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($users->photo_url) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($users->sex) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($users->active) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($users->id_fcm1) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($users->id_fcm2) ?>
                                    </td>
                                                                                                                                                
                                    <td>
                                    <?= h($users->hash_activate) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($users->temp_pass) ?>
                                    </td>
                                    
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id), 'class'=>'btn btn-danger btn-xs']) ?>    
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
                    <h3 class="box-title"><?= __('Related {0}', ['Permissions']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($role->permissions)): ?>

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
                                    Controller
                                    </th>
                                        
                                                                    
                                    <th>
                                    Action
                                    </th>
                                        
                                                                                                                                            
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($role->permissions as $permissions): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($permissions->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($permissions->name) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($permissions->description) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($permissions->controller) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($permissions->action) ?>
                                    </td>
                                                                                                            
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Permissions', 'action' => 'view', $permissions->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Permissions', 'action' => 'edit', $permissions->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Permissions', 'action' => 'delete', $permissions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $permissions->id), 'class'=>'btn btn-danger btn-xs']) ?>    
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
