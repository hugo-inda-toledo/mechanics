<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Requests Available Services'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Requests'), ['controller' => 'Requests', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Request'), ['controller' => 'Requests', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Available Services'), ['controller' => 'AvailableServices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Available Service'), ['controller' => 'AvailableServices', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="requestsAvailableServices form large-9 medium-8 columns content">
    <?= $this->Form->create($requestsAvailableService) ?>
    <fieldset>
        <legend><?= __('Add Requests Available Service') ?></legend>
        <?php
            echo $this->Form->input('request_id', ['options' => $requests]);
            echo $this->Form->input('available_service_id', ['options' => $availableServices]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
