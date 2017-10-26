<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Requests'), ['controller' => 'Requests', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Request'), ['controller' => 'Requests', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="payments form large-9 medium-8 columns content">
    <?= $this->Form->create($payment) ?>
    <fieldset>
        <legend><?= __('Add Payment') ?></legend>
        <h5>Pago de servicios</h5>
        <ul>
            <?php
                $total_supplies= 0;
                $total_replacements= 0;
                $total_services= 0;
                $total_mechanic= 0;
            ?>

            <?php foreach($request->available_services as $available_service):?>
                <li><?= $available_service->name?></li>

                <?php
                    $total_services += $available_service->total_price;
                    $total_replacements += $available_service->replacements_price;
                    $total_supplies += $available_service->supplies_price;
                    $total_mechanic += $available_service->mechanic_pay;
                ?>
            <?php endforeach;?>
        </ul>
        <?= $this->Form->input('payment_method_id', ['type' => 'select', 'options' => $paymentMethods, 'empty' => 'Selecciona un método de pago', 'label' => 'Método de pago', 'required' => true]);?>
        <h5>Total a pagar</h5>
        <ul>
            <li><?= $this->Html->tag('strong', $this->Number->format(($total_services + $total_supplies + $total_replacements), ['before' => '$ ','after' => ' CLP']));?></li>
        </ul>

        <?php
            echo $this->Form->hidden('request_id', ['value' => $request->id]);
            echo $this->Form->hidden('user_id', ['value' => $request->client->id]);
            echo $this->Form->hidden('amount', ['value' => ($total_services + $total_supplies + $total_replacements)]);
            echo $this->Form->hidden('amount_replacements', ['value' => $total_replacements]);
            echo $this->Form->hidden('amount_supplies', ['value' => $total_supplies]);
            echo $this->Form->hidden('amount_mechanic', ['value' => $total_mechanic]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
