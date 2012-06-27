<?
/*$headers = 'From: ECCO BIOM Trail' . "\r\n" .
    'Reply-To: trail@ecco.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
if( mail("jens@plantcph.dk","testing ecco server sending. Working?","Testing",$headers) ){
	print "OK";
}
die();
/* */

include('phpmailer/class.phpmailer.php');

$body = "<b>testing mailer from ecco server</b><br>Working?";
$altBody = $body;

foreach(array('<br>', '<br/>', '<br />') as $break) {
	$altBody = str_ireplace($break, "\n", $altBody);
}
$altBody = strip_tags($altBody);

$mailer = new PHPMailer();

$mailer->IsSMTP();    // set mailer to use SMTP
$mailer->Host = "asmtp.danhost.dk";    // specify main and backup server
$mailer->SMTPAuth = true;    // turn on SMTP authentication
$mailer->Username = "es9061@plantcph.dk";    // SMTP username -- CHANGE --
$mailer->Password = "farc0Lin";    // SMTP password -- CHANGE --
//$mailer->Port = "587";    // SMTP Port


$mailer->CharSet = "UTF-8";
$mailer->SetFrom("ext-cl@ecco.com");
$mailer->AddAddress('jens@listic.dk');

$mailer->Subject = 'Jeg har lavet en film til dig';
$mailer->AltBody = $altBody;
$mailer->MsgHTML($body);

if(!$mailer->Send()) {
	print ("Forespørgslen kunne ikke udføres.");
}