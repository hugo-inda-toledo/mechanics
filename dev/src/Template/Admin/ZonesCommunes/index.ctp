<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Zones Commune'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Zones'), ['controller' => 'Zones', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Zone'), ['controller' => 'Zones', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Communes'), ['controller' => 'Communes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Commune'), ['controller' => 'Communes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="zonesCommunes index large-9 medium-8 columns content">
    <h3><?= __('Zones Communes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('zone_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('commune_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($zonesCommunes as $zonesCommune): ?>
            <tr>
                <td><?= $this->Number->format($zonesCommune->id) ?></td>
                <td><?= $zonesCommune->has('zone') ? $this->Html->link($zonesCommune->zone->name, ['controller' => 'Zones', 'action' => 'view', $zonesCommune->zone->id]) : '' ?></td>
                <td><?= $zonesCommune->has('commune') ? $this->Html->link($zonesCommune->commune->name, ['controller' => 'Communes', 'action' => 'view', $zonesCommune->commune->id]) : '' ?></td>
                <td><?= h($zonesCommune->created) ?></td>
                <td><?= h($zonesCommune->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $zonesCommune->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $zonesCommune->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $zonesCommune->id], ['confirm' => __('Are you sure you want to delete # {0}?', $zonesCommune->id)]) ?>
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
