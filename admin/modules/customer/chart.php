<?php if (!defined('IN_SITE')) die ('The request not found'); ?>
<?php include_once('widgets/header.php'); ?>
<?php
    //câu lệnh SQL đếm số lượng của mỗi địa chỉ
    $sql1 = "SELECT COUNT(customers.ID) AS countAddr FROM customers WHERE customers.address LIKE 'Hà Nội' ";
    $sql2 = "SELECT COUNT(customers.ID) AS countAddr FROM customers WHERE customers.address LIKE 'Nam Định' ";
    $sql3 = "SELECT COUNT(customers.ID) AS countAddr FROM customers WHERE customers.address LIKE 'Hà Nam'; ";
    $sql4 = "SELECT COUNT(customers.ID) AS countAddr FROM customers WHERE customers.address LIKE 'Hải Phòng' ";
    $sql5 = "SELECT COUNT(customers.ID) AS countAddr FROM customers WHERE customers.address LIKE 'Nghệ An' " ;
    $sql6 = "SELECT COUNT(customers.ID) AS countAddr FROM customers WHERE customers.address LIKE 'Cà Mau' ";
    //thực thi câu lệnh SQL 
    $result1 = db_execute($sql1);
    $result2 = db_execute($sql2);
    $result3 = db_execute($sql3);
    $result4 = db_execute($sql4);
    $result5 = db_execute($sql5);
    $result6 = db_execute($sql6);
    //Lưu kết quả thành mảng
    $row1 = mysqli_fetch_array($result1);
    $row2 = mysqli_fetch_array($result2);
    $row3 = mysqli_fetch_array($result3);
    $row4 = mysqli_fetch_array($result4);
    $row5 = mysqli_fetch_array($result5);
    $row6 = mysqli_fetch_array($result6);
?>
<center>
    <h1><b>Thống kê địa chỉ khách hàng </b></h1>

    <div id="piechart"></div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
        // Load google charts
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        //Lưu kết quả của biến countAddr
        <?php 
            $addr1=$row1['countAddr'];
            $addr2=$row2['countAddr'];
            $addr3=$row3['countAddr'];
            $addr4=$row4['countAddr'];
            $addr5=$row5['countAddr'];
            $addr6=$row6['countAddr'];
        ?>
        // Draw the chart and set the chart values
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['addr', 'countAddr'],        
                ['Hà Nội',<?php echo $addr1;?>],
                ['Nam Định',<?php echo $addr2;?>],
                ['Hà Nam',<?php echo $addr3;?>],
                ['Hải Phòng',<?php echo $addr4;?>],
                ['Nghệ An',<?php echo $addr5;?>],
                ['Cà Cau',<?php echo $addr6;?>]
            ]);

        // Optional; add a title and set the width and height of the chart
        var options = {'title':'Thống kê địa chỉ khách hàng', 'width':1100, 'height':800,'is3D':true};

        // Display the chart inside the <div> element with id="piechart"
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
        }
    </script>
</center>
