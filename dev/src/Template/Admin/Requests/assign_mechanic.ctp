<div class="users form large-12 medium-12 columns content">
    <?= $this->Form->create($request) ?>
    <fieldset>
        <legend><?= __('Asignar Mecanico') ?></legend>
        <?php echo $this->Form->input('mechanic_id', ['options' => $mechanics, 'label' => 'Mecánico', 'id' => 'role_id', 'required' => true, 'empty' => 'Selecciona un mecánico']);?>
        <?php echo $this->Form->hidden('id', ['value' => $id]);?>
    </fieldset>
    <br>
    <?= $this->Form->button(__('Asignar')) ?>
    <?= $this->Form->end();?>
</div>
