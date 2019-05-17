<?php
// Hàm tạo URL
function base_url($uri = ''){
    return 'http://localhost/applestorehadong/'.$uri;
}
 
// Hàm redirect
function redirect($url){
    header("Location:{$url}");
    exit();
}
 
// Hàm lấy value từ $_POST
function input_post($key){
    return isset($_POST[$key]) ? $_POST[$key] : false;
}
 
// Hàm lấy value từ $_GET
function input_get($key){
    return isset($_GET[$key]) ? $_GET[$key] : false;
}
 
// Hàm kiểm tra submit
function is_submit($key){
    return (isset($_POST['request_name']) && $_POST['request_name'] == $key);
}
 
// Hàm show error
function show_error($error, $key){
    echo '<span style="color: red">'.(empty($error[$key]) ? "" : $error[$key]). '</span>';
}

// Tạo chuỗi query string
function create_link($uri, $filter = array()){
    $string = '';
    foreach ($filter as $key => $val){
        if ($val != ''){
            $string .= "&{$key}={$val}";
        }
    }
    return $uri . ($string ? '?'.ltrim($string, '&') : '');
}
