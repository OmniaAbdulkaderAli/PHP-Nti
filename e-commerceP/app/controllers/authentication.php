<?php
include_once __DIR__ . "/../requests/authenticationRequest.php";
include_once "controller.php";
include_once __DIR__ . "/../models/User.php";
include_once __DIR__ . "/../mails/verificationMail.php";
class authentication extends controller
{

    const notVerified = 0;
    const verified = 1;
    const loginOrRegisterPage = 0;
    const verifyMailPage = 1;

    public function register_post($request)
    {
        $validation = new authenticationRequest;
        $validation->setEmail($request['email']);
        $emailValidationResult = $validation->emailValidation();
        if (!empty($emailValidationResult)) {
            // save data in sesssion
            $_SESSION['message']['errors'] = $emailValidationResult;
            $_SESSION['request'] = $request;
            // header('location:../views/register.php');die;
        }

        $validation->setPassword($request['password']);
        $validation->setConfirmPassword($request['confirm-password']);
        $passwordValidationResult  = $validation->passwordValidation();
        if (!empty($passwordValidationResult)) {
            $_SESSION['message']['errors'] = $passwordValidationResult;
            $_SESSION['request'] = $request;
            // header('location:../views/register.php');die;
        }

        if (!empty($passwordValidationResult) || !empty($emailValidationResult)) {
            header('location:../views/register.php');
            die;
        }


        // insert data
        $user = new User;
        $user->setName($request['name']);
        $user->setPassword($request['password']);
        $user->setEmail($request['email']);
        $user->setPhone($request['phone']);
        $user->setGender($request['gender']);
        // generate code
        $code = rand(10000, 99999);
        $user->setCode($code);
        // check if email exists in db
        $emailCheckResult = $user->emailCheckDB();
        if (empty($emailCheckResult)) {
            $result = $user->insertData();
            if ($result) {
                //send mail
                $mail = new verificationMail;
                $subject = "Verification Code";
                $body = "<div> Your Verificaiton Code Is:<b>$code</b> <div>";
                $mailResult = $mail->sendMail($request['email'], $subject, $body);
                if ($mailResult) {
                    header('location:web.php?email=' . $request['email'] . '&forget=0');
                    die;
                } else {
                    header('location:../views/errors/500.php');
                    die;
                }
            } else {
                // return error
                $_SESSION['message']['errors'] = ['something' => "<div class='alert alert-danger'> SomeThing Went Wrong </div>"];
                $_SESSION['request'] = $request;
                header('location:../views/register.php');
                die;
            }
        } else {
            // return error
            $_SESSION['message']['errors'] = ['email-exists' => "<div class='alert alert-danger'> Email Already Exists </div>"];
            $_SESSION['request'] = $request;
            header('location:../views/register.php');
            die;
        }
    }

    public function verifyCode_post($request)
    {
        $emailValidation = new authenticationRequest;
        $emailValidationResult = $emailValidation->urlEmailValidation($request);
        if ($emailValidationResult) {
            if ($emailValidationResult->code == $request['code']) {
                // header index with user data
                $user = new user;
                $user->setStatus(self::verified);
                $user->setEmail($request['email']);
                $updateStatusResult = $user->updateStatus();
                if ($updateStatusResult) { 
                    if ($request['forget'] == SELF::loginOrRegisterPage) {
                        $emailValidationResult->status = self::verified;
                        $_SESSION['user'] = $emailValidationResult;
                        header('location:web.php?index=true');
                        die;
                    } elseif ($request['forget'] == self::verifyMailPage) {
                        // header new password 
                        header("location:../routes/web.php?new-password=true&forgetEmail={$request['email']}");
                        die;
                    }
                } else {
                    $_SESSION['message']['errors'] = ['something' => "<div class='alert alert-danger'> SomeThing Went wrong </div>"];
                    $_SESSION['request'] = $request;
                    header("location:../views/verify-code.php?email={$request['email']}");
                    die;
                }
            } else {
                // header verify code with Error
                $_SESSION['message']['errors'] = ['wrong-code' => "<div class='alert alert-danger'> Wrong Code </div>"];
                $_SESSION['request'] = $request;
                header("location:../views/verify-code.php?email={$request['email']}");
                die;
            }
        } else {
            header("location:../views/errors/404.php");
            die;
        }
        // validate on code
        // check on db
        // change status if code is true & header index
        // else return error
    }

