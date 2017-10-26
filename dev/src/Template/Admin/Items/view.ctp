<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Item'), ['action' => 'edit', $item->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Item'), ['action' => 'delete', $item->id], ['confirm' => __('Are you sure you want to delete # {0}?', $item->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Items Logs'), ['controller' => 'ItemsLogs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Items Log'), ['controller' => 'ItemsLogs', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Purcharse Order Items'), ['controller' => 'PurcharseOrderItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Purcharse Order Item'), ['controller' => 'PurcharseOrderItems', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Available Services'), ['controller' => 'AvailableServices', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Available Service'), ['controller' => 'AvailableServices', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Providers'), ['controller' => 'Providers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Provider'), ['controller' => 'Providers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="items view large-9 medium-8 columns content">
    <h3><?= h($item->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($item->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($item->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Brand') ?></th>
            <td><?= h($item->brand) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($item->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($item->quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cost') ?></th>
            <td><?= $this->Number->format($item->cost) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($item->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($item->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $item->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Items Logs') ?></h4>
        <?php if (!empty($item->items_logs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Request Service Id') ?></th>
                <th scope="col"><?= __('Request Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Item Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($item->items_logs as $itemsLogs): ?>
            <tr>
                <td><?= h($itemsLogs->id) ?></td>
                <td><?= h($itemsLogs->request_service_id) ?></td>
                <td><?= h($itemsLogs->request_id) ?></td>
                <td><?= h($itemsLogs->user_id) ?></td>
                <td><?= h($itemsLogs->item_id) ?></td>
                <td><?= h($itemsLogs->created) ?></td>
                <td><?= h($itemsLogs->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ItemsLogs', 'action' => 'view', $itemsLogs->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ItemsLogs', 'action' => 'edit', $itemsLogs->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ItemsLogs', 'action' => 'delete', $itemsLogs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemsLogs->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Purcharse Order Items') ?></h4>
        <?php if (!empty($item->purcharse_order_items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Purcharse Order Id') ?></th>
                <th scope="col"><?= __('Item Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($item->purcharse_order_items as $purcharseOrderItems): ?>
            <tr>
                <td><?= h($purcharseOrderItems->id) ?></td>
                <td><?= h($purcharseOrderItems->purcharse_order_id) ?></td>
                <td><?= h($purcharseOrderItems->item_id) ?></td>
                <td><?= h($purcharseOrderItems->created) ?></td>
                <td><?= h($purcharseOrderItems->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'PurcharseOrderItems', 'action' => 'view', $purcharseOrderItems->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'PurcharseOrderItems', 'action' => 'edit', $purcharseOrderItems->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'PurcharseOrderItems', 'action' => 'delete', $purcharseOrderItems->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purcharseOrderItems->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Available Services') ?></h4>
        <?php if (!empty($item->available_services)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Estimated Time') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Active') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($item->available_services as $availableServices): ?>
            <tr>
                <td><?= h($availableServices->id) ?></td>
                <td><?= h($availableServices->name) ?></td>
                <td><?= h($availableServices->description) ?></td>
                <td><?= h($availableServices->estimated_time) ?></td>
                <td><?= h($availableServices->price) ?></td>
                <td><?= h($availableServices->active) ?></td>
                <td><?= h($availableServices->created) ?></td>
                <td><?= h($availableServices->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'AvailableServices', 'action' => 'view', $availableServices->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'AvailableServices', 'action' => 'edit', $availableServices->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'AvailableServices', 'action' => 'delete', $availableServices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $availableServices->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Providers') ?></h4>
        <?php if (!empty($item->providers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Phone') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Address') ?></th>
                <th scope="col"><?= __('Active') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($item->providers as $providers): ?>
            <tr>
                <td><?= h($providers->id) ?></td>
                <td><?= h($providers->name) ?></td>
                <td><?= h($providers->phone) ?></td>
                <td><?= h($providers->email) ?></td>
                <td><?= h($providers->address) ?></td>
                <td><?= h($providers->active) ?></td>
                <td><?= h($providers->created) ?></td>
                <td><?= h($providers->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Providers', 'action' => 'view', $providers->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Providers', 'action' => 'edit', $providers->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Providers', 'action' => 'delete', $providers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $providers->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
