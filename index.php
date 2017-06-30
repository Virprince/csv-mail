<?php
  include"mail-with-csv.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Formulaire avec csv en PJ</title>
  </head>
  <style>
    form {
      display: block;
      width: 500px;
    }
    .form__group {
      padding: 10px 0;
      border-bottom: 1px dotted black;
    }
    .form__group label {
      display: inline-block;
      width: 150px;
      font-weight: bold;
    }
    .form__group input,
    .form__group select {
      display: inline-block;
      width: 300px;
    }

  </style>
  <body>
    <h1>Formulaire avec csv en PJ</h1>
    <form action="" method="post">
      <div class="form__group">
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" value="">
      </div>
      <div class="form__group">
        <label for="prenom">Prenom</label>
        <input type="text" name="prenom" id="prenom" value="">
      </div>
      <div class="form__group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="">
      </div>
      <div class="form__group">
        <label for="infos">Infos</label>
        <input type="text" name="infos" id="infos" value="">
      </div>
      <div class="form__group">
      <label for="choix">Champ 1</label>
      <select name="choix" id="choix">
         <option value="oui">Oui</option>
         <option value="non">Non</option>
         <option value="peut-etre">Peut être</option>
      </select>
      </div>
      <input id="submit" type="submit" value="Envoyer" />

    </form>

  </body>
</html>
