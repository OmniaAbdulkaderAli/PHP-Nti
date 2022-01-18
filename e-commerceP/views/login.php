<?php include_once "layouts/header.php";include_once "layouts/nav.php"; ?>
    <div class="breadcrumb-area bg-image-3 ptb-150">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h3>LOGIN</h3>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Login</li>
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
                                <h4> login </h4>
                            </a>
                            
                        </div>
                        <div class="tab-content">
                            <div id="lg1" class="tab-pane active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form action="../routes/web.php" method="post">
                                            <input type="email" name="email" placeholder="Email" value="<?php echo(isset($_SESSION['request']['email']) ? $_SESSION['request']['email'] : ''); ?>">
                                            <?php if(isset($_SESSION['message']['errors']['email'])){
                                                foreach($_SESSION['message']['errors']['email'] AS $error){
                                                    echo $error;
                                                }
                                            } ?>
                                            <input type="password" name="password" placeholder="Password">
                                            <?php if(isset($_SESSION['message']['errors']['password'])){
                                                foreach($_SESSION['message']['errors']['password'] AS $error){
                                                    echo $error;
                                                }
                                            } 
                                            if(isset($_SESSION['message']['errors']['wrong-user'])){
                                                echo $_SESSION['message']['errors']['wrong-user'];
                                            }
                                            ?>
                                            <div class="button-box">
                                                <div class="login-toggle-btn">
                                                    <a href="../routes/web.php?verify-email=true">Forgot Password?</a>
                                                </div>
                                                <button type="submit" name="login"><span>Login</span></button>
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