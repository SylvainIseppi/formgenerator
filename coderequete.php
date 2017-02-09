<?php
echo htmlentities("<!--début de la page a ne pas copier si vous avez deja commencer la page!-->");
echo '<br />';
echo htmlentities("<?php");
echo '<br />';
echo htmlentities("class [nom_object_creer] {");
echo '<br /><BLOCKQUOTE>';
echo htmlentities("//copiez ceci <br />");
if(!empty($_POST['tableSA'])){
	$tableSA=$_POST['tableSA'];
	$nbParametreSA=$_POST['nbParametreSA'];
	?>
	<br />
	private $selectAll;
	<?php
	echo '<br />';
	
}
if(!empty($_POST['tableSO'])){
	$tableSO=$_POST['tableSO'];
	$nbElementSO=$_POST['nbElementSO'];
	$nbParametreSO=$_POST['nbParametreSO'];
	?>
	private $selectOne;
	<?php
	echo '<br />';
}
if(!empty($_POST['tableInsert'])){
	$tableInsert=$_POST['tableInsert'];
	$nbElementInsert=$_POST['nbElementInsert'];
	?>
	private $insertAll;
	<?php
	echo '<br />';
}
if(!empty($_POST['tableUpdate'])){
	$tableUpdate=$_POST['tableUpdate'];
	$nbElementUpdate=$_POST['nbElementUpdate'];
	$nbParametreUpdate=$_POST['nbParametreUpdate'];
	?>
	private $upateOne;
	<?php
	echo '<br />';
}
if(!empty($_POST['tableDel'])){
	$tableDel=$_POST['tableDel'];
	$nbParametreDel=$_POST['nbParametreDel'];
	?>
	private $DeleteOne;
	<?php
	echo '<br />';
}
?>
//si vous avez commencer la page ne copiez pas la ligne suivante
<br />
public function __construct($db){
<BLOCKQUOTE>
<br />
<?php
if(!empty($_POST['tableSA'])){
	?>
	$this-> selectAll=$db -> prepare("SELECT * from 
		<?php
		echo $tableSA;
		if($nbParametreSA!=null){
			if($nbParametreSA!=0){
				echo ' where ';
				for($i=0;$i<$nbParametreSA;$i++){
					$nomParam='parametreSA'.$i;
					if($nbParametreSA-$i==1){
						echo $_POST[$nomParam].'=:'.$_POST[$nomParam].'';
					}
					else{
						echo $_POST[$nomParam].'=:'.$_POST[$nomParam].' AND ';
					}
				}
				echo'");';
}
}
}
if(!empty($_POST['tableSO'])){
	?>
	<br />
	$this-> selectOne=$db -> prepare("SELECT 
		<?php
		if($nbElementSO!=null){
			for($i=0;$i<$nbElementSO;$i++){
				$nomElement='elementSO'.$i;
				if($nbElementSO-$i==1){
					echo $_POST[$nomElement];
				}
				else{
					echo $_POST[$nomElement].', ';
				}
			}

		}

		?>

		from 
		<?php
		echo $tableSO;
		if($nbParametreSO!=null){
			if($nbParametreSO!=0){
				echo ' where ';
				for($i=0;$i<$nbParametreSO;$i++){
					$nomParam='parametreSO'.$i;
					if($nbParametreSO-$i==1){
						echo $_POST[$nomParam].'=:'.$_POST[$nomParam].'';
					}
					else{
						echo $_POST[$nomParam].'=:'.$_POST[$nomParam].' AND ';
					}
				}
				echo'");';
}
}
}
if(!empty($_POST['tableInsert'])){
	?>
	<br />
	$this-> insertAll=$db -> prepare("INSERT INTO  
		<?php
		echo $tableInsert.'(';
			if($nbElementInsert!=null){
				for($i=0;$i<$nbElementInsert;$i++){
					$nomElement='elementInsert'.$i;
					if($nbElementInsert-$i==1){
						echo $_POST[$nomElement];
					}
					else{
						echo $_POST[$nomElement].', ';
					}
				}
				echo ')VALUES(';
				for($i=0;$i<$nbElementInsert;$i++){
					$nomElement='elementInsert'.$i;
					if($nbElementInsert-$i==1){
						echo ':'.$_POST[$nomElement];
					}
					else{
						echo ':'.$_POST[$nomElement].', ';
					}

				}
				echo '");';
}
}
if(!empty($_POST['tableUpdate'])){
	?>
	<br />
	$this-> updateAll=$db -> prepare("UPDATE 
		<?php
		echo $tableUpdate.' SET ';
		if($nbElementUpdate!=null){
			for($i=0;$i<$nbElementUpdate;$i++){
				$nomElement='elementUpdate'.$i;
				if($nbElementUpdate-$i==1){
					echo $_POST[$nomElement].'=:'.$_POST[$nomElement];
				}
				else{
					echo $_POST[$nomElement].'=:'.$_POST[$nomElement].', ';
				}
			}
			echo ' WHERE ';
			for($i=0;$i<$nbParametreUpdate;$i++){
				$nomParam='parametreUpdate'.$i;
				if($nbParametreUpdate-$i==1){
					echo $_POST[$nomParam].'=:'.$_POST[$nomParam];
				}
				else{
					echo ''.$_POST[$nomParam].'=:'.$_POST[$nomParam].' AND ';
				}

			}
			echo '");';
}
}
if(!empty($_POST['tableDel'])){
	?>
	<br />
	$this-> DeleteOne=$db -> prepare("DELETE FROM
		<?php
		echo $tableDel.' WHERE ';
		for($i=0;$i<$nbParametreDel;$i++){
			$nomParam='parametreDel'.$i;
			if($nbParametreDel-$i==1){
				echo $_POST[$nomParam].'=:'.$_POST[$nomParam];
			}
			else{
				echo ''.$_POST[$nomParam].'=:'.$_POST[$nomParam].' AND ';
			}

		}
		echo '");';
}
echo '<br /></BLOCKQUOTE>}<br />';


if(!empty($_POST['tableSA'])){
	echo "public function selectAll(";
		for($i=0;$i<$nbParametreSA;$i++){
			$nomParam='parametreSA'.$i;
			echo '$';
			if($nbParametreSA-$i==1){
				echo $_POST[$nomParam].' ';
			}
			else{
				echo ''.$_POST[$nomParam].', ';
			}
		}
		echo '){
	<BLOCKQUOTE>';
		?>
		<br />
		$this->SelectAll->execute(array(
			<?php
			for($i=0;$i<$nbParametreSA;$i++){
				$nomParam='parametreSA'.$i;
				echo "':".$_POST[$nomParam]."'=>";
				echo '$';
				if($nbParametreSA-$i==1){
					echo $_POST[$nomParam];
				}
				else{
					echo $_POST[$nomParam].', ';	
				}
			}
			echo '));';
			?>
			<br />
			return $this->selectAll->fetchAll();
			<br />
			<?php
			echo '</BLOCKQUOTE>} <br />';



		}
		if(!empty($_POST['tableSO'])){
			echo "public function selectAll(";
				for($i=0;$i<$nbElementSO;$i++){
					$nomElement='elementSO'.$i;
					echo '$';
					echo $_POST[$nomElement].', ';	
					
				}
				for($i=0;$i<$nbParametreSO;$i++){
					$nomParam='parametreSO'.$i;
					echo '$';
					if($nbParametreSO-$i==1){
						echo $_POST[$nomParam].', ';
					}
					else{
						echo ''.$_POST[$nomParam].', ';
					}
				}
				echo '){
	<BLOCKQUOTE>';
				?>
				<br />
				$this->SelectOne->execute(array(
					<?php
					for($i=0;$i<$nbElementSO;$i++){
						$nomElement='elementSO'.$i;
						echo "':".$_POST[$nomElement]."'=>";
						echo '$';
						echo $_POST[$nomElement].', ';	
						
					}
					for($i=0;$i<$nbParametreSO;$i++){
						$nomParam='parametreSO'.$i;
						echo "':".$_POST[$nomParam]."'=>";
						echo '$';
						if($nbParametreSO-$i==1){
							echo $_POST[$nomParam];
						}
						else{
							echo $_POST[$nomParam].', ';	
						}
					}
					echo '));';
					?>
					<br />
					return $this->selectAll->fetch();
					<br />
					<?php
					echo '</BLOCKQUOTE>} <br />';



				}
				if(!empty($_POST['tableInsert'])){
					echo "public function InsertAll(";
						for($i=0;$i<$nbElementInsert;$i++){
							$nomParam='elementInsert'.$i;
							echo '$';
							if($nbElementInsert-$i==1){
								echo $_POST[$nomParam].' ';
							}
							else{
								echo ''.$_POST[$nomParam].', ';
							}
						}
						echo '){<BLOCKQUOTE>';
						?>
						<br />
						$this->InsertAll>execute(array(
							<?php
							for($i=0;$i<$nbElementInsert;$i++){
								$nomParam='elementInsert'.$i;
								echo "':".$_POST[$nomParam]."'=>";
								echo '$';
								if($nbElementInsert-$i==1){
									echo $_POST[$nomParam].', ';
								}
								else{
									echo ''.$_POST[$nomParam].', ';
								}
							}
							echo '));';
							?>
							<br />
							return $this->InsertAll->RowCount();
							<br />
							<?php
							echo '</BLOCKQUOTE>}<br />';



						}
						if(!empty($_POST['tableUpdate'])){
							echo "public function updateOne(";
								for($i=0;$i<$nbElementUpdate;$i++){
									$nomElement='elementUpdate'.$i;
									echo '$';
									echo $_POST[$nomElement].' ';	
									
								}
								for($i=0;$i<$nbParametreUpdate;$i++){
									$nomParam='parametreUpdate'.$i;
									echo '$';
									if($nbParametreUpdate-$i==1){
										echo $_POST[$nomParam].' ';
									}
									else{
										echo ''.$_POST[$nomParam].', ';
									}
								}
								echo '){<BLOCKQUOTE>';
								?>
								<br />
								$this->updateOne->execute(array(
									<?php
									for($i=0;$i<$nbElementUpdate;$i++){
										$nomElement='elementUpdate'.$i;
										echo "':".$_POST[$nomElement]."'=>";
										echo '$';
										echo $_POST[$nomElement].', ';	
										
									}
									for($i=0;$i<$nbParametreUpdate;$i++){
										$nomParam='parametreUpdate'.$i;
										echo "':".$_POST[$nomParam]."'=>";
										echo '$';
										if($nbParametreUpdate-$i==1){
											echo $_POST[$nomParam];
										}
										else{
											echo $_POST[$nomParam].', ';	
										}
									}
									echo '));';
									?>
									<br />
									return $this->updateOne->RowCount();
									<br />
									<?php
									echo '</BLOCKQUOTE>}<br />';



								}
								if(!empty($_POST['tableDel'])){
									echo "public function deleteOne(";
										for($i=0;$i<$nbParametreDel;$i++){
											$nomParam='parametreDel'.$i;
											echo '$';
											if($nbParametreDel-$i==1){
												echo $_POST[$nomParam].' ';
											}
											else{
												echo ''.$_POST[$nomParam].', ';
											}
										}
										echo '){<BLOCKQUOTE>';
										?>
										<br />
										$this->deleteOne->execute(array(
											<?php
											for($i=0;$i<$nbParametreDel;$i++){
												$nomParam='parametreDel'.$i;
												echo "':".$_POST[$nomParam]."'=>";
												echo '$';
												if($nbParametreDel-$i==1){
													echo $_POST[$nomParam];
												}
												else{
													echo $_POST[$nomParam].', ';	
												}
											}
											echo '));';
											?>
											<br />
											return $this->deleteOne->rowCount();
											<br />
											<?php
											echo '</BLOCKQUOTE>}';



										}
										echo '<br /> </BLOCKQUOTE>} <br />';

										echo'?>';


										?>

