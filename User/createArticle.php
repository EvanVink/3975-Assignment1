<?php
    include('../templates/header.php');
    include('../utils.php');

    //Checking if the user is logged in
    if (!isset($_SESSION["userName"])) {
        header("Location: login.php");
        exit();
    }

    //Setting Vancouver timezone and current date
    date_default_timezone_set('America/Vancouver');
    $currentDate = date('Y-m-d');

    // Initialize error messages array
    $error_messages = [];

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            $db = getDatabase();
            
            //Sanitizing the input data
            $startDate  = sanitize_input($_POST["startDate"]);
            $endDate    = sanitize_input($_POST["endDate"]);
            $title      = sanitize_input($_POST["title"]);
            $body       = $_POST["body"]; //Allowing HTML
            
            //Checking if the start date is less than the end date
            if ($startDate > $endDate) {
                $error_messages[] = "Start date cannot be greater than end date.";
            }

            //If no errors, proceed with database insertion
            if (empty($error_messages)) {
                $insertingStmt = $db->prepare('INSERT INTO Article (Title, Body, CreateDate, StartDate, EndDate, ContributorUsername)
                                            VALUES (:titlePlaceholder, :bodyPlaceholder, :createDatePlaceholder, 
                                                    :startDatePlaceholder, :endDatePlaceholder, :contributorUsernamePlaceholder)');
            
                $insertingStmt->bindValue(":titlePlaceholder", $title, SQLITE3_TEXT);
                $insertingStmt->bindValue(":bodyPlaceholder", $body, SQLITE3_TEXT);
                $insertingStmt->bindValue(":createDatePlaceholder", $currentDate, SQLITE3_TEXT);
                $insertingStmt->bindValue(":startDatePlaceholder", $startDate, SQLITE3_TEXT);
                $insertingStmt->bindValue(":endDatePlaceholder", $endDate, SQLITE3_TEXT);
                $insertingStmt->bindValue(":contributorUsernamePlaceholder", $_SESSION["userName"], SQLITE3_TEXT);
                
                $executeStmt = $insertingStmt->execute();

                if ($executeStmt) {
                    header("Location: ../index.php");
                    exit();
                }
            }
            
        } catch (Exception $event) {
            $error_messages[] = 'Failed to create the article. Please try again.';
        } finally {
            if (isset($db)) {
                closeDBConnection($db);
            }
        }
    }

    // Start HTML output
    echo '<body>';

    // Display error messages if any
    if (!empty($error_messages)) {
        echo '<div class="alert alert-danger createArticle_error_container">';
        foreach ($error_messages as $error) {
            echo '<div>' . $error . '</div>';
        }
        echo '</div>';
    }

    // Display the form
    echo '
        <div class="createArticle-form-container">
            <form method="POST" action="">
                <div class="email_date_container">
                    <div class="mb-31 flex-1">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" 
                            value="' . $_SESSION["userName"] . '" readonly>
                    </div>
                    <div class="mb-31 flex-1">
                        <label for="createDate" class="form-label">Create Date</label>
                        <input type="text" class="form-control" id="createDate"
                            value="' . $currentDate . '" readonly>
                    </div>
                </div>

                <div class="date-picker-row">
                    <div class="mb-31 flex-1">
                        <label for="startDate" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="startDate" name="startDate" 
                            min="' . $currentDate . '" required>
                    </div>
                    <div class="mb-31 flex-1">
                        <label for="endDate" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="endDate" name="endDate" 
                            min="' . $currentDate . '" required>
                    </div>
                </div>

                <div class="mb-31">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>

                <div class="mb-31">
                    <label for="body" class="form-label">Description</label>
                    <textarea class="form-control" id="body" name="body" rows="3" required></textarea>
                </div>

                <div class="createArticle_btn_container">
                    <button type="submit" class="btn btn-secondary createArticle_btn">Submit</button>
                </div>
            </form>
        </div>';

    echo '</body>';
    include('../templates/footer.php');
?>
