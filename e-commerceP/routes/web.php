<?php
include_once "../app/controllers/authentication.php";
if(isset($_POST['register'])){
    // authentication::register($_POST);
    $authentication = new authentication;
    $authentication->register_post($_POST);
}elseif(isset($_POST['login'])){
    $authentication = new authentication;
    $authentication->login_post($_POST);
}elseif(isset($_POST['verify-code'])){
    $authentication = new authentication;
    $authentication->verifyCode_post($_POST);
}elseif(isset($_GET['email'])){
    $authentication = new authentication;
    $authentication->verifyCode_get($_GET);
}elseif(isset($_GET['logout'])){
    $authentication = new authentication;
    $authentication->logout();
}elseif(isset($_GET['register'])){
    $authentication = new authentication;
    $authentication->register_get();
}elseif(isset($_GET['login'])){
    $authentication = new authentication;
    $authentication->login_get();
}elseif(isset($_GET['profile'])){
    $authentication = new authentication;
    $authentication->profile_get();
}elseif(isset($_GET['index'])){
    $authentication = new authentication;
    $authentication->index();
}elseif(isset($_GET['verify-email'])){
    $authentication = new authentication;
    $authentication->verifyEmail_get();
}elseif(isset($_POST['verify-email'])){
    $authentication = new authentication;
    $authentication->verifyEmail_post($_POST);

}elseif(isset($_GET['new-password'])){
    $authentication = new authentication;
    $authentication->newPassword_get($_GET);
}elseif(isset($_POST['change-password'])){
    $authentication = new authentication;
    $authentication->changePassword_post($_POST);
}else{
    header('location:../veiws/errors/404.php');
}


