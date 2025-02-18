<?php
    $displayNav = false;    //Disabling the navigation bar.

    include('templates/header.php');
    include('utils.php');

    // Back-end code for the sign-up form.
    $error_messages = [];
    $formInput = [
        'firstName' => '',
        'lastName'  => '',
        'email'     => ''
    ];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // Sanitize the input data.
        $formInput['firstName'] = sanitize_input($_POST['firstName']);
        $formInput['lastName']  = sanitize_input($_POST['lastName']);
        $formInput['email']     = sanitize_input($_POST['email']);
        $password               = $_POST['password'];

        //Validating email
        if (!filter_var($formInput['email'], FILTER_VALIDATE_EMAIL)) {
            $error_messages[] = 'Invalid email format. Please check your email address.';
        }

        //Validating password
        if (strlen($password) < 8 || 
            !preg_match("/[A-Z]/", $password) || 
            !preg_match("/[a-z]/", $password) ||
            !preg_match("/[0-9]/", $password) ||
            !preg_match("/[!@#$%^&*(),.?\":{}|<>]/", $password)) {

                $error_messages[] = "Password must be at least 8 characters long and contain an uppercase letter, lowercase letter, number, and special character.";
        }

        //If there are no errors, then proceed with the sign-up process.
        if (empty($error_messages)) {
            
            try {
                $db = getDatabase();
                
                //Making sure that the email is not already in use.
                $getEmailFromDB       = $db -> prepare("SELECT COUNT(*) FROM Users WHERE Username = :emailPlaceholder");
                $getEmailFromDB       -> bindValue(":emailPlaceholder", $formInput['email'], SQLITE3_TEXT);
                $excuteGetEmailFromDB = $getEmailFromDB -> execute();
                $result               = $excuteGetEmailFromDB -> fetchArray()[0];

                if ($result > 0) {
                    $error_messages[] = "This email is already in use. Please use a different email address.";
                } else {
                    
                    //Encrypting the password.
                    $encryptPassword = password_hash($password, PASSWORD_DEFAULT);
                    
                    //Inserting the user into the database.
                    $insertingStmt = $db -> prepare("INSERT INTO Users (Username, Password, FirstName, LastName, RegistrationDate, IsApproved, Role)
                                                    VALUES (:emailPlaceholder, :passwordPlaceholder, :firstNamePlaceholder, :lastNamePlaceholder, CURRENT_DATE, 0, 'contributor')");

                    $insertingStmt -> bindValue(":emailPlaceholder", $formInput['email'], SQLITE3_TEXT);
                    $insertingStmt -> bindValue(":passwordPlaceholder", $encryptPassword, SQLITE3_TEXT);
                    $insertingStmt -> bindValue(":firstNamePlaceholder", $formInput['firstName'], SQLITE3_TEXT);
                    $insertingStmt -> bindValue(":lastNamePlaceholder", $formInput['lastName'], SQLITE3_TEXT);

                    $executeInsertingStmt = $insertingStmt -> execute();


                    //Redirecting to pending.php.
                    if ($executeInsertingStmt) {
                        header ("Location: pending.php");
                        exit();
                    }
                }          

            } catch (Exception $event) {

                $error_messages[] = "An error occurred while processing your request. Please try again later.";

            } finally {
                closeDBConnection($db);
            }
        }
    }

    // Body of the page.
    echo '<body>';

    // Display the logo.
    echo '<div class="logo_container">
            <a href="landing.php">
                <img src="../images/logo.jpg" alt="Blog Logo" class="logo_img">
            </a>          
        </div>';

    echo '<div class="signup_page_container">
    <h1 class="login_h1">Create an Account</h1>';

    // Display error messages if there are any.
    if (!empty($error_messages)) {
        echo '<div class="alert alert-danger signup-form-container signup_error_container">';
        foreach ($error_messages as $error) {
            echo '<div>' . $error . '</div>';
        }
        echo '</div>';
    }

    // Display the sign-up form.
    echo '
            <div class="signup-form-container">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" required
                                value="' . $formInput['firstName'] . '">
                    </div>

                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" required
                                value="' . $formInput['lastName'] . '">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Username (Email address)</label>
                        <input type="email" class="form-control" id="email" name="email" required
                                value="' . $formInput['email'] . '">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <small class="text-muted">At least 8 characters with an uppercase, lowercase, number, and special character.</small>
                    </div>
                    <div class="signup_btn_container">
                        <button type="submit" class="btn btn-secondary signup_create_btn">Create Account</button>
                    </div>
                </form>
            </div>
        </div>';

    echo '</body>';

    include('templates/footer.php');
?>