<?php echo $this->Form->radio(
    'Request.adress_data',
    [
        ['value' => 'user_address', 'text' => 'Usar dirección registrada del usuario', 'checked' => 'checked', 'onclick' => 'Javascript:changeAddress("registred");'],
        ['value' => 'new_address', 'text' => 'Usar nueva dirección', 'onclick' => 'Javascript:changeAddress("new");']
    ]
);?>

<?= $this->Form->input('Request.address_name', ['label' => 'Dirección', 'value' => $user->address_name, 'disabled', 'id' => 'address-name-input'])?>
<?= $this->Form->input('Request.address_number', ['label' => 'Numeración', 'value' => $user->address_number, 'disabled', 'id' => 'address-number-input'])?>
<?= $this->Form->input('Request.address_complement', ['label' => 'Complemento', 'value' => $user->address_complement, 'disabled', 'id' => 'address-complement-input'])?>
<?= $this->Form->input('Request.city_id', ['label'=> 'Ciudad', 'type' => 'select', 'options' => $cities, 'empty' => 'Selecciona una ciudad', 'required' => true, 'id' => 'city_id', 'onchange' => 'Javascript:getCommunes();', 'default' => $user->city_id, 'disabled']);?>
<div id="commune-select-div">
	<?= $this->Form->input('Request.commune_id', ['label'=> 'Comuna', 'type' => 'select', 'options' => $communes, 'empty' => 'Selecciona una comuna', 'required' => true, 'id' => 'commune_id', 'default' => $user->commune_id, 'disabled']);?>
</div>

<script>
	function changeAddress(type)
	{
		if(type == 'new')
		{
			$('#address-name-input').prop("disabled", false);
			$('#address-number-input').prop("disabled", false);
			$('#address-complement-input').prop("disabled", false);
			$('#city_id').prop("disabled", false);

			$('#address-name-input').val('');
			$('#address-number-input').val('');
			$('#address-complement-input').val('');	
			$('#city_id').val('');	
			$('#commune-select-div').html('');	
		}

		if(type == 'registred')
		{
			$('#city_id').val(<?= '"'.$user->city_id.'"';?>);	
			$('#address-name-input').val(<?= '"'.$user->address_name.'"';?>);
			$('#address-number-input').val(<?= '"'.$user->address_number.'"';?>);
			$('#address-complement-input').val(<?= '"'.$user->address_complement.'"';?>);	
			
			getCommunes(<?= '"'.$user->commune_id.'"';?>);

			$('#address-name-input').prop("disabled", true);
			$('#address-number-input').prop("disabled", true);
			$('#address-complement-input').prop("disabled", true);
			$('#city_id').prop("disabled", true);
			$('#commune_id').prop("disabled", true);
		}
	}

	function getCommunes(commune_id = '')
    {

    	var value = $('#city_id').val();

        if(value != '')
        {
            $("#commune-select-div").html(<?= "'".$this->Html->image('ajax-load.gif')."'"; ?>);

            if(commune_id != '')
            {
            	$.ajax({
	                url: <?php echo "'".$this->Url->build(['controller' => 'Communes', 'action' => 'getCommunesByCityId'])."'";?> + '/' + value + '/Request/'+ commune_id +'/1', 
	                success: function(data){
	                    $("#commune-select-div").html(data);
	                }
	            });  
            }
            else
            {
            	$.ajax({
	                url: <?php echo "'".$this->Url->build(['controller' => 'Communes', 'action' => 'getCommunesByCityId'])."'";?> + '/' + value + '/Request', 
	                success: function(data){
	                    $("#commune-select-div").html(data);
	                }
	            });  
            }
            
        }
        else
        {
            $("#commune-select-div").html('');
        }
    }
</script>