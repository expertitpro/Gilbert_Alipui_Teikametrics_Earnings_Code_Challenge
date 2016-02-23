<?php
//model.php
//called by controller_ajax_calls_model.php and echoes back to controller_ajax_calls_model.php


$name = cleanGet($_GET);

// eliminates quotes from passed parameters
function cleanGet()
{
  $var = $_GET['name'];
  $dirty = stripslashes($var);

  $pieces = explode("=", $dirty);
  $clean = $pieces[1];

 return $clean;
}

// this model class handles data processing
class ModelClass {  

    // initialize the variables/properties
    private $response;
    private $url = "http://localhost/earnings_code_challenge/view.php";

    //the constructor    
    public function __construct() {}

    public function getAverageSalary()
    {	
		$totalrows = 0;
		$sum = 0;
		
        // I am using javascript to validate on the client side, but I am validating on the server side too just in case		   
	    if (empty($_GET["name"])) 
	    {
		  echo "Search string is required";
		  return false;
	    }else{
	      $name = test_input(cleanGet($_GET));
	      
	      if (preg_match("/^[a-zA-Z ]*$/",$name)) {
		      //echo "The search string is O.K. to proceed with <br>";
	      	  echo "Search Results: <br>";
		  }else{
		    echo "Model1.php says Only letters and white space allowed";
		    exit;
		  }
	    }
		 
		// again, I could have used curl to get the JSON data, but just keeping it simple
        $this->response = file_get_contents('https://data.cityofboston.gov/resource/4swk-wcg8.json');
  		$this->response = json_decode($this->response);
  		
  		// now, this just loops through the returned object 
		foreach($this->response as $num => &$values) 
		{	
		   // gets the object properties
		   $thevals = get_object_vars($values);   	   
		   
		   // assign property values to variables
		   $searchstring = $name; 	   
		   $mystring1 = $thevals['title']; 
		   $mystring2 = $thevals['title']; 

		   $pos1 = stripos($mystring2, $searchstring);
   
			// Note the use of ===.  Simply == would not work as expected
			// because of the positional issues of the 0th (first) character per api documentation. 
			if ($pos1 !== false) 
			{
			  echo "Found '$searchstring' in '$mystring2' ==> $". $thevals['total_earnings'] . "<br>";
			  $totalrows++;
			  $sum += $thevals['total_earnings'];
			} 
		}	
          
	    //calculate the average salary
	    //2/23/16 bug fix. format_money() appears not to work on Windows, yet it works on OSX!
	    //removed format_money until I find a suitable workaround to display the us currency in the proper format.		
		if(!$totalrows){
		   // no data found, the program will return to the start page, but inform the user. The message may be visible on a slower system.
		   echo "Sorry no data found for: " . $searchstring . "<br>";		  
		   return 0;	
		}else{		
		  $average = $sum / $totalrows;

		  // report back earnings information as required
		  // 2/23/16 money format on windows workaround.  Using number_format($value, 2).  Only supports US Currency. No support for European currency e.g. 1000,00 for example.
		  echo "<br>The Grand Total Salary for the " . $searchstring . " positions-> is : $ " .  number_format($sum, 2) . "<br>";
		  echo "The total rows is : " . $totalrows . "<br>";

		  echo "The Average salary for the " . $searchstring . " position based on Total Earnings is: $ ". number_format($sum, 2) . " divided by total number of records " . $totalrows . " = $ " .  number_format($average, 2) . "<br>";	  
		  return 1;		
		}

   }
    
} //end of model

// cleans and tests input for correctness   
function test_input($data) 
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

 
if (isset($name))
{
  //instantiate the CalculateEarnings controller class
  $workhorse=new ModelClass();
  //then call the method
  $ret = $workhorse->getAverageSalary();
  
  //return final status
  if($ret === 0){
    echo "{module:model, message:No data found, the program, success: false}";
  }else{
     //echo "{module:model, success: true}"; //for testing only.  The user should not see this
  }

}




?>