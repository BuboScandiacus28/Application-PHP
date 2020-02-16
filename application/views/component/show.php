<p>Компонент</p>

<p>
	<?php for ($i = 0; $i < count($inhance_path); $i++): ?>
		<a href=<?php echo "/component/show/?id=".$inhance_path[$i]['id'] ?>><?php echo $inhance_path[$i]['description'] ?></a>
		<?php
			if ($i < count($inhance_path) - 1)
			{
				echo '>';
			}
		?>
	<?php endfor; ?>
</p>

<?php for ($i = 1; $i < count($components); $i++): ?>
	<a href=<?php echo "/component/show/?id=".$components[$i]['id'] ?>><?php echo $components[$i]['description'] ?></a>
	<p>Номер на сайте: <?php echo $components[$i]['id'] ?></p>
	<hr>
	<br>
<?php endfor; ?>
<button><a href=<?php echo "/component/back/?id=".$components[0]['id']."&cod=".$components[0]['cod']."&lvl=".$components[0]['lvl'] ?>>Назад</a></button>

