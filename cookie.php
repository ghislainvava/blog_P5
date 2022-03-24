
<?php
$name = null;
if(!empty($_GET['action']) && $_GET['action'] === 'deconnecter') {
  unset($_COOKIE['utilisateur'])  ; //pour supprimer l'utilisateur
  setcookie('utilisateur', time() - 10); //pour supprimer les info dans le navigateur
}
if(!empty($_COOKIE['utilisateur']))  {
    $name = $_COOKIE['utilisateur'];     //pour vérifier si l'utilisateur à déjà un cookie
}
if(!empty($_POST['name'])) {
    setcookie('utilisateur', $_POST['name']); 
  }  //pour récupérer les infos du cookie
 include("header.php");

 ?>

 <?php if ($name): ?>
    <h1>Bonjour <?php htmlentities($name)  ?></h1>
    <a href="cookie.php?action=deconnecter">Se déconnecter</a>
<?php else: ?>
<div class="container">
				<form action="" method="POST">
					<div class="col-md-6 form-line">
			  			<div class="form-group">
			  				<label for="exampleInputUsername">Votre Nom</label>
					    	<input type="text" name="name" class="form-control mb-2" id="" placeholder=" Entrez votre nom" required>
				  		</div>
				  		
			  				<button type="submit" class="btn btn-default submit"><i class="fa fa-paper-plane" ></i>  Envoyez</button>
			  			</div>
			  			
					</div>
				</form>
</div>

<?php endif; ?>