<?php if(isset($form) && $form=='send_mail'): ?>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create('Users',['url'=>'/api/users/recover_password']) ?>
    <fieldset>
        <legend><?= __('Recover password') ?></legend>
        <?php
            echo $this->Form->input('email');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
<?php elseif(isset($form) && $form=='request_data'): ?>
	<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create('Users',['url'=>'/api/users/recover_password','type'=>'put']) ?>
    <fieldset>
        <legend><?= __('Recover password') ?></legend>
        <?php
            echo $this->Form->hidden('hash',['value'=>$hash]);
            echo $this->Form->input('password');
            echo $this->Form->input('confirm_password',['type'=>'password']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
<?php endif; ?>