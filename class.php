<?php
// Writen by : Arvind Singh (Sr. Software Developer)

class Database{
  // DB_USERNAME=uppradh1_arvind
  // DB_PASSWORD={r!TzuP@rl;M
  // DB_NAME = uppradh1_reservations
  // host =198.49.76.242
   public $con;
   public $totalSeat = 80;
   public $success = '';
   protected $host = '198.49.76.242';
   protected $user = 'uppradh1_arvind';
   protected $pass = '{r!TzuP@rl;M';
   protected $db = 'uppradh1_reservations';

   public function __construct(){
   	$this->con = mysqli_connect($this->host,$this->user,$this->pass,$this->db);
   	if(!$this->con){
   		echo 'Database Connection Error ' . mysqli_connect_error($this->con); 
   	}
   }
   
   // Get booked seat
   // $tableName = coach
   public function select($tableName){
	   	$query = mysqli_query($this->con,"select * from ".$tableName." ");
	   	$bookedSeat = array();
		while($getCoach = mysqli_fetch_array($query)){
			$bookedSeat[] = $getCoach['seatNo'];
		}
		return $bookedSeat;
   }

   public function availableSeat(){
    $seatArray = [];
    $newSeat = [];
	for($i=1;$i<=$this->totalSeat;$i+=1){
	   $newSeat[] = array_push($seatArray, $i);
	}
    
    $bookedSeat = $this->select('coach');
	$availableSeat = array_values(array_diff($newSeat, $bookedSeat));
	return $availableSeat;

   }

   public function saveRecord($request){

   		$availableSeat = $this->availableSeat();
	    if(isset($request['submitDetails'])){
	      
	      $name = $request['name'];
	        // Insert multiple record in db
	        for ($i=0; $i <count($name); $i++) {
	          $insertQuery = mysqli_query($this->con,'INSERT INTO coach SET 
	            coachNo = 1, 
	            seatNo = "'.$availableSeat[$i].'",
	            name = "'.$name[$i].'",
	            status = 1 ',);
	        }
	        
	        if($insertQuery){
	          $this->success= 'success';
	        }else{
	          $this->success= 'failed';
	        }
	    }
   }
    

}

?>