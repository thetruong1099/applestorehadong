<?php if (!defined('IN_SITE')) die ('The request not found');
 
function db_customer_get_by_fullname($fullName){
    $fullName = addslashes($fullName);
    $sql = "SELECT * FROM customers WHERE fullName = '{$fullName}'";
    return db_get_row($sql);
}
function db_customer_edit_customer($data=array()){
    $customer_id = $data['ID'];
    $sql = "UPDATE customers SET fullName = '{$data['fullName']}',address='{$data['address']}',tel='{$data['tel']}',mail='{$data['mail']}',birth='{$data['birth']}' WHERE ID = $customer_id ";
    return db_execute($sql);
}
// Hàm validate dữ liệu bảng customer
function db_customer_validate($data)
{
    // Biến chứa lỗi
    $error = array();
     
    // fullName
    if (isset($data['fullName']) && $data['fullName'] == ''){
        $error['fullName'] = 'Bạn chưa nhập họ tên';
    }
    // address
    if (isset($data['address']) && $data['address'] == ''){
        $error['address'] = 'Bạn chưa nhập địa chỉ';
    }
    // tel
    if (isset($data['tel']) && $data['tel'] == ''){
        $error['tel'] = 'Bạn chưa nhập sđt';
    }
    // mail
    if (isset($data['mail']) && $data['mail'] == ''){
        $error['mail'] = 'Bạn chưa nhập email';
    }
    if (isset($data['mail']) && filter_var($data['mail'], FILTER_VALIDATE_EMAIL) === false){
        $error['mail'] = 'email không hợp lệ';
    }
    if (isset($data['birth']) && $data['birth'] == ''){
        $error['birth'] = 'Bạn chưa nhập ngày sinh';
    }

    /* VALIDATE LIÊN QUAN CSDL */
    // Kiểm tra các thao tác trước có bị lỗi không, nếu không bị lỗi thì mới
    // Tiếp tục kiểm tra bằng truy vấn CSDL
    // mail
    if (is_submit('add_customer') && !($error) && isset($data['mail'])){
        $sql = "SELECT count(ID) as counter FROM customers WHERE mail='".addslashes($data['mail'])."'";
        $row = db_get_row($sql);
        if ($row['counter'] > 0){
            $error['mail'] = 'email này đã tồn tại';
        }
    }
     
    return $error;
}