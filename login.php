<?php
    $displayNav = false;
    include('templates/header.php');
    echo '<body>';

    echo '<div class="logo_container">
            <a href="landing.php">
                <img src="../images/logo.jpg" alt="Blog Logo" class="logo_img">
            </a>          
        </div>';

    echo '<h1 class="login_h1">Welcome Back!</h1>';
    
    echo '
        <div class="login-form-container">
            <form>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password">
                </div>
                <div class="login_btn_container">
                    <button type="submit" class="btn btn-secondary login_login_btn">Submit</button>
                    <span class="txt_space">or</span>
                    <a href="signup.php" class="btn btn-secondary login_signup_btn">Sign-up</a>
                </div>
            </form>
        </div>';


    echo '</body>';
    include('templates/footer.php');
?>