<?php
  require 'functions/functionDateTime.php';
  require 'functions/functionToken.php';
  require 'modules/users/objets/getUser.php';
  require 'modules/users/objets/printUser.php';
  $user = new PrintUser();
  $dataUser = $user->getProfil($_SESSION['tokenConnexion']);
  echo '<div class="flex-rows">';
  echo '<article>';
  $user->printProfilUser ($dataUser);
  echo '</article>';
  echo '<button type="button" id="magic" class="open">Modifier le profil ?</button>';
  echo '<aside class="flex-colonne" id="hiddenForm">';
  // Modifier step by step
  //Email
  $formModifierProfil = [['name'=>'email', 'message'=>'Email', 'type'=>0, 'lastInput'=>$dataUser[0]['email']]];
    $button = 'Modifier email';
  formModification(16, $formModifierProfil, $idNav, $button);
  //Login
  $formModifierProfil = [['name'=>'login', 'message'=>'Pseudo', 'type'=>0, 'lastInput'=>$dataUser[0]['login']]];
    $button = 'Modifier pseudo';
  formModification(17, $formModifierProfil, $idNav, $button);
  //mdp
  $formModifierProfil = [['name'=>'mdp', 'message'=>'Nouveau mot de passe', 'type'=>0, 'lastInput'=>genToken (12)],
                        ['name'=>'mdpA', 'message'=>'Confirmer nouveau mot de passe', 'type'=>9, 'lastInput'=>'????']];
    $button = 'Modifier mot de passe';
  formModification(18, $formModifierProfil, $idNav, $button);
  $user->delUser($idNav);
    echo '</aside>';
echo '</div>';
  include 'javaScript/magicButton.php';
