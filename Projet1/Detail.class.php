<!-- Detail.class.php --> 
<!-- Author : Thomas Anizet --> 

<?php
	class Traveler
	{
		private $name;
		private $age;
		
		public function __construct($nom, $age) 
		{ 
		   $this->name = $nom; 
		   $this->age = $age;
		}
		
		public function GetName()  
		{  
		   return $this->name;  
		}
		
		public function GetAge()  
		{  
		   return $this->age;  
		}
	}
?>