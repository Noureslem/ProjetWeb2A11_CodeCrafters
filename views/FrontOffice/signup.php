<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <h1>Sign Up</h1>
    <form action="../../controllers/signup_controller.php" method="POST">
        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" id="firstname" required><br><br>

        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" id="lastname" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>

        <!-- Role selection -->
        <label for="role">Role:</label>
        <select name="role" id="role" required>
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
        </select><br><br>
        
        <input type="submit" value="Sign Up">
    </form>
    <a href="../../index.html">Back to Home</a>
</body>
</html>
