<?php
//Vérification compte avec le token
$arrayKey = ['login', 'mdp', 'token', 'idNav'];
if (checkPostFields ($arrayKey, $_POST)) {
  $select = "SELECT `mdp` FROM `users` WHERE `valide` = 0 AND `token` = :token AND `login` = :login";
  $param = [['prep'=>':token', 'variable'=>filter($_POST['token'])], ['prep'=>':login', 'variable'=>filter($_POST['login'])]];
  $dataTraiter = ActionDB::select($select, $param);
  if(password_verify(filter($_POST['mdp']), $dataTraiter[0]['mdp'])) {
    // Mise à jour du compte
    $update = "UPDATE `users` SET `valide` = 1, `role` = 1 WHERE `token` = :token";
    $param = [['prep'=>':token', 'variable'=>filter($_POST['token'])]];
   ActionDB::access($update, $param);
   header('location:../index.php?message=Votre compte est actif&idNav='.$idNav);
  } else {
   header('location:../index.php?message=Activation échoué&idNav='.$idNav);
  }
} else {
  header('location:../index.php?message=Activation échoué&idNav='.$idNav);
}

