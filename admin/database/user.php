<?php if (!defined('IN_SITE')) die ('The request not found');
 
function db_user_get_by_username($username){
    $username = addslashes($username);
    $sql = "SELECT * FROM users WHERE username = '{$username}'";
    return db_get_row($sql);
}
function db_user_edit_user($data=array()){
    $user_id = $data['ID'];
    $sql = "UPDATE users SET username = '{$data['username']}', password = '{$data['password']}', email = '{$data['email']}', fullname= '{$data['fullname']}', level = '{$data['level']}' WHERE ID = $user_id ";
    return db_execute($sql);
}
// Hàm validate dữ liệu bảng User
function db_user_validate($data)
{
    // Biến chứa lỗi
    $error = array();
     
    // Username
    if (isset($data['username']) && $data['username'] == ''){
        $error['username'] = 'Bạn chưa nhập tên đăng nhập';
    }
     
    // Email
    if (isset($data['email']) && $data['email'] == ''){
        $error['email'] = 'Bạn chưa nhập email';
    }
    if (isset($data['email']) && filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false){
        $error['email'] = 'Email không hợp lệ';
    }
     
    // Password
    if (isset($data['password']) && $data['password'] == ''){
        $error['password'] = 'Bạn chưa nhập mật khẩu';
    }
     
    // Re-password
    if (isset($data['password']) && isset($data['re-password']) && $data['password'] != $data['re-password']){
        $error['re-password'] = 'Mật khẩu nhập lại không đúng';
    }
     
    // Level
    if (isset($data['level']) && !in_array($data['level'], array('1', '2'))){
        $error['level'] = 'Chưa chọn level';
    }
     
    /* VALIDATE LIÊN QUAN CSDL */
    // Kiểm tra các thao tác trước có bị lỗi không, nếu không bị lỗi thì mới
    // Tiếp tục kiểm tra bằng truy vấn CSDL
    // Username
    if (is_submit('add_user') && !($error) && isset($data['username']) && $data['username']){
        $sql = "SELECT count(ID) as counter FROM users WHERE username='".addslashes($data['username'])."'";
        $row = db_get_row($sql);
        if ($row['counter'] > 0){
            $error['username'] = 'Tên đăng nhập này đã tồn tại';
        }
    }
    // Email
    if (is_submit('add_user') && !($error) && isset($data['email']) && $data['email']){
        $sql = "SELECT count(ID) as counter FROM users WHERE email='".addslashes($data['email'])."'";
        $row = db_get_row($sql);
        if ($row['counter'] > 0){
            $error['email'] = 'Email này đã tồn tại';
        }
    }
     
    return $error;
}