<?php
include_once "layouts/header.php";
include_once "layouts/nav.php";
?>
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3>Register</h3>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li class="active">Register</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->
<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg1">
                            <h4> Register </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <?php 
                                     if(isset($_SESSION['message']['errors']['something'])){
                                        echo $_SESSION['message']['errors']['something'];
                                    }
                                    ?>
                                    <form action="../routes/web.php" method="post">
                                        <input type="text" name="name" placeholder="Full Name" value="<?php if(isset($_SESSION['request']['name'])){echo $_SESSION['request']['name'];} ?>">
                                        <input type="phone" name="phone"  placeholder="Phone" value="<?php if(isset($_SESSION['request']['phone'])){echo $_SESSION['request']['phone'];} ?>">
                                        <input name="email" placeholder="Email" type="email" value="<?php if(isset($_SESSION['request']['email'])){echo $_SESSION['request']['email'];} ?>">
                                        <?php if(isset($_SESSION['message']['errors']['email'])){
                                            foreach($_SESSION['message']['errors']['email'] AS $error){
                                                echo $error;
                                            }
                                        } 
                                        if(isset($_SESSION['message']['errors']['email-exists'])){
                                            echo $_SESSION['message']['errors']['email-exists'];
                                        }
                                        ?>
                                        <input type="password" name="password" placeholder="Password">
                                        <?php if(isset($_SESSION['message']['errors']['password'])){
                                            foreach($_SESSION['message']['errors']['password'] AS $error){
                                                echo $error;
                                            }
                                        } ?>
                                        <input type="password" name="confirm-password" placeholder="Confrim Password">
                                        <select name="gender" class="form-control mb-4" id="">
                                            <option <?php if(isset($_SESSION['request']['gender']) && $_SESSION['request']['gender'] == 'm' ){echo 'selected';} ?> value="m">Male</option>
                                            <option <?php if(isset($_SESSION['request']['gender']) && $_SESSION['request']['gender'] == 'f' ){echo 'selected';} ?> value="f">Female</option>
                                        </select>
                                        <div class="button-box">
                                            <button type="submit" name="register"><span>Register</span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once "layouts/footer.php" ?>