    public function verifyCode_get($request)
    {
        $emailValidation = new authenticationRequest;
        $emailValidationResult = $emailValidation->urlEmailValidation($request);
        if ($emailValidationResult) {
            header("location:../views/verify-code.php?email={$request['email']}&forget={$request['forget']}");
            die;
        } else {
            header("location:../views/errors/404.php");
            die;
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('location:../views/login.php');
    }
    public function login_post($request)
    {
        // validate on email
        $validation = new authenticationRequest;
        $validation->setEmail($request['email']);
        $emailValidationResult = $validation->emailValidation();
        if (!empty($emailValidationResult)) {
            $_SESSION['message']['errors'] =  $emailValidationResult;
            $_SESSION['request'] = $request;
            header("location:../views/login.php");
        }
        // validate on password
        $validation->setPassword($request['password']);
        $passwordValidationLoginResult = $validation->passwordValidationLogin();
        if (!empty($passwordValidationLoginResult)) {
            $_SESSION['message']['errors'] =  $passwordValidationLoginResult;
            $_SESSION['request'] = $request;
            header("location:../views/login.php");
            die;
        }

        // check on db
        $user = new user;
        $user->setEmail($request['email']);
        $user->setPassword($request['password']);
        $loginResult = $user->login();
        // if user exists =>
        if ($loginResult) {
            $userDB = $loginResult->fetch_object();
            // print_r($userDB);die;
            if ($userDB->status == self::notVerified) {
                // send mail
                $mail = new verificationMail;
                $subject = "Verification Code";
                $body = "<div> Your Verificaiton Code Is:<b> $userDB->code </b> <div>";
                $mailResult = $mail->sendMail($request['email'], $subject, $body);
                if ($mailResult) {
                    header('location:web.php?email=' . $request['email'] . '&forget=0');
                    die;
                } else {
                    header('location:../views/errors/500.php');
                    die;
                }
            } elseif ($userDB->status == SELF::verified) {
                //save data into session
                $_SESSION['user'] = $userDB;
                // header to index
                header('location:web.php?index=true');
                die;
            }
            // check status (1 => index , 0 => verify code)
        } else {
            $_SESSION['message']['errors'] =  ['wrong-user' => "<div class='alert alert-danger'> Invalid login try again </div>"];
            $_SESSION['request'] = $request;
            header("location:../views/login.php");
            die;
        }
    }
    public function login_get()
    {
        header('location:../views/login.php');
        die;
    }
    public function register_get()
    {
        header('location:../views/register.php');
        die;
    }

    public function profile_get()
    {
        header('location:../views/profile.php');
        die;
    }

    public function index()
    {
        header('location:../views/index.php');
        die;
    }

    public function verifyEmail_get()
    {
        header('location:../views/verify-email.php');
    }

    public function verifyEmail_post($request)
    {
        // valdiate on email
        //    print_r($request['email']);die;
        $validation = new authenticationRequest;
        $validation->setEmail($request['email']);
        $emailValidationResult = $validation->emailValidation();
        if (!empty($emailValidationResult)) {
            // save data in sesssion
            $_SESSION['message']['errors'] = $emailValidationResult;
            $_SESSION['request'] = $request;
            header('location:../views/verify-email.php');
            die;
        }
        // check mail on DB
        $user = new User;
        $user->setEmail($request['email']);
        $emailCheckResult = $user->emailCheckDB();
        if ($emailCheckResult) {
            //generate code
            $code = rand(10000, 99999);
            // update code in db
            $user = new user;
            $user->setEmail($request['email']);
            $user->setCode($code);
            $updateCodeResult = $user->updateCode();
            if ($updateCodeResult) {
                // send code
                $mail = new verificationMail;
                $subject = "Password Verification Code";
                $body = "<div> Your Forget Password Code Is:<b>$code</b> <div>";
                $mailResult = $mail->sendMail($request['email'], $subject, $body);
                if ($mailResult) {
                    header('location:web.php?email=' . $request['email'] . '&forget=1');
                    die;
                } else {
                    header('location:../views/errors/500.php');
                    die;
                }
            } else {
                // return error
                $_SESSION['message']['errors'] = ['something' => "<div class='alert alert-danger'> SomeThing Went Wrong </div>"];
                $_SESSION['request'] = $request;
                header('location:../views/verify-email.php');
                die;
            }
        } else {
            // return error
            $_SESSION['message']['errors'] = ['email-not-exists' => "<div class='alert alert-danger'> Email Not Exists </div>"];
            $_SESSION['request'] = $request;
            header('location:../views/verify-email.php');
            die;
        }
    }

    public function newPassword_get($request)
    {
        header("location:../views/new-password.php?forgetEmail={$request['forgetEmail']}");
    }

    public function changePassword_post($request)
    {
        // validate on password
        $validation = new authenticationRequest;
        $validation->setPassword($request['password']);
        $validation->setConfirmPassword($request['confirm-password']);
        $passwordValidationResult = $validation->passwordValidation();
        if ($passwordValidationResult) {
            $_SESSION['message']['errors'] = $passwordValidationResult;
            $_SESSION['request'] = $request;
            header("location:../views/new-password.php?forgetEmail={$request['email']}");
            die;
        } else {
            // get user
            $user = new user;
            $user->setEmail($request['email']);
            $emailCheckDBResult =  $user->emailCheckDB();
            if ($emailCheckDBResult) {
                $userDB = $emailCheckDBResult->fetch_object();
                // prevent old password
                $user->setPassword($request['password']);
                if ($userDB->password == $user->getPassword()) {
                    $_SESSION['message']['errors'] = ['old-password' => "<div class='alert alert-danger'> You have Entered Your Old Password , Please Enter a new One </div>"];
                    $_SESSION['request'] = $request;
                    header("location:../views/new-password.php?forgetEmail={$request['email']}");
                    die;
                } else {
                    // update password
                    $updatePasswordResult = $user->updatePassword();
                    if ($updatePasswordResult) {
                        header('location:web.php?login=true');die;
                    } else {
                        header('location:../views/errors/500.php');
                        die;
                    }
                }
            } else {
                header('location:../views/errors/404.php');
            }
            // print_r($)
        }
    }
}
