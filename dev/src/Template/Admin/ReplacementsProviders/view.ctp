<section class="content-header">
  <h1>
    <?php echo __('Replacements Provider'); ?>
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
                                                                                                        <dt><?= __('Provider') ?></dt>
                                <dd>
                                    <?= $replacementsProvider->has('provider') ? $replacementsProvider->provider->name : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Replacement') ?></dt>
                                <dd>
                                    <?= $replacementsProvider->has('replacement') ? $replacementsProvider->replacement->name : '' ?>
                                </dd>
                                                                                                
                                            
                                                                                                                                            
                                                                                                                                                                                                
                                                                        <dt><?= __('Active') ?></dt>
                            <dd>
                            <?= $replacementsProvider->active ? __('Yes') : __('No'); ?>
                            </dd>
                                                    <dt><?= __('Default') ?></dt>
                            <dd>
                            <?= $replacementsProvider->default ? __('Yes') : __('No'); ?>
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

</section>
