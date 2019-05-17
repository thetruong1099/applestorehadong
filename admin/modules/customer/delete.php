<?php
if (!defined('IN_SITE')) die ('The request not found');
// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
if (!is_supper_admin()){
    redirect(base_url('admin'), array('m' => 'common', 'a' => 'logout'));
}

// Nếu người dùng submit delete user
$id = (int)input_post('customer_id');
if ($id)
{     
    $sql = "DELETE FROM customers WHERE ID = $id";

    if (db_execute($sql)){
        ?>
        <script language="javascript">
            alert('Xóa thành công!');
            window.location = '<?php echo input_post('redirect'); ?>';
        </script>
        <?php
    }
    else{
        ?>
        <script language="javascript">
            alert('khách hàng đang mua hàng, không thể xóa');
            window.location = '<?php echo input_post('redirect'); ?>';
        </script>
        <?php
    }
}
else {
    ?>
    <script>
        alert('Không tìm thấy khách hàng');
        window.location = '<?php echo input_post('redirect'); ?>';
    </script>
    <?php
}
?>