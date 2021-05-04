<?php public static function isLoggedIn(){
    Session::openSession();

    if(isset($_SESSION['username'])){
        return true;
    }

    return self::notLogged();    
}

?>