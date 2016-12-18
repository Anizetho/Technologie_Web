<!-- Confirmation.class.php --> 
<!-- Author : Thomas Anizet --> 

<?php
	class SaveAge
	{
	private $AgeLow;
	private $AgeUp;
	
	public function __construct($AgeInférieur, $AgeSuppérieur) 
	{ 
	   $this->AgeLow = $AgeInférieur;
	   $this->AgeUp = $AgeSuppérieur;
	}
	
	public function GetAgeLow()  
	{  
		
	   return $this->AgeLow ;  
	}

	public function GetAgeUp()  
	{  
		
	   return $this->AgeUp ;  
	}
	}
?>