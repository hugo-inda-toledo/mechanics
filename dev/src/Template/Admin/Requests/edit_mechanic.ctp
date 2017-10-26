<div class="users form large-12 medium-12 columns content">
    <?= $this->Form->create($request) ?>
    <fieldset>
        <legend><?= __('Modificar Mecánico de Solicitud') ?></legend>
        <?php
            echo $this->Form->input('mechanic_id', ['options' => $mechanics , 'label'=> 'Mecánico']);
        ?>
    </fieldset>
    <br>
    <?= $this->Form->button(__('Cambiar mecánico')) ?>
    <?= $this->Form->end();?>
</div>
