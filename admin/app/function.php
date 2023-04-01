<?php 
function path($location){
    echo "<script>
    window.location.replace('/odc/$location')
    </script>";
}
/*====================================================================*/
/*============================ validation ============================*/
/*====================================================================*/

/************************any string*****************************/
function stringValidation($inputvalue){
    /****** delete space ****/
    $inputvalue = trim($inputvalue);
    /****** delete html tags*******/
    $inputvalue= strip_tags($inputvalue);
    /*********  change html spacial chracter **********/
    $inputvalue = htmlspecialchars($inputvalue);
    /*************delete // ****************/
    $inputvalue = stripslashes($inputvalue);
    return $inputvalue;
}
/***************************image****************************/
function imagevalidation($imagesize ,$imagename ,$limtsize){
    $size = ($imagesize /1024) /1024;
    $isbigger = $size > $limtsize;
    $empty = empty($imagename);
    if( $isbigger || $empty){
        return true;
    }else{
        return false;
    }
}

/*====================================================================*/
/*============================autiontcation ============================*/
/*====================================================================*/
function auth($rule2 = null, $rule3 = null)
{
    if (isset($_SESSION['Rania'])) {
        if ($_SESSION['Rania']['rule'] == 1 || $_SESSION['Rania']['rule'] == $rule2 || $_SESSION['Rania']['rule'] == $rule3) {
        } else {
            path("403.php");
        }
    } else {
        path("admin/pages-login.php");
    }
}
?>
