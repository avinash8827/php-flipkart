
<?php 
    //1. DB COnnection OPEN
    //Global Variable
    $conn = mysqli_connect('localhost','root','','flipkart_db');

    // 
    //Function defination
    function filterData($data){
        global $conn;
        return mysqli_real_escape_string($conn,$data);
    }

    //Functiond defination
    function base_url($x=''){ //Default Argument
        if($x != ''){
            //Find if it contain .php
            //$x = 'admin-ajax.php'
            if(strpos($x,'admin-ajax.php')!==false){
                $x = rtrim($x,'/');
            }else{
                $x = rtrim($x,'/').'/';
            }
            
        }
        return sprintf("%s://%s%s",isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',$_SERVER['SERVER_NAME'],$_SERVER['REQUEST_URI']).$x;
    }
    

    function getSetting($key){ //$key is actual argument
        global $conn;
        //2. Build the query
        //Local Variable
        $sql = "SELECT * FROM settings_tbl WHERE meta_key='$key'";

        //3. Execute the query
        $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

       $nor = mysqli_num_rows($result);
       if($nor > 0){
            $row = mysqli_fetch_row($result);
            return $row[2];
            //associative array = assoc
       }

        //return 'OKOKKOKOK';
    }



    //5. DB COnnection CLose
    //mysqli_close($conn);

?>