<?php
	class Test{
		//muutujad ehk properties
		private $secretNumber;
		public $publicNumber;
		
		function __construct($sentValue){
				$this->secretNumber = 10;
				$this->publicNumber = $sentValue * $this->secretNumber ;
				echo "salajane: " .$this->secretNumber ." ja avalik: " .$this->publicNumber;
		}//constructor lõppeb
		
		function __destruct();{
			echo " Klass on valmis ja lõpetas!";
		}//destructor lõppeb
		//funktsioonid ehk methods
		public function showValues(){
			echo "\n Väga salajane: " .$this->secretNumber;
			
		}//public function lõppeb
		
		private function tellSecret(){
			echo "Näidisklass on pea aegu valmis";
			$this->tellSecret();
		}
		
		
	}//class lõppeb