<?php include "../cores/inc/config.php";
session_start();
$e_id= $_SESSION['e_id'];
 $output = '';  
 $sql = "SELECT * FROM `visitor_tbl` v INNER JOIN employee_dept_tbl d ON v.host_department_id=d.department_id INNER JOIN employee_tbl e on v.host_id=e.e_id WHERE e.e_id=$e_id AND DATE(v.date)=CURDATE()";  
 $result = mysqli_query($link, $sql);  
 $sql = "SELECT * FROM `visitor_tbl` v INNER JOIN employee_dept_tbl d ON v.host_department_id=d.department_id INNER JOIN employee_tbl e on v.host_id=e.e_id WHERE e.e_id=$e_id AND DATE(v.date)!=CURDATE()";  
 $result1 = mysqli_query($link, $sql);  
 if(mysqli_num_rows($result) > 0 || mysqli_num_rows($result1) > 0)  
 {
 $output .= '<script>$("#Table").DataTable({dom: "Bfrtip",buttons:["excel", "pdf"]});</script>  
           <table id="Table" class="table table-bordered table-striped">
           <thead>
                <tr>  
                  <th>Visitor Id</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email Id</th>
                  <th>Purpose</th>
                  <th>In time</th>
                  <th>Out time</th>
                  <th>Date</th>                  
                </tr>
            </thead><tbody>';

      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>  
                    <td> V-'.$row["v_id"].'</td> 
                    <td>'.$row["vf_name"].' '.$row["vl_name"].'</td>
                    <td><a href="https://wa.me/+91'.$row['vphone'].'">'.$row["vphone"].'</td> 
                    <td><a href="mailto:'.$row['vemail_id'].'">'.$row["vemail_id"].'</a></td>
                    <td>'.$row["purpose"].'</td> 
                    <td>'.$row["check_in_time"].'</td>
                    <td>'.$row["check_out_time"].'</td> 
                    <td>'.$row["date"].'</td>
                </tr>';  
      }
      while($row = mysqli_fetch_array($result1))  
      {  
           $output .= '  
                <tr>  
                    <td> V-'.$row["v_id"].'</td> 
                    <td>'.$row["vf_name"].' '.$row["vl_name"].'</td>
                    <td><a href="https://wa.me/+91'.$row['vphone'].'">'.$row["vphone"].'</td> 
                    <td><a href="mailto:'.$row['vemail_id'].'">'.$row["vemail_id"].'</a></td>
                    <td>'.$row["purpose"].'</td> 
                    <td>'.$row["check_in_time"].'</td>
                    <td>'.$row["check_out_time"].'</td> 
                    <td style="color:#FF0000">'.$row["date"].'</td>
                </tr>';  
      }
    $output .= '</tbody></table>';    
 }  
 else  
 {  
      $output .= '<p><em>No visitors records found.</em></p>';  
 }
 echo $output;  
 ?>