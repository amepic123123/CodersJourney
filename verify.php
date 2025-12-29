<?php
// 1. GET EMAIL FROM URL
// If the user just registered, we grab their email from the link (verify.php?email=...)
$email_to_verify = "";
if (isset($_GET['email'])) {
    $email_to_verify = $_GET['email'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Account - Coders' Journey</title>
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
            text-align: center;
        }
        .otp-input {
            font-size: 2rem;
            letter-spacing: 10px;
            text-align: center;
            width: 100%;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 8px;
            margin: 20px 0;
        }
        .otp-input:focus {
            border-color: #4a90e2;
            outline: none;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="nav-brand">
            <a href="index.php">Coders' Journey</a>
        </div>
    </nav>


    <div class="container auth-container">
        
        <div class="auth-card">
            <h2>Check Your Email</h2>
            <p style="color: #666; margin-top: 10px;">
                We sent a 6-digit code to: <br>
                <strong><?php echo htmlspecialchars($email_to_verify); ?></strong>
            </p>

            <?php if(isset($_GET['error'])): ?>
                <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-top: 15px;">
                    <?php 
                        if($_GET['error'] == 'wrong_code') echo "❌ Incorrect code. Try again.";
                        if($_GET['error'] == 'empty') echo "⚠️ Please enter the code.";
                    ?>
                </div>
            <?php endif; ?>


            <form action="actions/verify_logic.php" method="POST">
                
                <input type="hidden" name="email" value="<?php echo htmlspecialchars($email_to_verify); ?>">

                <div class="form-group">
                    <input type="text" name="otp_code" class="otp-input" 
                           maxlength="6" placeholder="000000" required autofocus>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; font-size: 1rem;">
                    Verify Account
                </button>

            </form>

            <div style="margin-top: 2rem; font-size: 0.9rem;">
                <p>Wrong email? <a href="register.php" style="color: #4a90e2;">Register again</a></p>
            </div>
        </div>

    </div>

</body>
</html>