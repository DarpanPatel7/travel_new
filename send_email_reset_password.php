

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require("php/PasswordHash.php");
require_once 'common/config.php';

$hasher = new PasswordHash(8, false);
$password=substr(md5(mt_rand()), 0, 7);
$hash = $hasher->HashPassword($password);
$email = $_POST['email'] ?? 'test@gmail.test';

$checkUserExistSQL = "SELECT * FROM `users` WHERE EMail='$email'";
$checkUserExistQuery = $conn->query($checkUserExistSQL);
$getResult = $checkUserExistQuery->fetch(PDO::FETCH_ASSOC);

if (!empty($getResult) && !empty($getResult['UserID'])) { //if user with the same username does not exist
    $useridd = $getResult['UserID'];
    $updateDataSQL = "UPDATE `users` SET Password='$hash' WHERE UserID='$useridd'";
    $updateDataQuery = $conn->query($updateDataSQL);
    if ($updateDataQuery) {
        try {
            //Server settings
            $phpmailer = new PHPMailer();
            $phpmailer->isSMTP();
            $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
            $phpmailer->SMTPAuth = true;
            $phpmailer->Port = 2525;
            $phpmailer->Username = 'ee4073acf91fcc';
            $phpmailer->Password = '54abc5de50835e';

            //Recipients
            $phpmailer->setFrom('test@gmail.com', 'Test');
            $phpmailer->addAddress($email, 'Test');     // Add a recipient
            // Content
            $phpmailer->isHTML(true);                                  // Set email format to HTML
            $phpmailer->Subject = 'Reset Password';
            $phpmailer->Body = '<b>'.$password.'</b> is new password for login at Travel';
            $phpmailer->AltBody = '<b>'.$password.'</b> is new password for login at Travel';
   
            $phpmailer->send();
            echo json_encode(['success' => true, 'message' => 'Message has been sent']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}"]);
        }
    }else{
        echo json_encode(['success' => false, 'message' => "Error occured while sending mail."]);
    }
}else{
    echo json_encode(['success' => false, 'message' => "Below email not registred with us."]);
}
?>
