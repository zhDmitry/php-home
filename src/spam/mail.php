<?php

function makeTemplate($template, $values){

    $tmpl=$template;

    foreach($values as $key => $value)
    {
        $tmpl = str_replace('{{ '.$key.' }}', $value, $tmpl);
    }
    return $tmpl;
}
//including the database connection file
include_once("config.php");

//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$encoding = "utf-8";

// Preferences for Subject field
$subject_preferences = array(
    "input-charset" => $encoding,
    "output-charset" => $encoding,
    "line-length" => 76,
    "line-break-chars" => "\r\n"
);
$mail_subject = $_POST['subject'];
$from_name = "kraken";
$from_mail = "kraken@live.ru";

$template = $_POST['template'];


$result = mysqli_query($mysqli, "SELECT * FROM users ORDER BY id DESC"); // using mysqli_query instead
while($res = mysqli_fetch_array($result)) { 	
    $variables = array();

    $variables['name'] = $from_name;
    $variables['email'] = $from_mail;
    $tmpl = makeTemplate($template, $variables);
    $subj = makeTemplate($mail_subject, $variables);
    
    // Mail header
    $header = "Content-type: text/html; charset=".$encoding." \r\n";
    $header .= "From: ".$from_name." <".$from_mail."> \r\n";
    $header .= "MIME-Version: 1.0 \r\n";
    $header .= "Content-Transfer-Encoding: 8bit \r\n";
    $header .= "Date: ".date("r (T)")." \r\n";
    $header .= iconv_mime_encode("Subject", $subj, $subject_preferences);
   
    // Send mail
    mail($res['email'], $subj, $tmpl, $header);
}
?>