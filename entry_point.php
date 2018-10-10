<?php
session_start ();

define ( 'VIEWS', 'Views/' );
define ( 'MODELS', 'Models/' );
define ( 'CONTROLLERS', 'Controllers/' );


define( 'URL', 'http://' . $_SERVER ['HTTP_HOST'] . $_SERVER ['REQUEST_URI']);

function autoloader($class) {
	include MODELS . $class . '.class.php';
}
spl_autoload_register ( 'autoloader' );


$db = Db::getInstance ();
if (isset ( $_GET ["page"] )) {
	$page = preg_replace("/[^a-zA-Z0-9]+/", "", htmlentities ( $_GET ["page"] ) );
} else {
	$page = "Home";
}
define ( 'PAGE', $page );


function run($name){
    if(!file_exists(CONTROLLERS.$name.".php"))return false;
    require_once( CONTROLLERS.$name.".php");
    try{
        $controller = (new $name);
    }catch(Exception $e){
        return false;
    }
    if($controller){
        $controller->render();
        return true;
    }
    return false;
}

run("Menu");
echo "<div id='content'>";
if(!run($page)){
    header('Location: ?page=Error404'); 
}
echo "</div>";

?>