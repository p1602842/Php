<?php
//textes affichage
define('TITRE', 'Impôts');
define ('NBENFANT',"Nombre d'enfants : ");
define ('MARIE', "Marié ");
define ('SALAIRE', "Salaire annuel : ");
define ('CALCULER', "Calculer");
define ('IMPOT', "Votre impôt prévisionnel est de : ");

//Controles
	if(!empty($_POST['marie']))
		$ismaried = "checked";
	else
		$ismaried = "";

	if(!empty($_POST['NBENFANT']) && !empty($_POST['SALAIRE']))
{
//Conversion valeurs
	$salaire = (int) $_POST['SALAIRE'];
	$nbEnfant = (int) $_POST['NBENFANT'];
	
//Calcul part
	if(!empty($_POST['marie']))
		$parts = $nbEnfant/2.0+2.0;
	else
		$parts = $nbEnfant/2.0+1.0;
	
//Calcul revenu imposable
	$revenuImposable = $salaire*0.72;
	
//Calcul q familial
	$quotientFamilial = $revenuImposable / $parts;
	
//Calcul impots
	if($quotientFamilial <=5614) $montantImpots = 0;
	
	elseif($quotientFamilial <=11198) $montantImpots = ($quotientFamilial-5614)*0.055;
		
	elseif($quotientFamilial <=24872) $montantImpots = ((11198-5614)*0.055) + ($quotientFamilial-11198)*0.14;
		
	elseif($quotientFamilial <=66679) $montantImpots = ((11198-5614)*0.055) + ((24872-11198)*0.14) + ($quotientFamilial-24872)*0.3;
		
	else $montantImpots = ((66679-24872)*0.3) + ((11198-5614)*0.055) + ((24872-11198)*0.14) + ($quotientFamilial-66679)*0.4;
	
	$montantImpots *= $parts;
}
?>
<!-- Affichage -->

<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<title><?php echo TITRE; ?></title>
	
</head>
<body>

	<form method = "post" action = "exercice4.php">
	
		<label> <?php echo NBENFANT ?></label><input type="text" name="NBENFANT" value="<?php if(isset($_POST['NBENFANT'])) { echo $_POST['NBENFANT']; }  ?>"/><br/>
		
		<label> <?php echo MARIE ?></label><input type="checkbox" name="marie" <?php echo $ismaried; ?>><br/>
		
		<label> <?php echo SALAIRE ?></label><input type="text" name="SALAIRE" value="<?php if(isset($_POST['SALAIRE'])){echo $_POST['SALAIRE'];} ?>"><br/>
		
		<input type="submit" value="<?php echo CALCULER ?>">
		
	</form>
	
	<?php if(isset($montantImpots))  echo IMPOT . $montantImpots ." €"; ?>
	
	
</body>
</html>