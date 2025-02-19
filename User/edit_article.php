<?php
    include('../templates/header.php');
    include('../utils.php');

    //Checking if the user is logged in
    if (!isset($_SESSION["userName"])) {
        header("Location: 401.php");
        exit();
    }

    //Setting Vancouver timezone and current date
    date_default_timezone_set('America/Vancouver');
    $currentDate = date('Y-m-d');

    // Initialize error messages array
    $error_messages = [];

    //Getting article Id
    if (!isset($_GET["id"]) || empty($_GET["id"])) {
        header("Location: profile.php");
        exit();
    }

    $articleId = $_GET["id"];


    try {
        $db = getDatabase();

        //Brining the article data from database
        $queryStmt          = "SELECT * FROM Article WHERE ArticleId = ? AND ContributorUsername = ?";
        $prepareQueryStmt   = $db->prepare($queryStmt);
        $prepareQueryStmt   ->bindParam(1, $articleId);
        $prepareQueryStmt   ->bindParam(2, $_SESSION["userName"]);
        $executeStmt        = $prepareQueryStmt->execute();

        $queriedData = $executeStmt->fetchArray(SQLITE3_ASSOC);

        //Checking if the article exists and the user has permission to edit
        if (!$queriedData) {

            $error_messages[] = "Article not found no permission to edit!!!!!";
        }

    } catch (Exception $event) {

        $error_messages[] = 'Failed to retrieve the article :/';

    } finally {
            closeDBConnection($db);
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

    // Display the form only if the article exists and preloading article data!!
    if ($queriedData) {
        echo '
            <div class="createArticle-form-container">
                <form method="POST" action="/User/process_update_article.php">
                    <div class="email_date_container">
                        <div class="mb-31 flex-1">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" 
                                value="' . sanitize_input($_SESSION["userName"]) . '" readonly>
                        </div>
                        <div class="mb-31 flex-1">
                            <label for="createDate" class="form-label">Create Date</label>
                            <input type="text" class="form-control" id="createDate"
                                value="' . sanitize_input($queriedData['CreateDate']) . '" readonly>
                        </div>
                    </div>

                    <div class="date-picker-row">
                        <div class="mb-31 flex-1">
                            <label for="startDate" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="startDate" name="startDate" 
                                value="' . sanitize_input($queriedData['StartDate']) . '"
                                min="' . $currentDate . '" required>
                        </div>
                        <div class="mb-31 flex-1">
                            <label for="endDate" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="endDate" name="endDate" 
                                value="' . sanitize_input($queriedData['EndDate']) . '"
                                min="' . $currentDate . '" required>
                        </div>
                    </div>

                    <div class="mb-31">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" 
                            value="' . sanitize_input($queriedData['Title']) . '" required>
                    </div>

                    <div class="mb-31">
                        <label for="body" class="form-label">Description</label>
                        <textarea class="form-control" id="body" name="body" rows="3" required>' . sanitize_input($queriedData['Body']) . '
                        </textarea>
                    </div>

                    <div class="createArticle_btn_container">
                        <button type="submit" class="btn btn-secondary createArticle_btn">Update Article</button>
                    </div>
                </form>
            </div>';
    }

    echo '</body>';