<?php
include "../cores/inc/config.php";
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    date_default_timezone_set('Asia/Kolkata');
    $e_id = htmlspecialchars($_SESSION["e_id"]);
    $pic=$_FILES['file1']['name'];
    $doc=$_FILES['file2']['name'];
    $pic_extension=pathinfo($pic,PATHINFO_EXTENSION);
    $doc_extension=pathinfo($doc,PATHINFO_EXTENSION);
    $valid=array('jpg','jpeg','png');
    if(in_array($pic_extension,$valid))
        $new_pic=$e_id.'.'.$pic_extension;
    if(in_array($doc_extension,$valid))
        $new_doc=$e_id.'.'.$doc_extension;
    $path_pic=$_SERVER["DOCUMENT_ROOT"]."/build/img/prof/".$new_pic; 
    $path_doc=$_SERVER["DOCUMENT_ROOT"]."/build/img/doc/".$new_doc;  
    if(move_uploaded_file($_FILES['file1']['tmp_name'],$path_pic)){
        if(move_uploaded_file($_FILES['file2']['tmp_name'],$path_doc)){
            $time=date('d-m-Y h:i:sa');
            $sql = "UPDATE `employee_basic_tbl` SET `id_link`='$new_doc',`photo_link`='$new_pic',`data_status`='Done',`photo_status`='Done',`data_timestamp`='$time' WHERE e_id=$e_id";
            if(mysqli_query($link, $sql)){
                if(mysqli_affected_rows($link)>0)
                {
                    $_SESSION["basic_status"] = 'done'; 
                    echo 1;
                }
                else 
                    echo "Cannot upload basic document and profile photo..";    
            }
            else
                echo "Error description: " . mysqli_error($link);
        }
    }
}
else
    echo "You are not allowed to access this page";
mysqli_close($link);
?>