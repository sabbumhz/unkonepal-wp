<?php get_header(); ?>

<?php
$showInfo = false;
if(isset($_GET['userid']) && is_numeric($_GET['userid'])){
    $user = get_user_by('id',  $_GET['userid']);
    if($user){
        if(in_array( 'knitter', (array) $user->roles)){
            $showInfo = true;
        }
    } 
}

if($showInfo == true){
    include (TEMPLATEPATH . "/knitter-details.php"); 
}else{
    include (TEMPLATEPATH . "/knitter-list.php");     
}


?>

<?php get_footer(); ?>