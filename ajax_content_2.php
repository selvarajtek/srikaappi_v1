<?php
 
    $output='ss';
    $message='';
    $total= 0;
    $billno=1;
    $itemsname=array(); 
    $itemsQuantity=array();
    $itemsAmount=array();
    $itemsFrom=array();

    if(isset($_POST['itemsname']) && isset($_POST['itemsQuantity']) && isset($_POST['itemsAmount']) && isset($_POST['itemsFrom'])){
            
        $itemsname=$_POST['itemsname'];
        $itemsQuantity=$_POST['itemsQuantity'];
        $itemsAmount=$_POST['itemsAmount'];
        $itemsFrom=$_POST['itemsFrom'];
        // print_r($itemsname);
        // print_r($itemsQuantity);
        // print_r($itemsFrom);
        
        $con=mysqli_connect('34.93.221.231','root','root123','srikaappi');
        if(!$con){
            die("Connection error ".mysqli_connect_error());
        }

        $sql = "SELECT billnumber FROM sri_recepit_1 ORDER BY billnumber DESC LIMIT 1";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {

            while($row = mysqli_fetch_assoc($result)) {
                $billno=$row["billnumber"];
                $billno++;
            }
            
        }else{
            $billno=1;
        }
        $date = date('Y-m-d H:i:s');
        for($i=0;$i<count($itemsAmount);$i++){
            
            // $sql="SELECT * from beverages where items='$itemsname[$i]' and itemsFrom='$itemsFrom[$i]'";

            $sql="Insert into sale_items_1 (billno,items,quantity,amount,itemsfrom,billdate,buyquantity,sellquantity) values('$billno','$itemsname[$i]','$itemsQuantity[$i]','$itemsAmount[$i]','$itemsFrom[$i]','$date',0,0)";

            $result = mysqli_query($con, $sql);
  
            $updatefor=$itemsFrom[$i];
            $sellquantity=0;

            if($updatefor=='beverages'){

               
                $sql="SELECT sellquantity FROM beverages_1 where itemsname='$itemsname[$i]' ";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $sellquantity=$row["sellquantity"];
                    }
                }
                $sellquantity=$sellquantity+$itemsQuantity[$i];
                
                $sql ="UPDATE beverages_1 SET sellquantity=$sellquantity WHERE itemsname='$itemsname[$i]'";
                $result=mysqli_query($con,$sql);
            }
            else if($updatefor=='nonbeverages'){
                $sql="SELECT sellquantity FROM nonbeverages_1 where itemsname='$itemsname[$i]' ";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $sellquantity=$row["sellquantity"];
                    }
                }
                $sellquantity=$sellquantity+$itemsQuantity[$i];
                
                $sql ="UPDATE nonbeverages_1 SET sellquantity=$sellquantity WHERE itemsname='$itemsname[$i]'";
                $result=mysqli_query($con,$sql);
            }
            else if($updatefor=='bites'){
                $sql="SELECT sellquantity FROM bites_1 where itemsname='$itemsname[$i]' ";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $sellquantity=$row["sellquantity"];
                    }
                }
                $sellquantity=$sellquantity+$itemsQuantity[$i];
                
                $sql ="UPDATE bites_1 SET sellquantity=$sellquantity WHERE itemsname='$itemsname[$i]'";
                $result=mysqli_query($con,$sql);
            }
            else if($updatefor=='juices'){
                $sql="SELECT sellquantity FROM juices_1 where itemsname='$itemsname[$i]' ";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $sellquantity=$row["sellquantity"];
                    }
                }
                $sellquantity=$sellquantity+$itemsQuantity[$i];
                
                $sql ="UPDATE juices_1 SET sellquantity=$sellquantity WHERE itemsname='$itemsname[$i]'";
                $result=mysqli_query($con,$sql);
            }
            else if($updatefor=='parcel'){
                $sql="SELECT sellquantity FROM parcel_1 where itemsname='$itemsname[$i]' ";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $sellquantity=$row["sellquantity"];
                    }
                }
                $sellquantity=$sellquantity+$itemsQuantity[$i];
                
                $sql ="UPDATE parcel_1 SET sellquantity=$sellquantity WHERE itemsname='$itemsname[$i]'";
                $result=mysqli_query($con,$sql);
            }
        }
        
        for($i=0;$i<count($itemsAmount);$i++){
            $total=$total+$itemsAmount[$i];
        }
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d H:i:s');
        $time="".date("h:i a");

        $sql="Insert into sri_recepit_1 (billnumber,date,time,totalamount) values('$billno','$date','$time','$total')";
        $result = mysqli_query($con,$sql);
        
        // print_r($result);
        
    }else{

    }
    
        $data["output"]=$output;
        $data["total"]=$total;

    echo json_encode($data);       
  ?>