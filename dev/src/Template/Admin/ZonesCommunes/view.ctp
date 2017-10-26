<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Zones Commune'), ['action' => 'edit', $zonesCommune->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Zones Commune'), ['action' => 'delete', $zonesCommune->id], ['confirm' => __('Are you sure you want to delete # {0}?', $zonesCommune->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Zones Communes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Zones Commune'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Zones'), ['controller' => 'Zones', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Zone'), ['controller' => 'Zones', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Communes'), ['controller' => 'Communes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Commune'), ['controller' => 'Communes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="zonesCommunes view large-9 medium-8 columns content">
    <h3><?= h($zonesCommune->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Zone') ?></th>
            <td><?= $zonesCommune->has('zone') ? $this->Html->link($zonesCommune->zone->name, ['controller' => 'Zones', 'action' => 'view', $zonesCommune->zone->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Commune') ?></th>
            <td><?= $zonesCommune->has('commune') ? $this->Html->link($zonesCommune->commune->name, ['controller' => 'Communes', 'action' => 'view', $zonesCommune->commune->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($zonesCommune->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($zonesCommune->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($zonesCommune->modified) ?></td>
        </tr>
    </table>
</div>
