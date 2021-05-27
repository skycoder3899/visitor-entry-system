<?php include "../cores/inc/config.php";
 $output = '';  
 $sql = "SELECT * FROM employee_tbl e INNER JOIN employee_dept_tbl d ON e.department_id=d.department_id";  
 $result = mysqli_query($link, $sql);  
 if(mysqli_num_rows($result) > 0)  
 {
 $output .= '<script>$("#Table").DataTable({dom: "Bfrtip",buttons:["excel", "pdf"]});</script>  
           <table id="Table" class="table table-bordered table-striped">
           <thead>
                <tr>  
                  <th>Employee_Id</th>
                  <th>Department</th>
                  <th>Employee_Status</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email_Id</th>
                </tr>
            </thead><tbody>';

      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>  
                     <td> E-'.$row["e_id"].'</td> 
                      <td>'.$row["type"].'</td> 
                      <td>'.$row["e_stats"].'</td> 
                      <td>'.$row["f_name"].' '.$row["l_name"].'</td> 
                      <td>'.$row["phone"].'</td> 
                      <td>'.$row["email_id"].'</td> 
                </tr>';  
      }
    $output .= '</tbody></table>';    
 }  
 else  
 {  
      $output .= '<p><em>No records were found.</em></p>';  
 }
 echo $output;  
 ?>