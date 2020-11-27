<?php 

$array = array("firstname" => "", "name" => "", "email" => "", "message" => "", "firstnameError" => "", "nameError" => "", "emailError" => "", "messageError" => "", "isSuccess" => false);// string vide


$emailTo = "pbaurens.dev@gmail.com";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  $array["firstname"] = verifyInput($_POST["firstname"]); /* récupération infos utilisateur */
  $array["name"] = verifyInput($_POST["name"]);
  $array["email"] = verifyInput($_POST["email"]);
  $array["message"] = verifyInput($_POST["message"]);
  $array["isSuccess"] = true;
  $emailText = "";



  if(empty($array["firstname"])) /* Si champ vide affichage messages d'erreur */
  {
    $array["firstnameError"] = "Veuillez remplir ce champ !";
    $array["isSuccess"] = false;
  }
  else
  {
    $emailText .= "Firstname: {$array["firstname"]}\n";
  }
      
  if(empty($array["name"])) 
  {
    $array["nameError"] = "Veuillez remplir ce champ !";
    $array["isSuccess"] = false;
  }
  else
  {
    $emailText .= "Name: {$array["name"]}\n";
  }
      
  if(!isEmail($array["email"])) 
  {
    $array["emailError"] = "Ceci n'est pas une adresse email !";
    $array["isSuccess"] = false;
  }
  else
  {
    $emailText .= "Email: {$array["email"]}\n";
  }
  if(empty($array["message"])) 
  { 
    $array["messageError"] = "Veuillez remplir ce champ !";
    $array["isSuccess"] = false;
  }
  else
  {
    $emailText .= "Message: {$array["message"]}\n";
  }
  if($array["isSuccess"])
  {
    $headers = "From: {$array["firstname"]} {$array["name"]} <{$array["email"]}>\r\nReply-To: {$array["email"]}";
    mail($emailTo, "Un message de votre site", $emailText , $headers);//Envoi de l'email
  }

  echo json_encode($array);

}


/* function isPhone($var) // vérifie si numéro entréé est bien numéro de telephone
{
  return preg-match("/^[0-9 ]*$/", $var);
}*/

/* boolean  Prend la variable entrée et la compare avec le filtre de validation.Renvoi true si email valide et inversement */
function isEmail($var)
{
  return filter_var($var, FILTER_VALIDATE_EMAIL);
}

/* SÉCURITÉ DU FORMULAIRE */
function verifyInput($var)// nettoyage des variables
{
  $var = trim($var); // supprime les espaces les retour a la ligne
  $var = stripslashes($var); //supprime les antislash
  $var = htmlspecialchars($var); // previent de la faille XXS (INJECTION DE SCRIPT DS L'URL)
  return $var;
}

/* VALIDATION DU FORMULAIRE */

?>