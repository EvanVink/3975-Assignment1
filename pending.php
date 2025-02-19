<?php
    $displayNav = false;
    include('templates/header.php');

    if (!isset($_SESSION["userName"])) {
        header("Location: login.php");
        exit();
    }

    echo '<body>';

    echo '<div class="logo_container">
            <a href="landing.php">
                <img src="../images/logo.jpg" alt="Blog Logo" class="logo_img">
            </a>          
        </div>';

    echo '<h1 class="pending_h1">Waiting for approval!</h1>';
    
    echo '<div class="pending_container">
            <img src="../images/approval.svg" alt="Approval" class="approval_img">
        </div>';
    
    echo '                
        <div class="pending_btn_container">
            <a href="landing.php" class="btn btn-secondary pending_main_btn">Main Page</a>
        </div>';

    echo '</body>';
    include('templates/footer.php');
?>