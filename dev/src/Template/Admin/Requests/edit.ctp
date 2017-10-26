<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $request->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $request->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Requests'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Clients'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Client'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Requests Types'), ['controller' => 'RequestsTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Requests Type'), ['controller' => 'RequestsTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cars'), ['controller' => 'Cars', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Car'), ['controller' => 'Cars', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Communes'), ['controller' => 'Communes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Commune'), ['controller' => 'Communes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Answered Surveys'), ['controller' => 'AnsweredSurveys', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Answered Survey'), ['controller' => 'AnsweredSurveys', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Health Reports'), ['controller' => 'HealthReports', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Health Report'), ['controller' => 'HealthReports', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items Logs'), ['controller' => 'ItemsLogs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Items Log'), ['controller' => 'ItemsLogs', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Payments'), ['controller' => 'Payments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Payment'), ['controller' => 'Payments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Purcharse Orders'), ['controller' => 'PurcharseOrders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Purcharse Order'), ['controller' => 'PurcharseOrders', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Request Services'), ['controller' => 'RequestServices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Request Service'), ['controller' => 'RequestServices', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Requests Files'), ['controller' => 'RequestsFiles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Requests File'), ['controller' => 'RequestsFiles', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Available Services'), ['controller' => 'AvailableServices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Available Service'), ['controller' => 'AvailableServices', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="requests form large-9 medium-8 columns content">
    <?= $this->Form->create($request) ?>
    <fieldset>
        <legend><?= __('Edit Request') ?></legend>
        <?php
            echo $this->Form->input('client_id', ['options' => $clients]);
            echo $this->Form->input('mechanic_id', ['options' => $mechanics]);
            echo $this->Form->input('car_id', ['options' => $cars]);
            echo $this->Form->input('address_name');
            echo $this->Form->input('address_number');
            echo $this->Form->input('address_complement');
            echo $this->Form->input('city_id');
            echo $this->Form->input('commune_id', ['options' => $communes]);
            echo $this->Form->input('status');
            echo $this->Form->input('active');
            echo $this->Form->input('start_time_schedule_requested');
            echo $this->Form->input('type_documents_payment');
            echo $this->Form->input('available_services._ids', ['options' => $availableServices]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
