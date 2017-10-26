<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Requests'), ['controller' => 'Requests', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Request'), ['controller' => 'Requests', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="payments form large-9 medium-8 columns content">
    <?= $this->Form->create(null); ?>
    <fieldset>
        <legend><?= __('Ingresar Items') ?></legend>

        <h5>Servicios a realizar</h5>
        <ul>
            <?php foreach($purchase_order->request->available_services as $available_service):?>
                <li><?= $available_service->name?></li>
            <?php endforeach;?>
        </ul>

        <h5>Selecciona los items que utilizaras en la orden de compra</h5>

        <fieldset id="mechanic-communes-fieldset">
            <?= $this->Form->label('PurchaseOrdersItems.item_id', 'Items');?>
            <?= $this->Form->select('PurchaseOrdersItems.item_id', $items_list, ['multiple' => true, 'id' => 'item_id', 'style' => 'height: 350px;', 'required' => true]);?>
        </fieldset>

        <?php echo $this->Form->hidden('purchase_order_id', ['value' => $purchase_order->id]);?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
