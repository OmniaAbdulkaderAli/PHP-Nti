<?php

include_once 'header.php';

$users = [
  [
    'id' => 1,
    'name' => 'ahmed',
    'email' => 'ahmed@gmail.com',
    'password' => '123456',
    'image' => '1.png',
    'gender' => 'm'
  ],
  [
    'id' => 2,
    'name' => 'esraa',
    'email' => 'esraa@gmail.com',
    'password' => '123456',
    'image' => '2.png',
    'gender' => 'f'
  ],
  [
    'id' => 3,
    'name' => 'galal',
    'email' => 'galal@gmail.com',
    'password' => '123456',
    'image' => '3.png',
    'gender' => 'm'
  ]
];
$error = [];
// first step validate the email

if (isset($_POST['submit'])) {

  if (empty($_POST['email'])) {
    $error['email'] = "<div style='color:#fff; font-size:20px ;'> please enter your email </div> ";
  }
  // then validate the password
  if (empty($_POST['password'])) {
    $error['password'] = "<div style='color:#fff; font-size:20px ;'> please enter your password </div> ";
  }

  if (empty($error)) {

    // check the authantication 

    $user = array_values(array_filter($users, function ($oneuser) {
      return $oneuser['email'] == $_POST['email'] and $oneuser['password'] == $_POST['password'];
    }));

    if (empty($user)) {
      $error['wrong'] = "<div style='color:#fff; font-size:20px ;'> your not user yet please register </div> ";
    } else {
      // save the details in session
      $_SESSION['user'] = $user[0];
      header('location:index.php');
    }
  }
}
?>


<form method="post">
  <div class="login-wrap">

    <div class="login-html">
      <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
      <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>

      <div class="login-form">
        <div class="sign-in-htm">
          <div class="group">
            <label for="user" class="label">email</label>
            <input id="user" name="email" type="email" class="input" value="">
            <?php echo isset($_POST['email']) ?  ($_POST['email']) : " "; ?>
            <?php echo (isset($error['email']) ? $error['email'] : " ") ?>
          </div>
          <div class="group">
            <label for="pass" class="label">Password</label>
            <input id="pass" name="password" type="password" class="input" data-type="password" value="">
            <?php echo (isset($error['password']) ? $error['password'] : " ") ?>

          </div>

          <?php echo (isset($error['wrong']) ? $error['wrong'] : " ") ?>
          <br>
          <div class="group">
            <input id="check" type="checkbox" class="check" checked>
            <label for="check"><span class="icon"></span> Keep me Signed in</label>
          </div>
          <div class="group">
            <input type="submit" name="submit" class="button" value="Sign In">
          </div>
          <div class="hr"></div>
          <div class="foot-lnk">
            <a href="#forgot">Forgot Password?</a>
          </div>  
        </div>











        <div class="sign-up-htm">
          <div class="group">
            <label for="user" class="label">Username</label>
            <input id="user" type="text" class="input">
          </div>
          <div class="group">
            <label for="pass" class="label">Password</label>
            <input id="pass" type="password" class="input" data-type="password">
          </div>
          <div class="group">
            <label for="pass" class="label">Repeat Password</label>
            <input id="pass" type="password" class="input" data-type="password">
          </div>
          <div class="group">
            <label for="pass" class="label">Email Address</label>
            <input id="pass" type="text" class="input">
          </div>
          <div class="group">
            <input type="submit" class="button" value="Sign Up">
          </div>
          <div class="hr"></div>
          <div class="foot-lnk">
            <label for="tab-1">Already Member?</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>