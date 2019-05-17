<?php 
    if (!defined('IN_SITE')) die ('The request not found');

    // Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
    if (!is_admin()){
        redirect(base_url('admin'), array('m' => 'common', 'a' => 'logout'));
    }
?>

<?php include_once('widgets/header.php'); ?>

<?php 
    $sql = "SELECT * FROM users";
    $users = db_get_list($sql);
?>

<h1>Danh sách thành viên</h1>
<div class="w3-right">
    <a class="w3-button w3-teal" href="<?php echo base_url('admin/?m=user&a=add');?>"> Thêm </a>
</div>
<table class="w3-container w3-table-all">
    <thead>
        <tr class="w3-teal w3-padding-large w3-center">
            <td>ID</td>
            <td>Username</td>
            <td>Email</td>
            <td>Level</td>
            <?php if (is_supper_admin()){ ?>
            <td>Action</td>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php // VỊ TRÍ 02: CODE HIỂN THỊ DANH SÁCH NGƯỜI NGƯỜI DÙNG ?>
        <?php foreach ($users as $item){ ?>
        <tr>
            <td><?php echo $item['ID']; ?></td>
            <td><?php echo $item['username']; ?></td>
            <td><?php echo $item['email']; ?> </td>
            <td><?php echo $item['level']; ?> </td>
            <?php if (is_supper_admin()){ ?>
            <td>
                <form method="POST" class="form-delete" action="<?php echo base_url('admin/?m=user&a=delete'); ?>">
                    <input type="hidden" name="user_id" value="<?php echo $item['ID']; ?>"/>
                    <input type="hidden" name="request_name" value="delete_user"/>
                    <a href="#" class="btn-delete">Xóa</a>
                </form>
                <form method="POST" class="form-edit" action="<?php echo base_url('admin/?m=user&a=edit'); ?>">
                    <input type="hidden" name="user_id" value="<?php echo $item['ID']; ?>"/>
                    <input type="hidden" name="username" value="<?php echo $item['username']; ?>"/>
                    <input type="hidden" name="password" value="<?php echo $item['password']; ?>"/>
                    <input type="hidden" name="email" value="<?php echo $item['email']; ?>"/>
                    <input type="hidden" name="fullname" value="<?php echo $item['fullname']; ?>"/>
                    <input type="hidden" name="level" value="<?php echo $item['level']; ?>"/>
                    <input type = "hidden" name="user" value="<?php echo $item; ?>" />
                    <a href="#" class="btn-edit">Sửa</a>
                </form>
            </td>
            <?php } ?>
        </tr>
        <?php } ?>
    </tbody>
</table>
 
<?php include_once('widgets/footer.php'); ?>
<script language="javascript">
    $(document).ready(function(){
         //Nếu người dùng click vào nút edit thì submit form
        $('.btn-edit').click(function(){
            $(this).parent().submit();
        });
        // Nếu người dùng click vào nút delete thì submit form
        $('.btn-delete').click(function(){
            $(this).parent().submit();
            return false;
        });
 
        // Nếu sự kiện submit form xảy ra thì hỏi người dùng có chắc không?
        $('.form-delete').submit(function(){
            if (!confirm('Bạn có chắc muốn xóa thành viên này không?')){
                return false;
            }
            // trang delete sẽ lấy url này để chuyển hướng trở lại sau khi xóa xong
            $(this).append('<input type="hidden" name="redirect" value="'+window.location.href+'"/>');            
            // Thực hiện xóa
            return true;
        });
    });
</script>