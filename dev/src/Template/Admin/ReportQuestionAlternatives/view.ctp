<section class="content-header">
  <h1>
    <?php echo __('Report Question Alternative'); ?>
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
                                                                                                        <dt><?= __('Report Question') ?></dt>
                                <dd>
                                    <?= $reportQuestionAlternative->has('report_question') ? $reportQuestionAlternative->report_question->id : '' ?>
                                </dd>
                                                                                                                        <dt><?= __('Content') ?></dt>
                                        <dd>
                                            <?= h($reportQuestionAlternative->content) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                                            <dt><?= __('Score') ?></dt>
                                <dd>
                                    <?= $this->Number->format($reportQuestionAlternative->score) ?>
                                </dd>
                                                                                                
                                                                                                                                                                                                
                                                                        <dt><?= __('Active') ?></dt>
                            <dd>
                            <?= $reportQuestionAlternative->active ? __('Yes') : __('No'); ?>
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
                    <h3 class="box-title"><?= __('Related {0}', ['Report Question Answers']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($reportQuestionAlternative->report_question_answers)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Report Question Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Report Question Alternative Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Report Question Category Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Score
                                    </th>
                                        
                                                                                                        
                                    <th>
                                    Report Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Report Question Group Id
                                    </th>
                                        
                                                                    
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($reportQuestionAlternative->report_question_answers as $reportQuestionAnswers): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($reportQuestionAnswers->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($reportQuestionAnswers->report_question_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($reportQuestionAnswers->report_question_alternative_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($reportQuestionAnswers->report_question_category_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($reportQuestionAnswers->score) ?>
                                    </td>
                                                                                                            
                                    <td>
                                    <?= h($reportQuestionAnswers->report_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($reportQuestionAnswers->report_question_group_id) ?>
                                    </td>
                                    
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'ReportQuestionAnswers', 'action' => 'view', $reportQuestionAnswers->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'ReportQuestionAnswers', 'action' => 'edit', $reportQuestionAnswers->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ReportQuestionAnswers', 'action' => 'delete', $reportQuestionAnswers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reportQuestionAnswers->id), 'class'=>'btn btn-danger btn-xs']) ?>    
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
