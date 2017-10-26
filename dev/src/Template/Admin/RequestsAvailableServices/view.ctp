<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Requests Available Service'), ['action' => 'edit', $requestsAvailableService->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Requests Available Service'), ['action' => 'delete', $requestsAvailableService->id], ['confirm' => __('Are you sure you want to delete # {0}?', $requestsAvailableService->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Requests Available Services'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Requests Available Service'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Requests'), ['controller' => 'Requests', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Request'), ['controller' => 'Requests', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Available Services'), ['controller' => 'AvailableServices', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Available Service'), ['controller' => 'AvailableServices', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="requestsAvailableServices view large-9 medium-8 columns content">
    <h3><?= h($requestsAvailableService->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Request') ?></th>
            <td><?= $requestsAvailableService->has('request') ? $this->Html->link($requestsAvailableService->request->id, ['controller' => 'Requests', 'action' => 'view', $requestsAvailableService->request->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Available Service') ?></th>
            <td><?= $requestsAvailableService->has('available_service') ? $this->Html->link($requestsAvailableService->available_service->name, ['controller' => 'AvailableServices', 'action' => 'view', $requestsAvailableService->available_service->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($requestsAvailableService->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($requestsAvailableService->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($requestsAvailableService->modified) ?></td>
        </tr>
    </table>
</div>
