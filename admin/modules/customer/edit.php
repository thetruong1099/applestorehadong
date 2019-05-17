<?php if (!defined('IN_SITE')) die ('The request not found'); ?>

 
<?php include_once('widgets/header.php'); ?>
<!-- khởi tạo biến error -->
<?php $error= array() ?>
<!-- valdiate -->
<?php
    if (is_submit('edit_customer'))
    {
        // Lấy danh sách dữ liệu từ form
        $data = array(
            'ID' => input_post('id'),
            'fullName'  => input_post('fullName'),
            'address'  => input_post('address'),
            'tel'  => input_post('tel'),
            'mail'     => input_post('mail'),
            'birth'  => input_post('birth')
        );
         
        // require file xử lý database cho customer
        require_once('database/customer.php');
         
        // Thực hiện validate
        $error = db_customer_validate($data);
         
        // Nếu validate không có lỗi
        if (!$error)
        { 
            // Nếu sửa thành công thì thông báo
            // và chuyển hướng về trang danh sách customer
            if (db_customer_edit_customer($data)){
                ?>
                <script language="javascript">
                    alert('Sửa khách hàng thành công!');
                    window.location = '<?php echo base_url('admin/?m=customer&a=list'); ?>';
                </script>
                <?php
            }
            else{
                ?>
                <script language="javascript">
                    alert('Sửa khách hàng thất bại!');
                </script>
                <?php
            }

        }
    }
?>
<h1>Sửa thông tin khách hàng</h1>
<form id="main-form" method="post" action="<?php echo base_url('admin/?m=customer&a=edit');?>" >
    <input type="hidden" name="request_name" value="edit_customer"/>
    <input type="hidden" name="id" value="<?php echo input_post('ID') ?>" />
    <table cellspacing="0" cellpadding="0" class="form">
        <tr>
            <td width="200px">Họ tên</td>
            <td>
                <input type="text" name="fullName" value="<?php echo input_post('fullName') ?>" />
                <?php show_error($error, 'fullName'); ?>
            </td>
        </tr>
        <tr>
            <td>Địa chỉ</td>
            <td>
                <input type="text" name="address" value="<?php echo input_post('address') ?>"/>
                <?php show_error($error, 'address'); ?>
            </td>
        </tr>
        <tr>
            <td>Số điện thoại</td>
            <td>
                <input type="text" name="tel" value="<?php echo input_post('tel') ?>"/>
                <?php show_error($error, 'tel'); ?>
            </td>
        </tr>
        <tr>
            <td>Email</td>
            <td>
                <input type="text" name="mail" value="<?php echo input_post('mail') ?>"/>
                <?php show_error($error, 'mail'); ?>
            </td>
        </tr>
        <tr>
            <td>Ngày sinh</td>
            <td>
                <input type="date" name="birth"/ value="<?php echo input_post('birth') ?>">
                <?php show_error($error, 'date'); ?>
            </td>
        </tr>
    </table>
</form>
<div>
    <a class="w3-button w3-black w3-hover-teal" onclick="$('#main-form').submit()">Lưu</a>
    <a class="w3-button w3-black w3-hover-teal" href="<?php echo base_url('admin/?m=customer&a=list');?>">Trở về</a>
</div>

<?php include_once('widgets/footer.php'); ?>