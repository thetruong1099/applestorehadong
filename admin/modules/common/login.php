<?php
$error = array();
 
// BƯỚC 1: KIỂM TRA NẾU LÀ ADMIN THÌ REDIRECT
if (is_admin()){
    redirect(base_url('admin/?m=common&a=dashboard'));
}
 
// BƯỚC 2: NẾU NGƯỜI DÙNG SUBMIT FORM
if (is_submit('login'))
{    
    // lấy tên đăng nhập và mật khẩu
    $username = input_post('uname');
    $password = input_post('psw');
     
    // Kiểm tra tên đăng nhập
    if (empty($username)){
        $error['username'] = 'Bạn chưa nhập tên đăng nhập';
    }
     
    // Kiểm tra mật khẩu
    if (empty($password)){
        $error['password'] = 'Bạn chưa nhập mật khẩu';
    }
     
    // Nếu không có lỗi
    if (!$error)
    {
        // include file xử lý database user
        include_once('database/user.php');
         
        // lấy thông tin user theo username
        $user = db_user_get_by_username($username);
         
        // Nếu không có kết quả
        if (empty($user)){
            $error['username'] = 'Tên đăng nhập không đúng';
        }
        // nếu có kết quả nhưng sai mật khẩu
        else if ($user['password'] != $password){
            $error['password'] = 'Mật khẩu bạn nhập không đúng';
        }
         
        // nếu mọi thứ ok thì tức là đăng nhập thành công 
        // nên thực hiện redirect sang trang chủ
        if (!$error){
            set_logged($user['username'], $user['level']);
            redirect(base_url('admin/?m=common&a=dashboard'));
        }
    }
}
 
?>
<?php include_once('widgets/header.php'); ?>
<?php include_once('widgets/style_login.css'); ?>
<form method="post" action="<?php echo base_url('admin/?m=common&a=login'); ?>">
  <div class="imgcontainer">
    <img src="../img_customers/img_avatar2.jpg" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
    <input type="hidden" name="request_name" value="login"/>   
    <button type="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
</form>
<?php include_once('widgets/footer.php'); ?>