<?php 
	if($bills != null)
	{
		$this->Excel->addWorksheet($bills, 'Boletas');
	}

	if($facts != null)
	{
		$this->Excel->addWorksheet($facts, 'Facturas');
	}
	
?>