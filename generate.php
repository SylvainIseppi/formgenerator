<?php
require('Field.class.php');
session_start();
?>
<div>
        <code>
    <?php
    echo htmlspecialchars("//partie formulaire");
    echo "<br />";
    echo htmlentities('<form action="index.php" method="POST"> ');
    echo " <BLOCKQUOTE>";
    if(isset($_SESSION['fields'])){
    $textAffiche= $_SESSION['fields']->HTMLize();
	$textExplode=explode("|",$textAffiche);
    $nbchamptab=count($textExplode);
    $i=1;
	foreach ($textExplode as $uneligne) {
		echo htmlspecialchars($uneligne);
        if($i<$nbchamptab){
		echo '<br />';
        }
        $i++;
	}	
	}
    echo htmlspecialchars('<input type="submit" name="valider" id="valider">');
    echo ' </BLOCKQUOTE>';
    echo htmlentities('</form>');
    echo "<br />";
    echo htmlspecialchars("//partie vérification données récuperer");
    echo "<br />";
    echo htmlentities("<?php");
    echo "<br />";
     if(isset($_SESSION['fields'])){

    $textAffiche= $_SESSION['fields']->checkize();
    $textExplode=explode("|",$textAffiche);
    $nbchamptab=count($textExplode);
    $i=1;
    foreach ($textExplode as $uneligne) {
        echo htmlspecialchars($uneligne);
        if($i<$nbchamptab){
        echo '<br /> <BLOCKQUOTE>';

        }
        $i++;
    }
    echo htmlspecialchars($_SESSION['fields']->requirize());  
    echo htmlspecialchars($_SESSION['fields']->typize()); 
    }
    echo "<br />";
     echo ' </BLOCKQUOTE>'; echo ' </BLOCKQUOTE>';
    echo htmlentities("?>");
    ?>
        </code>
</div>
<?php require('footer.php');