<?php 
$fp = fopen("test.txt", "r");
date_default_timezone_set('Asia/Ho_Chi_Minh');


function first_two_letters($str){
    $result = substr($str, 0, 2);
    $rest = substr($str, 2, 5);
    return strtoupper($result).$rest;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        table,tr,td{
            border-collapse: collapse;
            text-align: center;
        }
    </style>
    <table border="1"cellpadding="5">
        <thead>
            <td>STT</td>
            <td>Mã sinh viên</td>
            <td>Họ và tên</td>
            <td>Ngày sinh</td>
            <td>Năm sinh</td>
            <td>Tổng số buổi học</td>
            <td>Tỉ lệ tham gia</td>
        </thead>
        <tbody>
        <?php 
           $stt=1;
        while(! feof($fp))
     
        {
         $strUserInformation  =  fgets($fp);
        $arrUserInformation = explode("/", $strUserInformation );
        $date=$arrUserInformation[2];

        $num=(double)$arrUserInformation[3]/17 ;
        $percent=ceil($num*100).'%';
        list($day,$month,$year)=explode('-',$date);
        $day_month=$day.'-'.$month;
        ?>
        <tr>
            <td><?php  echo $stt++;?></td>
        <td><?php echo  first_two_letters($arrUserInformation[0]) ;?></td>
        <td><?php echo  mb_convert_case($arrUserInformation[1],MB_CASE_TITLE, "UTF-8")?></td>
        <td><?php echo  $day_month;?></td>
        <td><?php echo  $year;?></td>
        <td><?php echo  $arrUserInformation[3] ;?></td>
        <td><?php echo  $percent;?></td>
        </tr>
        <?php } ?> 
        </tbody>
         </table>    
    <p>Thời gian cập nhập: <?php echo date("Y-m-d");?> <?php  $timestamp =  date('h:i:s');
   echo $timestamp;?> </p>
        
</body>
</html>