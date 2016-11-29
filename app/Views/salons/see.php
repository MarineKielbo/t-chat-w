<?php $this->layout('layout', ['title' => 'Message de mon salon'])?>

<?php $this->start('main_content') ?>

<!-- Ici on a uniquement $salon et $messages à notre disposition  -->

<h2>Bienvenue sur le salon "<?= $this->e($salon['nom']); ?>"</h2>
<ol class="messages">
   
    <?php  foreach ($messages as $message) : ?>

    <li>

	    <span class="personne"><?= $this->e($message['pseudo']);?> : </span>
	    <span class="messages"><?= $this->e($message['corps']);?></span>


    </li>

    <?php endforeach ; ?>
    
</ol>

<!-- J'envoie mon formulaire d'ajout de message sur la page courante
cela va me permettre d'ajouter mes messages à ce salon précisément.
-->

<form class="form-message" action="<?php $this->url('view_salon', array('id'=>$salon['id'])) ?>" method="POST">
    <input type="text" name="message" /><input type="submit" class="button" name="send" value="Envoyer"/>
</form>

<?php $this->stop('main_content') ?>

