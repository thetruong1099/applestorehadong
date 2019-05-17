<?php if (!defined('IN_SITE')) die ('The request not found'); ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
    <script src="http://code.jquery.com/jquery-1.9.0.js"></script>
    <title>Quản lý admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        body,h1,h2,h3,h4,h5,h6 {font-family: "Karma", sans-serif}
        .w3-bar-block .w3-bar-item {padding:20px}
        #greeting{
            float: right;
            width: 250px;
            line-height: 50px;
        }
        #content{
            margin-right: 50px;
            border-top: solid 1px #ddd;
            min-height: 600px;
            padding: 10px 30px;
        }
   /*     .form input.long[type="text"]{
            width: 400px;
        }*/
    </style>
    <script>
      function w3_open() {
        document.getElementById("main").style.marginLeft = "20%";
        document.getElementById("mySidebar").style.width = "20%";
        document.getElementById("mySidebar").style.display = "block";
        document.getElementById("openNav").style.display = 'none';
      }
      function w3_close() {
        document.getElementById("main").style.marginLeft = "0%";
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("openNav").style.display = "inline-block";
      }
    </script>
</head>
<!-- tạo đường link -->
<body>
    <!-- sidebar -->
    <div class="w3-sidebar w3-bar-block w3-card w3-animate-left w3-black" style="display:none" id="mySidebar">
        <button class="w3-bar-item w3-button w3-padding-32 w3-black"
        onclick="w3_close()">Đóng lại</button>
        <a href="<?php echo base_url('admin/?m=common&a=dashboard'); ?>" class="w3-bar-item w3-button w3-black">Trang chủ</a>
        <a href="<?php echo base_url('admin/?m=user&a=list');?>" class="w3-bar-item w3-button w3-black">Người dùng</a>
        <a href="<?php echo base_url('admin/?m=customer&a=list');?>" class="w3-bar-item w3-button w3-black">Khách hàng</a>
        
        <div class="w3-dropdown-hover">
            <button class="w3-button w3-black">Thống kê khách hàng
              <i class="fa fa-caret-down"></i>
            </button>
          <div class="w3-dropdown-content w3-bar-block w3-black">
              <a href="<?php echo base_url('admin/?m=customer&a=birthlist');?>" class="w3-bar-item w3-button">Sinh nhật</a>
              <a href="<?php echo base_url('admin/?m=customer&a=most_order_list');?>" class="w3-bar-item w3-button">Mua nhiều nhất</a>
              <a href="<?php echo base_url('admin/?m=customer&a=chart');?>" class="w3-bar-item w3-button">Thống kê khách hàng theo địa chỉ</a>
          </div>
        </div> 
    </div>

    <div id="main">
    <!-- header -->
      <div class="w3-container w3-teal">
        <?php if (is_admin()){ ?>
          <div id="openNav" class="w3-left w3-button w3-padding-32 w3-teal" onclick="w3_open()"> &#9776; </div>
        <?php } ?>
        <div class="w3-center"><h1>Apple Store Hà Đông</h1></div>
        <div class ="w3-right">Cung cấp các sản phẩm iPhone chính hãng</div>
      </div>  

      <!-- greeting -->
      <div id="greeting">
          Xin chào <?php echo get_current_username(); ?> |
          <a href="<?php echo base_url('admin/?m=common&a=logout'); ?>">Đăng xuất</a>
      </div>
        
      <div id="content">