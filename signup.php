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
        <div class="signup-form-container">
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstName" required>
                </div>

                <div class="mb-3">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastName" required>
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username (Email address)</label>
                    <input type="email" class="form-control" id="email" required>
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" required>
                    <small class="text-muted">At least 8 characters with an uppercase, lowercase, number, and special character.</small>
                </div>
                <div class="signup_btn_container">
                    <button type="submit" class="btn btn-secondary signup_create_btn">Create Account</button>
                </div>
            </form>
        </div>';
      

    echo '</body>';

    include('templates/footer.php');
?>