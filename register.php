<?php

session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Coders' Journey</title>
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        .auth-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
        }
        .auth-card {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border: 1px solid #e1e4e8;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="nav-brand">
            <a href="index.php">Coders' Journey</a>
        </div>
        <div class="nav-links">
            <a href="roadmaps.php">Roadmaps</a>
        </div>
        <div class="nav-auth">
            <a href="login.php" class="btn-login">Log In</a>
        </div>
    </nav>


    <div class="container auth-container">
        
        <div class="auth-card">
            <h2 style="text-align: center; margin-bottom: 0.5rem;">Join the Community</h2>
            <p style="text-align: center; color: #666; margin-bottom: 2rem;">
                Create an account to ask questions and track your learning.
            </p>

            <?php if(isset($_GET['error'])): ?>
                <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 15px; text-align: center; font-size: 0.9rem;">
                    <?php 
                        if($_GET['error'] == 'empty_fields') echo "⚠️ Please fill in all fields.";
                        if($_GET['error'] == 'invalid_email') echo "⚠️ Invalid email format.";
                        if($_GET['error'] == 'password_short') echo "⚠️ Password must be at least 6 characters.";
                        if($_GET['error'] == 'username_taken') echo "❌ Username is already taken.";
                        if($_GET['error'] == 'email_taken') echo "❌ Email is already registered.";
                        if($_GET['error'] == 'sql_error') echo "❌ System error. Please try again.";
                    ?>
                </div>
            <?php endif; ?>


            <form action="actions/register_logic.php" method="POST">
                
                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label for="username" style="display:block; font-weight:600; margin-bottom: 5px;">Username</label>
                    <input type="text" id="username" name="username" required 
                           style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                </div>

                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label for="email" style="display:block; font-weight:600; margin-bottom: 5px;">Email Address</label>
                    <input type="email" id="email" name="email" required 
                           style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                </div>

                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label for="password" style="display:block; font-weight:600; margin-bottom: 5px;">Password</label>
                    <input type="password" id="password" name="password" required 
                           style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                    <small style="color:#666; font-size: 0.8rem;">Must be at least 6 characters long.</small>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; font-size: 1rem; font-weight: bold;">
                    Sign Up
                </button>

            </form>

            <div style="margin-top: 2rem; text-align: center; font-size: 0.9rem;">
                <p>Already have an account? <a href="login.php" style="color: #4a90e2; font-weight: bold;">Log In</a></p>
            </div>

        </div>

    </div>

</body>
</html>