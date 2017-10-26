<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Roles Permission'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Permissions'), ['controller' => 'Permissions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Permission'), ['controller' => 'Permissions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rolesPermissions index large-9 medium-8 columns content">
    <h3><?= __('Roles Permissions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('role_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('permission_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('enabled') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rolesPermissions as $rolesPermission): ?>
            <tr>
                <td><?= $this->Number->format($rolesPermission->id) ?></td>
                <td><?= $rolesPermission->has('role') ? $this->Html->link($rolesPermission->role->name, ['controller' => 'Roles', 'action' => 'view', $rolesPermission->role->id]) : '' ?></td>
                <td><?= $rolesPermission->has('permission') ? $this->Html->link($rolesPermission->permission->name, ['controller' => 'Permissions', 'action' => 'view', $rolesPermission->permission->id]) : '' ?></td>
                <td><?= $this->Number->format($rolesPermission->enabled) ?></td>
                <td><?= h($rolesPermission->created) ?></td>
                <td><?= h($rolesPermission->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $rolesPermission->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $rolesPermission->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $rolesPermission->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rolesPermission->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
