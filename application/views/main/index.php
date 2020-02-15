<p>Главная страница</p>

<?php foreach ($news as $val): ?>
	<h3><b><?php echo $val['title'] ?></b></h3>
	<p><?php echo $val['description'] ?></p>
	<hr>
	<br>
<?php endforeach; ?>

