<!--<pre>
	<?php //print_r($users->toArray());?>
</pre>-->

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Listado de Mecánicos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('name', 'Nombre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_name', 'Apellido') ?></th>
                <th scope="col"><?= $this->Paginator->sort('phone1', 'Fono 1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('city_id', 'Ciudad') ?></th>
                <th scope="col"><?= $this->Paginator->sort('commune_id', 'Comuna') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email' , 'Email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('active', 'Estado') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created', 'Fecha de creación') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified', 'Fecha de modificación') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= h($user->name) ?></td>
                <td><?= h($user->last_name) ?></td>
                <td><?= h($user->phone1) ?></td>
                <td><?= h($user->city->name) ?></td>
                <td><?= h($user->commune->name) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?= ($user->active == 1) ? __('Activo') : __('Bloqueado') ?></td>
                <td><?= h($user->created) ?></td>
                <td><?= h($user->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $user->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit-mechanic', $user->id]) ?>
                    <?php if(!$user->active): ?>
                        <?= $this->Form->postLink(__('Activar'), ['action' => 'activated', $user->id], ['confirm' => __('¿Está seguro que desea activar a {0} {1}?', [$user->name, $user->last_name])]) ?>
                    <?php else: ?>
                        <?= $this->Form->postLink(__('Bloquear'), ['action' => 'deactivated', $user->id], ['confirm' => __('¿Está seguro que desea bloquear a {0} {1}?', [$user->name, $user->last_name])]) ?>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
