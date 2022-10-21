 <?php
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);
 ini_set("session.cookie_lifetime","14400");//7200
 ini_set("session.gc_maxlifetime","14400");//7200
 session_start();
 if(!isset($_SESSION['token']))
 {
 	$_SESSION['token'] = md5(rand(1000,9999));
 	$seconds = microtime(true) + 10800;
 	$_SESSION['limite'] = $seconds;
 }
 require_once('../config/Config.php');
 require_once('../config/Autoload.php');
 config\Autoload::iniciar();
 config\Router::direccionar(new config\Request()); 
?>
 
 

