<?php 

function afficherPost($champ){
	echo (!empty($_POST[$champ]) ? $_POST[$champ] : '');
}

function afficherCheck( $valeurAttendue){
	echo(!empty($_POST['sexe']) && $_POST['sexe'] == $valeurAttendue) ? 'checked' : '';
} ?>

<?php $this->layout('layout', ['title' => 'Inscrivez-vous']) ?>

<?php $this->start('main_content'); ?>

<h2>Inscription d'un utilisateur</h1>

<?php $fmsg->display(); ?>

	<form action="<?php $this->url('register'); ?>" method="POST" enctype="multipart/form-data"> 
		<p>
			<label for="pseudo">Pseudo :</label>
			<input type="text" name="pseudo" id="pseudo" placeholder="3 à 50 caractères" value="<?php afficherPost('pseudo'); ?> ">
		</p>
		<p>
			<label for="email">Email :</label>
			<input type="email" name="email" id="email" value="<?php afficherPost('email'); ?> ">
		</p>
		<p>
			<label for="mot_de_passe">Mot de passe :</label>
			<input type="text" name="mot_de_passe" id="mot_de_passe" value="<?php afficherPost('mot_de_passe'); ?>">
		</p>
		<p>
			<label for="femme">Femme :</label>
			<input type="radio" name="sexe" value="femme" femme" id="femme" <?php afficherCheck('femme')?>/>
			<label for="femme">Homme :</label>
			<input type="radio" name="sexe" value="homme" id="homme" <?php afficherCheck('homme')?>/>
			<label for="femme">Non-défini :</label>
			<input type="radio" name="sexe" value="non-défini" id="non-défini" <?php afficherCheck('non-defini')?>/>
		</p>
		<p>
			<label for="avatar">Avatar :</label>
			<input type="file" name="avatar" id="avatar">
		</p>
		<p>
			<input type="submit" name="send" value="S'inscrire">
		</p>
	</form>

<?php $this->stop('main_content'); ?>