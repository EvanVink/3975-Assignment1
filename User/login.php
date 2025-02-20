<?php
    $displayNav = false;    //Disabling the navigation bar.

    
    include('../utils.php');

    // Back-end code for the login form.
    $error_messages = [];
    $formInput      = [
        'email' => ''
    ];


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Sanitize the input data.
        $formInput['email'] = sanitize_input($_POST['email']);
        $password          = $_POST['password'];

        //Validating if email and password is not empty.
        if (empty($formInput['email']) || empty($password)) {
            $error_messages[] = 'Email and password are required fields.';
        }

        //If there is no error message, then proceed with the login process.
        if (empty($error_messages)) {
            
            try {
                $db = getDatabase();

                //Making sure if the email exists in the database.
                $getEmailFromDB         = $db -> prepare("SELECT * FROM Users WHERE Username = :emailPlaceholder");
                $getEmailFromDB         -> bindValue(":emailPlaceholder", $formInput['email'], SQLITE3_TEXT);
                $executeGetEmailFromDB  = $getEmailFromDB -> execute();
                $result                 = $executeGetEmailFromDB -> fetchArray(SQLITE3_ASSOC);

                //If the email exists, then verify the password.
                if ($result && password_verify($password, $result['Password'])) {
                    
                    //Checking if the user is approved.
                    if ($result["IsApproved"] == 1) {

                        //Starting session and storing the user's information.
                        session_start();
                        $_SESSION["userName"]   = $result['Username'];
                        $_SESSION["role"]       = $result["Role"];
                        $_SESSION["name"]       = $result["FirstName"] . " " . $result["LastName"];

                        
                        //Redirecting to the admin page if the user is an admin.
                        if ($result["Role"] == "admin") {
                            //! I might want to change this path.
                            header("Location: ../admin/admin_page.php");
                            die();
                            
                        } else {
                            //Redirecting to the main page.
                            header("Location: ../index.php");
                            die();
                        }                        
                       

                    } else {
                        //Redirecting to the pending page.
                        header("Location: ../User/pending.php");
                        die();
                    }

                } else {
                    $error_messages[] = 'Invalid email or password. Please try again.';
                }

            } catch (Exception $event) {

                $error_messages[] = 'An error occurred while processing your request. Please try again later.';
            
            } finally {
                closeDBConnection($db);
            }

        }
    }

    include('../templates/header.php');

    // Body of the page
    echo '<body>';

    // Display the logo.
    echo '<div class="logo_container">
            <a href="landing.php">
                <img src="../images/logo.jpg" alt="Blog Logo" class="logo_img">
            </a>          
        </div>';

    echo '<div class="login-wrapper">';
        echo '<h1 class="login_h1">Welcome Back!</h1>';
        
        // Display error messages if there are any.
        if (!empty($error_messages)) {
            echo '<div class="alert alert-danger login_error_container">';
            foreach ($error_messages as $error) {
                echo '<div>' . $error . '</div>';
            }
            echo '</div>';
        }
        
        // Display the login form.
        echo '
            <div class="login-form-container">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" required
                                value="' . $formInput["email"] . '">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="login_btn_container">
                        <button type="submit" class="btn btn-secondary login_login_btn">Submit</button>
                        <span class="txt_space">or</span>
                        <a href="signup.php" class="btn btn-secondary login_signup_btn">Sign-up</a>
                    </div>
                </form>
            </div>';
        echo '</div>';
    echo '</body>';
    include('../templates/footer.php');
?>