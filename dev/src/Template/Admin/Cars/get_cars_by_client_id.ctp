<?php
	if($cars != null)
	{
		echo $this->Form->input('Request.car_id', ['label'=> 'Auto', 'type' => 'select', 'options' => $cars, 'empty' => 'Selecciona un auto', 'required' => true]);
		echo '<strong id="request-car-id-error" class="text-danger"></strong>';
	}
	else
	{
		echo $this->Html->tag('strong', 'El usuario no tiene autos asociados a su cuenta', ['class' => 'text-danger']);
	}
?>
	