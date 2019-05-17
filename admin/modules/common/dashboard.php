<?php if (!defined('IN_SITE')) die ('The request not found'); ?>
<?php include_once("widgets/header.php") ?>
<?php
	$sql= "SELECT * FROM products";
	$products=db_get_list($sql);
?>
<div class="w3-row-padding w3-padding-16 w3-center" id="food">
<?php $count=0?>;
<?php foreach ($products as $item) { ?>
	<div class="w3-quarter">
		<img src="../img_products/<?php echo($item['ID'])?>.png" style="width:100%">
		<h3> <?php echo($item['name'])?> </h3>
		<p> <?php echo ($item['price'])?>đ</p>
		<?php $count++; ?>
		<?php if ($count%4==0) echo "</div> <div class='w3-row-padding w3-padding-16 w3-center' id='food'>" ?>
	</div>
<?php } ?>
</div>
<?php include_once("widgets/footer.php");