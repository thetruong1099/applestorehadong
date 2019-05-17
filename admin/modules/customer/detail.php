<?php include_once('widgets/header.php'); ?>
<h2> Thông tin khách hàng </h2>
<!-- lấy ID khách hàng -->
<?php $ID= input_post('ID'); ?>
<div class= "w3-row-padding w3-padding-16 w3-center">
	<div class="w3-quarter">
		<img src="../img_customers/<?php echo $ID?>.jpg" style="width:100%; height:300px">
	</div>
	<div class="w3-quarter">
		<table class="w3-table">
			<tr>
				<td> Họ Tên: </td>
				<td> <?php echo input_post('fullName') ?></td>
			</tr>
			<tr>
				<td> Địa chỉ: </td>
				<td> <?php echo input_post('address') ?></td>
			</tr>
			<tr>
				<td> Số điện thoại: </td>
				<td> <?php echo input_post('tel') ?></td>
			</tr>
			<tr>
				<td> Email: </td>
				<td> <?php echo input_post('mail') ?></td>
			</tr>
			<tr>
				<td> Ngày sinh: </td>
				<td> <?php echo input_post('birth') ?></td>
			</tr>
		</table>
	</div>
</div>

<div class ="w3-container">
	<h3> Thông tin giỏ hàng </h3>
	<h5 class ="w3-text-red">
		<?php
		$carts=db_get_list("SELECT name, type, price, quantity, state 
			FROM products JOIN cart ON products.ID=cart.productID
			WHERE customerID=$ID");
		if(empty($carts)) echo "Giỏ hàng trống ";
		?>
	</h5>
</div>

<div>
	<?php if (!empty($carts)) { ?>
		<table class= "w3-container w3-table-all">
			<thead >
				<tr class = "w3-teal w3-padding">
					<td> Tên mặt hàng </td>
					<td> Loại mặt hàng </td>
					<td> Đơn giá </td>
					<td> Số lượng</td>
					<td> Trạng thái </td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($carts as $item) { ?>
					<tr>
						<td> <?php echo $item['name']; ?> </td>
						<td> <?php echo $item['type']; ?> </td>
						<td> <?php echo $item['price']; ?> </td>
						<td> <?php echo $item['quantity']; ?> </td>
						<td> <?php echo $item['state']==1 ? "Đã order": "Chưa order" ?> </td>
					</tr>
				<?php } ?>
			</tbody>
		</table> 
	<?php } ?>
</div>
<div>
	<a href="<?php echo create_link(base_url('admin'),array('m'=>'customer','a'=>input_post('rlink'))); ?>" class="w3-button w3-teal w3-margin-top"> Quay lại </a>
</div>
<?php include_once('widgets/footer.php'); ?>