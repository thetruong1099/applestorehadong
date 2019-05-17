<?php if (!defined('IN_SITE')) die ('The request not found'); ?>

 
<?php include_once('widgets/header.php'); ?>
<!-- khởi tạo biến error -->
<?php $error= array() ?>

<!-- valdiate -->
<?php
    if (is_submit('edit_user'))
    {
        // Lấy danh sách dữ liệu từ form
        $data = array(
            'ID' => input_post('id'),
            'username'  => input_post('username'),
            'password'  => input_post('password'),
            're-password'  => input_post('re-password'),
            'email'     => input_post('email'),
            'fullname'  => input_post('fullname'),
            'level'     => input_post('level'),
        );
         
        // require file xử lý database cho user
        require_once('database/user.php');
         
        // Thực hiện validate
        $error = db_user_validate($data);
         
        // Nếu validate không có lỗi
        if (!$error)
        {
            // Xóa key re-password ra khoi $data
            unset($data['re-password']);
             
            // Nếu sửa thành công thì thông báo
            // và chuyển hướng về trang danh sách user
            if (db_user_edit_user($data)){
                ?>
                <script language="javascript">
                    alert('Sửa thành công!');
                    window.location = '<?php echo base_url('admin/?m=user&a=list');; ?>';
                </script>
                <?php
            }
        }
    }
?>
<h1>Sửa thông tin user</h1>
 
<form id="main-form" method="post" action="<?php echo base_url('admin/?m=user&a=edit');;?>" >
    <input type="hidden" name="request_name" value="edit_user"/>
    <input type="hidden" name="id" value=<?php echo input_post('user_id'); ?> />
    <table cellspacing="0" cellpadding="0" class="form">
        <tr>
            <td width="200px">Tên đăng nhập</td>
            <td>
                <input type="text" name="username" value="<?php echo input_post('username'); ?>" />
                <?php show_error($error, 'username'); ?>
            </td>
        </tr>
        <tr>
            <td>Mật khẩu</td>
            <td>
                <input type="password" name="password" value="<?php echo input_post('password'); ?>" />
                <?php show_error($error, 'password'); ?>
            </td>
        </tr>
        <tr>
            <td>Nhập lại mật khẩu</td>
            <td>
                <input type="password" name="re-password" value="<?php echo input_post('re-password'); ?>" />
                <?php show_error($error, 're-password'); ?>
            </td>
        </tr>
        <tr>
            <td>Email</td>
            <td>
                <input type="text" name="email" value="<?php echo input_post('email'); ?>" class="long" />
                <?php show_error($error, 'email'); ?>
            </td>
        </tr>
        <tr>
            <td>Họ Tên</td>
            <td>
                <input type="text" name="fullname" value="<?php echo input_post('fullname'); ?>" class="long" />
                <?php show_error($error, 'fullname'); ?>
            </td>
        </tr>
        <tr>
            <td>Level</td>
            <td>
                <select name="level">
                    <option value="">-- Chọn Level --</option>
                    <option value="1">Admin</option>
                    <option value="2">Member</option>
                </select>
                <?php show_error($error, 'level'); ?>
            </td>
        </tr>
    </table>
</form>
<div>
    <a class="w3-button w3-black w3-hover-teal" onclick="$('#main-form').submit()" href="#">Lưu</a>
    <a class="w3-button w3-black w3-hover-teal" href="<?php echo base_url('admin/?m=user&a=list');;?>">Trở về</a>
</div>

<?php include_once('widgets/footer.php'); ?>