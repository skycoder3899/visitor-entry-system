<?php include "../cores/inc/config.php";
 $output = '';  
 $sql = "SELECT * FROM `visitor_tbl` v INNER JOIN employee_dept_tbl d ON v.host_department_id=d.department_id INNER JOIN employee_tbl e on v.host_id=e.e_id";  
 $result = mysqli_query($link, $sql);  
 if(mysqli_num_rows($result) > 0)  
 {
 $output .= '<script>$("#Table2").DataTable({dom: "Bfrtip",buttons:["excel", "pdf"]});</script><div style="overflow-x:auto;"> 
           <table id="Table2" class="table table-bordered table-striped">
           <thead>
                <tr>  
                  <th>Visitor Id</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email Id</th>
                  <th>Purpose</th>
                  <th>Host Name</th>
                  <th>Host Department</th>
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
                    <td><a href="mailto:'.$row["vemail_id"].'">'.$row["vemail_id"].'</td>
                    <td>'.$row["purpose"].'</td> 
                    <td>'.$row["type"].'</td> 
                    <td>'.$row["f_name"].' '.$row["l_name"].'</td>
                    <td>'.$row["check_in_time"].'</td>
                    <td>'.$row["check_out_time"].'</td> 
                    <td>'.$row["date"].'</td>
                </tr>';  
      }
    $output .= '</tbody></table></div>';    
 }  
 else  
 {  
      $output .= '<p><em>No records were found.</em></p>';  
 }
 echo $output;  
 ?>