<?php
/**
 * router will decide where is the reqeuest go
 * @author Jinhai Wang
 * Date: Feb 25, 2015
 */
	error_reporting(E_ALL);
	echo "Routing";
	define("BASE_PATH",dirname(realpath(__FILE__)));
	//echo BASE_PATH;
	//require_once(BASE_PATH.'/authentication.class.php'); 

	//function to parse the request url
	function parseRoute(){
		$route =array();
		//check if it is set, else return empty array
		if (isset($_SERVER['REQUEST_URI'])) {      

			$requestPath = explode("?",$_SERVER['REQUEST_URI']); //splite parameter from path
			//matching controll,id using regex
			#$ca =   '/^([\w]+)\/([\w]+).*$/';           //  controller/id
	        #$c =    '/^([\w]+).*$/';                    //  controller

	        //find the base of script
	        $route['base'] = rtrim(dirname($_SERVER['SCRIPT_NAME']), '\/');
	        $route['call_utf8'] = substr(urldecode($requestPath[0]), strlen($route['base']) + 1);
	        $route['call'] = utf8_decode($route['call_utf8']);    //this will get controller/id        
	        //check if call to itself
	        if ($route['call'] == basename($_SERVER['PHP_SELF'])) {
		      $route['call'] = '';
		    }
		    else{
		    	$route['call_parts'] = explode('/', $route['call']);  //split into array of controller , id
		    }
		    

		    //process query paramters
		    if(count($requestPath)>1){
		    	$route['query_utf8'] = urldecode($requestPath[1]);  //decode
			    $route['query'] = utf8_decode(urldecode($requestPath[1]));
			    $queryParts = explode('&',$route['query']);        //seperate qurery into param=value format
			    //get each param name and value into array
			    foreach ($queryParts as $qPart) {
			    	$p = explode('=',$qPart);
			    	if(count($p)>1){
			    		$route['query_vars'][$p[0]] = $p[1];  //store into array as pair (param name, value)
			    	}
			    	else if(count($p)==1){
			    		$route['query_vars'][$p[0]] = '';  //store into array as pair (param name, value)
			    	}
			    	
			    }
		    }
		    
		}
	    return $route;
	}


	/**
	* retrive dispatch to specific controller
	* @param routeInfo
	* @return
	*/
	function dispatch($routeInfo){

		if(isset($routeInfo['call_parts'][0])){
			$controllerName = strtolower($routeInfo['call_parts'][0]);
			if($controllerName=='restaurant'){
				echo  "route to ".$routeInfo['call_parts'][0].".php";
			}
			else if($controllerName=='user'){
				echo  "route to ".$routeInfo['call_parts'][0].".php";
			}
			else if($controllerName=='account'){
				echo  "route to ".$routeInfo['call_parts'][0].".php";
			}
			else if($controllerName=='register'){
				echo  "route to ".$routeInfo['call_parts'][0].".php";
			}
			else if($controllerName=='review'){
				echo  "route to ".$routeInfo['call_parts'][0].".php";
			}
			else if($controllerName=='book'){
				echo  "route to ".$routeInfo['call_parts'][0].".php";
			}
			else if($controllerName=='addrestaurant'){
				echo  "route to ".$routeInfo['call_parts'][0].".php";
			}
			else{
				include('404.php');
			}
		}
	}
$route_info = parseRoute();
echo '<pre>'.print_r($route_info, true).'</pre>';   //print array in readable format
dispatch($route_info)

?>