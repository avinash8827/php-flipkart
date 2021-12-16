<?php
    //1. Db Connection Open
    require './inc/functions.php';
    
    //Always filter/Sanitize the incomming data
    if( isset($_REQUEST['action']) ){

        $action = filterData($_REQUEST['action']);

        //Login Block
        if($action == 'login'){
            //var_dump($_REQUEST);
            
            //Always filter/Sanitize the incomming data
            $email = filterData($_REQUEST['email']);
            $password = filterData($_REQUEST['password']);

            //check if the email is available if availbe then get the salt
            
            //2. Build the query
            $sql = "SELECT * FROM users_tbl WHERE email='$email'";

            //3. Execute the query
            $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

            $nor = mysqli_num_rows($result); //nor = number of rows
            if($nor == 1){
                 // Email is available or valid credentials 
                 //OK
               // $row = mysqli_fetch_row($result);
                $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

               // var_dump($row['salt']); // key=value
                $salt = $row['salt']; // key=value

                $password_hash = hash('sha512',$salt.$salt.$password.$salt);

                //2. Build the query
                $sql = "SELECT * FROM users_tbl WHERE password='$password_hash'";

                //3. Execute the query
                $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

                //nor
                $nor = mysqli_num_rows($result);

                if($nor == 1){
                    //OK
                    $resonse = array(
                        'status'=>200,
                        'status_code'=>"success", //unauthorized
                        'msg'=>'Welcome'
                    );
                    echo json_encode($resonse); //creating JSON string

                }else{
                    //NOT OK
                    // Email is not available or invalid credentials
                    //Not OK
                    $resonse = array(
                        'status'=>403, //unauthorized
                        'status_code'=>"error", //unauthorized
                        'msg'=>'Unauthorized'
                    );
                    echo json_encode($resonse); //creating JSON string
                }
                
            }else{
                // Email is not available or invalid credentials
                //Not OK
                $resonse = array(
                    'status'=>403, //unauthorized
                    'msg'=>'Unauthorized'
                );
                echo json_encode($resonse); //creating JSON string
            }
            
        }
        //Registration Block
        if($action == 'register'){

        }
    }
    

?>