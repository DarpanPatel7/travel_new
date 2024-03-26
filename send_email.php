

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$data = [];
$data['name'] = $_POST['name'] ?? 'patel';
$data['email'] = $_POST['email'] ?? 'test@gmail.test';
$data['otpHidden'] = $_POST['otpHidden'] ?? '';

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
    $phpmailer->addAddress($data['email'], 'Test');     // Add a recipient

    // Content
    $phpmailer->isHTML(true);                                  // Set email format to HTML
    $phpmailer->Subject = 'Otp for Registration';
    $phpmailer->Body = '<b>'.$data['otpHidden'].'</b> is the OTP for registration at Travel';
    $phpmailer->AltBody = '<b>'.$data['otpHidden'].'</b> is the OTP for registration at Travel';

    $phpmailer->send();
    echo json_encode(['success' => true, 'message' => 'Message has been sent']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}"]);
}
?>
