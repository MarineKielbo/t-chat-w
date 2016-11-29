<?php $this->layout('layout', ['title' => 'connectez-vous ! ']);?>

<?php $this->start('main_content'); ?>

<h2>Connectez-vous à T'Chat</h2>

<?php $fmsg->display(); ?>

<form action="<?php echo $this->url('login'); ?>" method="post">
    <p>
        <label for="pseudo">
            Veuillez renseigner un pseudo :
        </label>
        <input type="text" name="pseudo" id="pseudo" value="<?php echo isset($datas['pseudo'])? $datas['pseudo'] : '' ?>"/>
    </p>
    <p>
        <label for="pass">
            Veuillez renseigner un mot de passe :
        </label>
        <input type="password" name="mot_de_passe" id="pass" />
    </p>
    <p>
        <input type="submit" class="button" value="Me connecter"/>
    </p>
    <!-- <p> Inscription : <a href="#" title="Lien pour s'inscrire">Inscription</a></p> -->

</form>

<?php $this->stop('main_content'); ?>