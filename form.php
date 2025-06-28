<?php 
if(isset($_POST['email'])) { 
    $email_to = "info@sabrinaserer.ar, pagliaccicesar@gmail.com"; 
    $email_subject = "Me contacto desde sabrinaserer.ar";    
    $first_name = $_POST['first_name']; // required   
    $email_from = $_POST['email']; // required    
    $telephone = $_POST['telephone']; // not required   
    $comments = $_POST['comments']; // required
     $newsletter = isset($_POST['newsletter']) ? "Sí desea recibir el Newsletter" : "No desea recibir el Newsletter";
    $error_message = ""; 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) { 
    $error_message .= '<li><h1>La dirección de correo electrónico es incorrecta<h1></li>'; 
  } 
    $string_exp = "/^[A-Za-z .'-]+$/"; 
  if(!preg_match($string_exp,$first_name)) { 
    $error_message .= '<li><h1>Ingrese correctamente su nombre</h1></li>'; 
  } 
  if(strlen($comments) < 2) { 
    $error_message .= '<li><p>Message appears to be incorrect</p></li>'; 
  } 
  if(strlen($error_message) > 0) { 
    died($error_message); 
  } 
    $email_message = "Estos son datos enviados desde formulario de sabrinaserer.ar.\n\n"; 

    
    function clean_string($string) { 
      $bad = array("content-type","bcc:","to:","cc:","href"); 
      return str_replace($bad,"",$string); 
    }
    $email_message .= "First Name: ".clean_string($first_name)."\n"; 
    $email_message .= "Email Adress: ".clean_string($email_from)."\n";    
    $email_message .= "Telefono: ".clean_string($telephone)."\n";   
    $email_message .= "Comments: ".clean_string($comments)."\n";
    $email_message .= "Newsletter: " . $newsletter . "\n";

$headers = "From: Sabrina <no-reply@sabrinaserer.ar>\r\n";    
 
//$headers = 'From: '.$email_from."\r\n". 
'Reply-To: '.$email_from."\r\n" . 
'X-Mailer: PHP/' . phpversion(); 
@mail($email_to, $email_subject, $email_message, $headers);   
?>

<?php
header("Location: https://www.sabrinaserer.ar/respuesta.html"); // Redirecionamos a Baulphp
exit(); //terminamos la ejecución del script php, ya que si redirecionamos ya no nos interesa seguir con el codigo PHP anterior.
 
//<!-- include your own success html here --> 
//<!--<h1 style="backgrund-color: red">Thank you for your message!</h1> <h2>We will contact you as soon as possible.</h2>-->
//<br>//
//<br>//

//<button><a href="./index.html">Home</a></button> 
 
//<?php 
}
 //?>

