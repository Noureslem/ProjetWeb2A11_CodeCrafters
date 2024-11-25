<?php
// Include the required files
require_once '../controller/CourseController.php';
require_once '../db.php';

$error = ""; // Variable to capture errors

// Create an instance of CourseController
$courseController = new CourseController();

// Check if the form is submitted
if (
    isset($_POST["id"], $_POST["title"], $_POST["description"], $_POST["price"], $_POST["teacher_id"], $_POST["study_duration"], $_POST["level"])
) {
    if (
        !empty($_POST["id"]) &&
        !empty($_POST["title"]) &&
        !empty($_POST["description"]) &&
        !empty($_POST["price"]) &&
        !empty($_POST["teacher_id"]) &&
        !empty($_POST["study_duration"]) &&
        !empty($_POST["level"])
    ) {
        // Prepare data for updating
        $courseData = [
            'id' => $_POST['id'],
            'title' => htmlspecialchars($_POST['title']),
            'description' => htmlspecialchars($_POST['description']),
            'price' => floatval($_POST['price']),
            'teacher_id' => intval($_POST['teacher_id']),
            'study_duration' => intval($_POST['study_duration']),
            'level' => htmlspecialchars($_POST['level']),
        ];

        try {
            // Update the course
            $courseController->updateCourse($courseData);
            // Redirect to ListCourse.php
            header('Location: ListCourse.php');
            exit;
        } catch (Exception $e) {
            $error = "An error occurred: " . $e->getMessage();
        }
    } else {
        $error = "Please fill in all fields.";
    }
}

// Retrieve the course to update (if id is provided in the URL)
$courseToEdit = null;
if (isset($_GET['id']) && !empty($_GET['id'])) {
    try {
        $courseToEdit = $courseController->getCourseById($_GET['id']);
    } catch (Exception $e) {
        $error = "An error occurred while retrieving the course: " . $e->getMessage();
    }
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Course</title>
    <style>
        header {
            background-color: #e26e0e;
            padding: 15px;
        }

        body {
            background-image: linear-gradient(to right, hsl(215, 92%, 15%, 0.8), hsl(215, 92%, 15%, 0.7)), url(4.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            font-family: Arial, sans-serif;
        }

        h1 {aa
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: black;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form button {
            width: 110px;
            height: 35px;
            margin: 0 10px;
            background: #03224c;
            border-radius: 30px;
            border: 0;
            color: aliceblue;
            cursor: pointer;
        }

        button:hover {
            background-color: #fb470d;
        }

        .container {
            width: 360px;
            margin: 8% auto;
            background: #f0f0f2;
            border-radius: 5px;
            padding: 20px;
        }

        #error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <header>
        <h1><a href="ListCourse.php">Back to Course List</a></h1>
    </header>

    <div id="error">
        <?php echo $error; ?>
    </div>

    //<?php
     //Check if the course ID is set
     /* if (isset($_POST['id'])) {
        $course = $courseController->updateCourse($_POST['id']);
     }
    */
    ?>
         <form action="" method="POST">
            <table>
            <tr>
                    <td><label for="id">Id :</label></td>
                    <td>
                        <input type="text" id="id" name="id" value="<?php echo $_POST['id'] ?>" readonly />
                        <span id="erreurid" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="titre">titre:</label></td>
                    <td>
                        <input type="text" id="titre" name="titre" value="<?php echo $course['titre'] ?>" />
                        <span id="erreurtitre" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="description">description :</label></td>
                    <td>
                        <input type="text" id="description" name="description" value="<?php echo $course['description'] ?>" />
                        <span id="erreurdescription" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="price">price :</label></td>
                    <td>
                        <input type="text" id="price" name="price" value="<?php echo $course['price'] ?>" />
                        <span id="erreurprice" style="color: red"></span>
                    </td>
                </tr>
                <td>
                    <button type="submit" value="Save"> <strong>  SAVE </strong></button>
                </td>
                <td>
                <button type="reset" value="Save"> <strong>  RESET </strong></button>
                </td>
            </table>

    </div>
</body>
</html>
