
<?php

require_once "dbConfig.php";

    $output='success';

    if(isset($_POST['updatebuy'])){
            
        $updatebuy=$_POST['updatebuy'];
        $updateid=$_POST['updateid']+1;
        // print_r($updatebuy);

        if(!$con){
            die("Connection error ".mysqli_connect_error());
        }

        $sql ="UPDATE bites SET buyquantity=$updatebuy WHERE id=$updateid";
        $result=mysqli_query($con,$sql);
        
        if($result){
            $output='success';
        }
    }else{
        $output='faliure';
    }

    echo $output;       
  ?>