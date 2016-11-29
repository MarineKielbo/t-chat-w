<?= $this->layout('layout', ['title'=>'Listes des utilisateurs']); ?>

<?= $this->start('main_content'); ?>

<ul>
	<?php foreach ($listUsers as $user): ?>
		<li><?php echo $user['pseudo'] ?></li>
	<?php endforeach; ?>
</ul>


<?= $this->stop('main_content'); ?>