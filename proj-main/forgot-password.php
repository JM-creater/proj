<?php

session_start();
if (isset($_SESSION['SESSION_EMAIL'])) 
{
    header("Location: welcome.php");
    die();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

include 'config.php';
$msg = "";

if (isset($_POST['submit'])) 
{
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $code = mysqli_real_escape_string($conn, md5(rand()));

    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'")) > 0) 
    {
        $query = mysqli_query($conn, "UPDATE users SET code='{$code}' WHERE email='{$email}'");

        if ($query) 
        {        
            echo "<div style='display: none;'>";
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try 
            {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'taboadamartin033@gmail.com';                     //SMTP username
                $mail->Password   = 'yorpxgocqwvnwaqh';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('taboadamartin033@gmail.com');
                $mail->addAddress($email);

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Tang Ina Mo!';
                $mail->Body    = 'Here is the verification link <b><a href="http://localhost:8080/proj-main/change-password.php?reset='.$code.'">http://localhost:8080/proj-main/change-password.php?reset='.$code.'</a></b>';

                $mail->send();
                echo 'Message has been sent';
            } 
            catch (Exception $e) 
            {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            echo "</div>";        
            $msg = "<div class='alert alert-info'>We've send a verification link on your email address.</div>";
        }
    } 
    else 
    {
        $msg = "<div class='alert alert-danger'>$email - This email address do not found.</div>";
    }
}

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Forgot Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content="Login Form" />

    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />

    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>

</head>

<body>

    <!-- form section start -->
    <section class="w3l-mockup-form">
        <div class="container">
            <!-- /form -->
            <div class="workinghny-form-grid">
                <div class="main-mockup">
                    <div class="alert-close">
                        <span class="fa fa-close"></span>
                    </div>
                    <div class="w3l_form align-self">
                        <div class="left_grid_info">
                            <img src="images/image3.svg" alt="">
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Forgot Password</h2>
                        <p>Input your email here</p>
                        <?php echo $msg; ?>
                        <form action="" method="post">
                            <input type="email" class="email" name="email" placeholder="Enter Your Email" required>
                            <button name="submit" class="btn" type="submit">Send Reset Link</button>
                        </form>
                        <div class="social-icons">
                            <p>Back to! <a href="index.php">Login</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //form -->
        </div>
    </section>
    <!-- //form section start -->

    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function (c) {
            $('.alert-close').on('click', function (c) {
                $('.main-mockup').fadeOut('slow', function (c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>

</body>

</html>