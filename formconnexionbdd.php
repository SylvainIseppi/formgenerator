<form action="index.php?page=codeConnexion" method="POST">
	<div class="row">
		<div class="col s12">
			<div class="input-field col s4">
				<input type="text" name="chemin" id="chemin" class="validate" >
				<label for="chemin">chemin de la base</label>
			</div>
		</div>
	</div>

<div class="row">
	<div class="col s12">
		<div class="input-field col s4">
			<input type="text" name="nom" id="nom" class="validate" >
			<label for="nom">nom de la base</label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col s12">
		<div class="input-field col s4">
			<input type="text" name="nomdecompte" id="nomdecompte" class="validate" >
			<label for="nomdecompte">nom de compte de la base</label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col s12">
		<div class="input-field col s4">
			<input type="text" name="motdepasse" id="motdepasse" class="validate" >
			<label for="motdepassede">mot de passe de la base</label>
		</div>
	</div>
</div>
<button class="btn waves-effect waves-light" type="submit" name="valider" id="valider">valider
	<i class="mdi-content-send right"></i>
</button>

</form>