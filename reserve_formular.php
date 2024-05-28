<?php

$debug = true; // or
$debug = false; 

require_once "vendor/autoload.php";
require "components/database/db_connect_Beisl.php";


  // $mailer->clearAllRecipients (); 
  global $email;
  $customer = $_POST["customer_name"];
  $resdate = $_POST["reserve_date"];
  $reserve_timehour = $_POST["hour"];
  $reserve_timeminute = $_POST["minute"];
  $reserve_personen = $_POST["personen"];
  $reserve_rueckruf = $_POST["rueckrufnummer"];
  $reserve_contactemail = $_POST["email"];
  $reserve_checkbox = $_POST["agree"];
  $reserve_comment = $_POST["comment_details"];
  $reserve_checkbox_dsgvo = $_POST["dsgvo"];
  $date = date('Y-m-d');
  $time = $reserve_timehour.':'.$reserve_timeminute;
  $reserve_date = date("d.m.Y", strtotime($resdate));
  $raucher = "nein";

  // var_dump($reserve_checkbox_dsgvo);
  // die();

  if($reserve_checkbox_dsgvo=="on"){
    $dsgvo = "Der DSGVO wurde zugestimmt!";
  }else{
    $dsgvo = "Der DSGVO wurde nicht zugestimmt!";
  }

  if($reserve_checkbox){
    $newsletter = "JA";
  }else{
    $newsletter = "Dem Erhalt von Newslettern wurde NICHT zugestimmt";
  }

 

  $mailtext = "<br>Hallo Stefan, soeben wurde über das Reservierungsformular von psvbeisl.at eine neue Anfrage gesendet. <br><br> <b>Name<b>: $customer <br><b>Datum</b>: $reserve_date <br><b>Uhrzeit</b>: $reserve_timehour:$reserve_timeminute <br><b>Anzahl Personen</b>: $reserve_personen<br><b>email</b>: $reserve_contactemail <br><b>Telefon</b>: $reserve_rueckruf <br><b>Anmerkungen</b>: $reserve_comment <br><br><b>Checkbox DSGVO</b>: $dsgvo <br><b>Zustimmung Newsletter</b>: $newsletter";

  // if(sendEMail('office@webdesign.digitaleseele.at', 'Office WebDesign', 'Kundenanfrage webdesign.digitaleseele.at!', '<h1>Spiderman!</h1>', $mailtext, array("Spiderman.png" => "/path/to/img.png"))) 
  // { echo "\nPasst! Schau mal in dein Postfach Spiderman ist da!\n"; }
  // else
  // { echo "\nERROR! Ein interner Fehler ist aufgetreten! Die E-Mail konnte nicht korrekt zugestellt werden\n"; }
  if(sendEMail('office@webdesign.digitaleseele.at', 'PSVBeisl', 'Reservierung psvbeisl.at!', '<h1>Neue Reservierung!</h1>', $mailtext, array("Spiderman.png" => "/path/to/img.png"))) 
  { 
    // var_dump($reserve_personen);
    // die();
    // require "components/database/db_connect_Beisl.php";

    // var_dump($time);
    // die();

    //INSERT INTO `tblreservierung`(`id`, `Datum`, `Zeit`, `time`, `Name`, `Personenanzahl`, `Lokal`, `Raucher`, `Gastgarten`, `Rueckrufnr`, `Mail`, `Anmerkungen`, `Status`, `Reservierungsdatum`, `Bearbeiter`, `Typ`, `Exklusiv`) 
    
    //$sql_write_resbuch = "INSERT INTO tblreservierung(Datum, Zeit, Name, Personenanzahl, Lokal, Raucher, Gastgarten, Rueckrufnr, Mail, Anmerkungen, Status, Reservierungsdatum, Bearbeiter, Typ, Exklusiv) VALUES ('".$reserve_date."', '".$time."', '".$customer."', '".$reserve_personen."', 'PSV-Beisl', '".$raucher."', 'Innen', '".$reserve_rueckruf."', '".$reserve_contactemail."', '".$reserve_comment."', 'Anfrage', '".date('Y-m-d H:i:s',time())."', 'Online', 'Reservierung', 'Nein')";
    $sql_write_resbuch = "INSERT INTO tblreservierung(Datum, Zeit, Name, Personenanzahl, Lokal, Raucher, Gastgarten, Rueckrufnr, Mail, Anmerkungen, Status, Reservierungsdatum, Bearbeiter, Typ, Exklusiv) VALUES ('".$resdate."', '".$time."', '".$customer."', '".$reserve_personen."', 'PSV-Beisl', '".$raucher."', 'Innen', '".$reserve_rueckruf."', '".$reserve_contactemail."', '".$reserve_comment."', 'Anfrage', '".date('Y-m-d H:i:s',time())."', 'Online', 'Reservierung', 'Nein')";
    $res_writeRB = mysqli_query($connect, $sql_write_resbuch);

    header("Location: index.php");
    // echo "\nPasst! Schau mal in dein Postfach Spiderman ist da!\n"; 
}
  else
  { echo "\nERROR! Ein interner Fehler ist aufgetreten! Die E-Mail konnte nicht korrekt zugestellt werden\n"; }


  
  function sendEMail($receiver,$receiverName,$subject,$html,$text,$AttmFiles=array()){
      global $debug;
      global $reply;
      // $reply = $email;
      $email = $_POST["email"];
  
      $replymail = "office@ruedesworld.net";
  
      $mail = new PHPMailer\PHPMailer\PHPMailer($debug);
  
      if ($debug)
      { $mail->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_SERVER; }
      $mail->clearAllRecipients (); 
      $mail->isSMTP();
      $mail->SMTPAuth   = true;
      $mail->Host       = "w0123896.kasserver.com";
      $mail->Port       = "465";
      $mail->Username   = "kundenanfrage@webdesign.digitaleseele.at";
      $mail->Password   = "ZSHheH6phoiGukheaRZ9";
      $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS; // port 587
      $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS; // port 465
      $mail->CharSet    = 'utf-8';
      $mail->Debugoutput = 'html';
      $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false
            ,'verify_peer_name' => false
            ,'allow_self_signed' => true
        ),
        'tls' => array(
          'verify_peer' => false
          ,'verify_peer_name' => false
          ,'allow_self_signed' => true
        )
      );
      // $mailer->clearAllRecipients (); 
      $mail->setFrom("anfrage@webdesign.digitaleseele.at", 'Anfrage WebDesign');
      $mail->addAddress($receiver, $receiverName);
  
      foreach($AttmFiles as $key => $value)
      { $mail->addAttachment($value, $key); }
  
      $mail->isHTML(true);
      $mail->Subject = $subject;
      $mail->Body    = $html.' '.$text;
      $mail->AltBody = $text;
      $mail->AddReplyTo($email, 'Reply to name');
  
      try {
        
          $mail->send();
          return true;
      } catch (PHPMailer\PHPMailer\Exception $e) {
          if($debug)
          { echo "Message could not be sent. Mailer Error: ".$mail->ErrorInfo; }
          return false;
      }
  }