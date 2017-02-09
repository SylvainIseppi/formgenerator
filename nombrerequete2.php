<?php
echo '<form action="index.php?page=coderequete" method="POST">

<div class="row">';
if($_POST['nomtableSA']!=null){
	$tableSA=htmlentities($_POST['nomtableSA']);
	$nbParametreSA=htmlentities($_POST['nbparametreSA']);
	echo'<br />
	<input type="hidden" name="tableSA" id="tableSA" value="'.$tableSA.'">
	<input type="hidden" name="nbParametreSA" id="nbParametreSA" value="'.$nbParametreSA.'">

	<div class="row">
	<div class="col s2">
	<div class="row">
	<div class="section">
	<h4>Select All</h4>
	<p></p>
	</div>
	</div>
	<h5>	paramètre:<br /></h5>
	';
	for($i=0;$i<$nbParametreSA;$i++){
		echo'

		<div class="row">
		<div class="input-field col s12">
		<input type="text" name="parametreSA'.$i.'" id="parametreSA'.$i.'" class="validate" >
		<label for="parametreSA'.$i.'">parametre '.$i.' </label>
		</div>
		</div>
		';
	}
	echo '
	</div>
	';
}
if($_POST['nomtableSO']!=null){
	$tableSO=htmlentities($_POST['nomtableSO']);
	$nbParametreSO=htmlentities($_POST['nbparametreSO']);
	$nbElementSO=htmlentities($_POST['nbelementSO']);
	echo'
	<input type="hidden" name="tableSO" id="tableSO" value="'.$tableSO.'">
	<input type="hidden" name="nbParametreSO" id="nbParametreSO" value="'.$nbParametreSO.'">
	<input type="hidden" name="nbElementSO" id="nbElementSO"value="'.$nbElementSO.'">
	<div class="row">
	<div class="col s2">
	<div class="row">
	<div class="section">
	<h4>Select One</h4>
	<p></p>
	</div>
	</div>
	<h5> élément</h5>';
	for($i=0;$i<$nbElementSO;$i++){
		echo'

		<div class="row">
		<div class="input-field col s12">
		<input type="text" name="elementSO'.$i.'" id="elementSO'.$i.'" class="validate" >
		<label for="elementSO'.$i.'">element '.$i.' </label>
		</div>
		</div>
		';
	}
	echo'
	<h5>	paramètre:<br /></h5>';

	for($i=0;$i<$nbParametreSO;$i++){
		echo'

		<div class="row">
		<div class="input-field col s12">
		<input type="text" name="parametreSO'.$i.'" id="parametreSO'.$i.'" class="validate" >
		<label for="parametreSO'.$i.'">parametre '.$i.' </label>
		</div>
		</div>
		';
	}
	echo '</div>';
}
if($_POST['nomtableInsert']!=null){
	$tableInsert=htmlentities($_POST['nomtableInsert']);
	$nbElementInsert=htmlentities($_POST['nbelementInsert']);
	echo'
	<input type="hidden" name="tableInsert" id="tableInsert" value="'.$tableInsert.'">
	<input type="hidden" name="nbElementInsert" id="nbElementInsert" value="'.$nbElementInsert.'">

	<div class="row">
	<div class="col s2">
	<div class="row">
	<div class="section">
	<h4>Insert</h4>
	<p></p>
	</div>
	</div>
	<h5>	éléments:<br /></h5>
	';
	for($i=0;$i<$nbElementInsert;$i++){
		echo'

		<div class="row">
		<div class="input-field col s12">
		<input type="text" name="elementInsert'.$i.'" id="elementInsert'.$i.'" class="validate" >
		<label for="elementInsert'.$i.'">élément '.$i.' </label>
		</div>
		</div>
		';
	}
	echo '
	</div>
	';
}
if($_POST['nomtableUpdate']!=null){
	$tableUpdate=htmlentities($_POST['nomtableUpdate']);
	$nbParametreUpdate=htmlentities($_POST['nbparametreUpdate']);
	$nbElementUpdate=htmlentities($_POST['nbelementUpdate']);
	echo'
	<input type="hidden" name="tableUpdate" id="tableUpdate" value="'.$tableUpdate.'">
	<input type="hidden" name="nbParametreUpdate" id="nbParametreUpdate" value="'.$nbParametreUpdate.'">
	<input type="hidden" name="nbElementUpdate" id="nbElementUpdate" value="'.$nbElementUpdate.'">
	<div class="row">
	<div class="col s2">
	<div class="row">
	<div class="section">
	<h4>Update</h4>
	<p></p>
	</div>
	</div>
	<h5> élément</h5>';
	for($i=0;$i<$nbElementUpdate;$i++){
		echo'

		<div class="row">
		<div class="input-field col s12">
		<input type="text" name="elementUpdate'.$i.'" id="elementUpdate'.$i.'" class="validate" >
		<label for="elementUpdate'.$i.'">element '.$i.' </label>
		</div>
		</div>
		';
	}
	echo'
	<h5>	paramètre:<br /></h5>';

	for($i=0;$i<$nbParametreUpdate;$i++){
		echo'

		<div class="row">
		<div class="input-field col s12">
		<input type="text" name="parametreUpdate'.$i.'" id="parametreUpdate'.$i.'" class="validate" >
		<label for="parametreUpdate'.$i.'">parametre '.$i.' </label>
		</div>
		</div>
		';
	}
	echo '</div>';
}
if($_POST['nomtableDel']!=null){
	$tableDel=htmlentities($_POST['nomtableDel']);
	$nbParametreDel=htmlentities($_POST['nbparametreDel']);
	echo'
	<input type="hidden" name="tableDel" id="tableSA" value="'.$tableDel.'">
	<input type="hidden" name="nbParametreDel" id="nbParametreDel" value="'.$nbParametreDel.'">

	<div class="row">
	<div class="col s2">
	<div class="row">
	<div class="section">
	<h4>Delete</h4>
	<p></p>
	</div>
	</div>
	<h5>	paramètre:<br /></h5>
	';
	for($i=0;$i<$nbParametreDel;$i++){
		echo'

		<div class="row">
		<div class="input-field col s12">
		<input type="text" name="parametreDel'.$i.'" id="parametreDel'.$i.'" class="validate" >
		<label for="parametreDel'.$i.'">parametre '.$i.' </label>
		</div>
		</div>
		';
	}
	echo '
	</div>
	</div>
	';
}
echo '
</div>
<div class="row">
<button class="btn waves-effect waves-light" type="submit" name="valider" id="valider">valider
<i class="mdi-content-send right"></i>
</div>
</form>';

?>