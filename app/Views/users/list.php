<?php 

$this->layout('layout', ['title' => 'Liste des utilisateurs']);
$this->start('main_content');?>

<ul>
	<?php foreach($listUsers as $user): ?> <!--{foreach list=listUsers item=user} -->

	<li><?php echo $user['pseudo'] ?></li>

	<?php endforeach; ?> <!-- {/foreach} -->		
</ul>
<?php $this->stop('main_content'); ?>

