<?php if (!defined('IN_SITE')) die ('The request not found'); ?>
<?php include_once('widgets/header.php'); ?>
<?php 
    $sql = "SELECT * FROM customers WHERE MONTH(customers.birth)=MONTH(CURRENT_DATE)";
    $customers = db_get_list($sql);
?>
<h1>Danh sách khách hàng có sinh nhật vào tháng <i id="mydate"> </i> </h1> 
<script>
    var mm= String(new Date().getMonth()+1);
    document.getElementById("mydate").innerHTML = mm;
</script>
<table class="w3-container w3-table-all">
    <thead>
        <tr class="w3-teal w3-padding-large">
            <td>Tên khách hàng</td>
            <td>Địa chỉ</td>
            <td>Số điện thoại</td>
            <td>Email</td>
            <td>Ngày sinh</td>
            <td>Tùy chọn</td>
        </tr>
    </thead>
    <tbody>
        <!-- Hiển thị danh sách khách hàng -->
        <?php foreach ($customers as $item){ ?>
            <tr>
                <td><?php echo $item['fullName']; ?> </td>
                <td><?php echo $item['address']; ?> </td>
                <td><?php echo $item['tel']; ?> </td>
                <td><?php echo $item['mail']; ?> </td>
                <td><?php echo $item['birth']; ?> </td>
                <td>
                    <form method="POST" class="form-detail" action="<?php echo base_url('admin/?m=customer&a=detail'); ?>">
                        <input type= "hidden" name= "id" value = <?php echo $item['ID']; ?> >
                        <input type= "hidden" name= "fullname" value = "<?php echo $item['fullName']; ?>" >
                        <input type= "hidden" name= "address" value = "<?php echo $item['address']; ?>" >
                        <input type= "hidden" name= "tel" value = "<?php echo $item['tel']; ?>" >
                        <input type= "hidden" name= "mail" value = <?php echo $item['mail']; ?> >
                        <input type= "hidden" name= "birth" value = <?php echo $item['birth']; ?> >
                        <input type= "hidden" name= "rlink" value = "birthlist" >
                        <a href="#" class="btn-detail">Xem chi tiết</a>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php include_once('widgets/footer.php'); ?>
<script language="javascript">
    $(document).ready(function(){
        //Nếu người dùng click vào nút xem chi tiết thì submit form
        $('.btn-detail').click(function(){
            $(this).parent().submit();
        })
    });
</script>