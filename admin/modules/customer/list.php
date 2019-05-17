<?php if (!defined('IN_SITE')) die ('The request not found'); ?>
<?php include_once('widgets/header.php'); ?>
<?php 
    $sql = "SELECT * FROM customers";
    $customers = db_get_list($sql);
?>

<h1>Danh sách khách hàng</h1>
<?php if(is_supper_admin()){ ?>
<div class="w3-right">
    <a class="w3-button w3-teal" href="<?php echo base_url('admin/?m=customer&a=add') ?>"> Thêm </a>
</div>
<?php } ?>
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
                        <input type= "hidden" name= "ID" value = "<?php echo $item['ID']; ?>" >
                        <input type= "hidden" name= "fullName" value = "<?php echo $item['fullName']; ?> ">
                        <input type= "hidden" name= "address" value = "<?php echo $item['address']; ?>" >
                        <input type= "hidden" name= "tel" value = "<?php echo $item['tel']; ?>" >
                        <input type= "hidden" name= "mail" value = "<?php echo $item['mail']; ?>" >
                        <input type= "hidden" name= "birth" value = "<?php echo $item['birth']; ?>" >
                        <input type ="hidden" name= "rlink" value = "list" >
                        <a href="#" class="btn-detail">Xem chi tiết</a>
                    </form>
                    <form method="POST" class="form-edit" action="<?php echo base_url('admin/?m=customer&a=edit'); ?>">
                        <input type= "hidden" name= "ID" value ="<?php echo $item['ID']; ?>" >
                        <input type= "hidden" name= "fullName" value = "<?php echo $item['fullName']; ?> ">
                        <input type= "hidden" name= "address" value = "<?php echo $item['address']; ?>" >
                        <input type= "hidden" name= "tel" value = "<?php echo $item['tel']; ?>" >
                        <input type= "hidden" name= "mail" value = "<?php echo $item['mail']; ?>" >
                        <input type= "hidden" name= "birth" value = "<?php echo $item['birth']; ?>" >
                        <input type ="hidden" name= "rlink" value = "list" >
                        <a href="#" class="btn-edit">Sửa</a>
                    </form>
                    <form method="POST" class="form-delete" action="<?php echo base_url('admin/?m=customer&a=delete'); ?>">
                        <input type="hidden" name="customer_id" value="<?php echo $item['ID']; ?>"/>
                        <a href="#" class="btn-delete">Xóa</a>
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
        });
        $('.btn-edit').click(function(){
            $(this).parent().submit();
        });
        $('.btn-delete').click(function(){
            $(this).parent().submit();
        });
        $('.form-delete').submit(function(){
            if(!confirm('Bạn chắc chắn muốn xóa khách hàng này')) return false;
            $(this).append('<input type="hidden" name="redirect" value="'+window.location.href+'"/>');
            return true;
        });
    });
</script>