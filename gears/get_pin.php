<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $pin_code = htmlspecialchars($_POST['pin']);
    $data = file_get_contents("https://api.postalpincode.in/pincode/".$pin_code);
    $data=json_decode($data);
    $return_arr = array();
    if(isset($data[0]->PostOffice['0'])){
        $city= $data[0]->PostOffice['0']->District;
        $State = $data[0]->PostOffice['0']->State;
        $Country= $data[0]->PostOffice['0']->Country;
         $return_arr[] = array("city" => $city,
                    "State" => $State,
                    "Country" => $Country);
        echo json_encode($return_arr);
    }
    else
        echo "no";   
}
else
    echo "You are not allowed to access this page";
?>