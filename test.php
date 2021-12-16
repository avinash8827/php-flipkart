<?php 
    echo $salt = md5('letmein');
    echo '<br>';
    echo '<br>';
    echo hash('sha512',$salt.$salt.'superadmin'.$salt);
?>