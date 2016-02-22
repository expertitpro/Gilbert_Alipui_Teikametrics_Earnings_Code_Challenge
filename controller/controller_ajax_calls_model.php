<?php
//this file is controller_ajax_calls_model.php.  It is called by view.html.  It in turn calls model.php

class CalculateEarnings {
    

    //the constructor    
    public function __construct() {}

    public function getAverageSalary()
    {
  		        
	    $var = $_GET['name'];
		$search = stripslashes($var);  // eliminated quotes

		$pieces = explode("=", $search);  // split up key, value pair to get the value
		$name = $pieces[1];  //assign the value to variable
	
 		 // prints currency in the international format for the en_US locale
		 setlocale(LC_MONETARY, 'en_US');

		//include the controller class file
		//this include file could also have a .inc extension 
		function callModel() {
			require_once('../model/model_echo_to_controller_ajax_calls_model.php');
		}

		if($GET)
		{
		  // do nothing. prevents caling the controller prematurely leading to division by zero!
		 }else{
		  // ensure the controller is only called on POST
		  callModel();
		}  

		$searchstring = $pieces[0];
		$pos1 = strpos($name, $searchstring);
  
		// Note the use of ===.  Simply == would not work as expected
		// because the positional issues of the 0th (first) character per api documentation. 
		if ($pos1 !== false) 
		{
			if(!"GET")
			{
			  // do nothing. prevents caling the controller prematurely leading to division by zero!
			  return 1;	
			}else{
			 // ensure the controller is only called on GET
			 $this->callModel();
			}   
		}	
		
  		//echo '{module:getaverage,success:true}';
  		return 0;
		
     } //end getAverage method

} // end controller class

  //instantiate the CalculateEarnings controller class
  $workhorse=new CalculateEarnings();
  //then call the method
  $ret = $workhorse->getAverageSalary();
  if($ret === 1){
    //$workhorse->redirect("http://localhost/earnings_code_challenge");
    echo '{module:controller, success: false}';
  }
  

?>