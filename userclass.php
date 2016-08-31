<?php
include once();
 class Newuser
   {
     public $rank = 0;
       public function __construct($username,$email,$password,$location)
       {
           $this->username=$username;
           $this->email=$email;
           $this->password=$password;
           $this->location=$location;
           
      
            $dbhost = "localhost";
            $dbname = "PieBoard";
            $dbusername = "kibeth";
            $dbpassword = "845625";

             $link = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbusername,$dbpassword);

              $statement = $link->prepare("INSERT INTO user(username,email,password,location)
              VALUES(:username, :email, :password, :location)");
              $statement->execute(array(
                   "username" => $username,
                   "email" => $email,
                   "password" => $password,
                   "location" => $location
               ));
       }
   }
   //new Newuser("abc","cde","fod","UK");
   
   
 class Signupsecurity
   {
     public function __construct($trash)
     {
       //get Remote IP
       echo $_SERVER['REMOTE_ADDR'];
       $userIP=$_SERVER['REMOTE_ADDR'];
         //get real IP
         $realip = '';
           if (getenv('HTTP_CLIENT_IP'))
             $realip = getenv('HTTP_CLIENT_IP');
           else if(getenv('HTTP_X_FORWARDED_FOR'))
             $realip = getenv('HTTP_X_FORWARDED_FOR');
           else if(getenv('HTTP_X_FORWARDED'))
             $realip = getenv('HTTP_X_FORWARDED');
           else if(getenv('HTTP_FORWARDED_FOR'))
             $realip = getenv('HTTP_FORWARDED_FOR');
           else if(getenv('HTTP_FORWARDED'))
             $realip = getenv('HTTP_FORWARDED');
           else if(getenv('REMOTE_ADDR'))
             $realip = getenv('REMOTE_ADDR');
           else
             $realip = 'UNKNOWN';
             echo $realip;
               //get info on IP location and provider
               $ch = curl_init(); 
               curl_setopt($ch, CURLOPT_URL, "ipinfo.io/" . $realip); 
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
               $output = curl_exec($ch); 
               curl_close($ch);
               $location=json_decode($output);
               
                 $securityresults= array($userIP,$realip,$location);
                 //write to db
     }
   }
     // new Loginsecurity("buttons");
      
function login()
  {
   
     $dbhost = "localhost";
     $dbname = "PieBoard";
     $dbusername = "kibeth";
     $dbpassword = "845625";
       try 
       {
         $databaseConnection = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbusername,$dbpassword);
         $databaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       } catch(PDOException $e) {
         echo 'ERROR: ' . $e->getMessage();
}
   	if(isset($_POST['submit'])){
		    $lemail = trim($_POST['username']);
		    $lpassword = trim($_POST['password']);
		    $error = '';
		
		     if($lusername == '')
			     $error .= 'Please enter username<br>';
		
		     if($lpassword == '')
		     	$error .= 'Please enter password<br>';
		
		      if($error == ''){
		      	$check = $databaseConnection->prepare('SELECT username,password FROM users WHERE lusername = :username');
			      $check->bindParam(':username', $lusername);
		      	$check->execute();
			      $check = $records->fetch(PDO::FETCH_ASSOC);
			        if(count($check) > 0 && password_verify($password, $check['password'])){
				         $_SESSION['username'] = $check['username'];
				         header('location:dashboard.php');
				         exit;
			        }else{
				         $error .= 'Username and Password are not found<br>';
			        }
		}
	}
  }
	
 
?>