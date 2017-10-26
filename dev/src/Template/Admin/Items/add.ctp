<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Items'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Items Logs'), ['controller' => 'ItemsLogs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Items Log'), ['controller' => 'ItemsLogs', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Purcharse Order Items'), ['controller' => 'PurcharseOrderItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Purcharse Order Item'), ['controller' => 'PurcharseOrderItems', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Available Services'), ['controller' => 'AvailableServices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Available Service'), ['controller' => 'AvailableServices', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Providers'), ['controller' => 'Providers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Provider'), ['controller' => 'Providers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="items form large-9 medium-8 columns content">
    <?= $this->Form->create($item) ?>
    <fieldset>
        <legend><?= __('Add Item') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('description');
            echo $this->Form->input('quantity');
            echo $this->Form->input('cost');
            echo $this->Form->input('brand');
            echo $this->Form->input('active');
            echo $this->Form->input('available_services._ids', ['options' => $availableServices]);
            echo $this->Form->input('providers._ids', ['options' => $providers]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
