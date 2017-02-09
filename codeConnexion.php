<?php
echo '<h2> méthode orienté object</h2>';
echo htmlentities("<?php");
echo '<br />';
echo htmlentities("try{");
echo '<BLOCKQUOTE><br />';
echo htmlentities(" // Changer ici les paramètres de connexion");
echo '<br />';
?>
//$db =
<?php
echo"new PDO('mysql:host=".$_POST['chemin'].";dbname='".$_POST['nom']."', '".$_POST['nomdecompte']."', ' ".$_POST['motdepasse']." '); <br />";
?>
$db =
<?php
echo " new PDO('mysql:unix_socket=".$_POST['chemin'].";dbname=".$_POST['nom']."', ' ".$_POST['nomdecompte']."', ' ".$_POST['motdepasse']." '); <br />";
?>
 </BLOCKQUOTE>
  }
 
  <br />

  catch(Exception $e){
  <BLOCKQUOTE>
	echo "Echec : " . $e->getMessage();
  <br />
  </BLOCKQUOTE>
  }
<h2> méthode procédural </h2>
<?php
  echo htmlentities('mysqli_connect("'.$_POST['chemin'].'" , "'.$_POST['nomdecompte'].'" , "'.$_POST['motdepasse'].'" , "'.$_POST['chemin'].'"); ');
?>