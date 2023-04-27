<?php
if(isset($_POST['search']) && isset($_POST['area'])) {
    
    $search_param = $_POST['search'];
    $search_area = $_POST['area'];

  if(empty($search_area) || empty($search_param)) {
        $data = '<b><center>Please fill the details in the input box</center><b/>';
         echo $data;
        exit;
    }
  /* if(empty($search_area) || empty($search_param)) {
        $data["result"] = "False";
        $data["Message"] = "Invalid search parameters";
        echo json_encode($data, JSON_UNESCAPED_SLASHES);
        exit;
    }

    if(!is_string($search_area)) {
        $data["result"] = "False";
        $data["Message"] = "Invalid search area format";
        echo json_encode($data, JSON_UNESCAPED_SLASHES);
        exit;
    }


    if(!is_string($search_param)) {
        $data["result"] = "False";
        $data["Message"] = "Invalid search parameter format";
        echo json_encode($data, JSON_UNESCAPED_SLASHES);
        exit;
    }

*/
    $servername = "localhost"; //replace with your server name
    $username = "id20628670_doctorsearch466_"; //replace with your MySQL username
    $password = "P(HKec=b)9}pJ<0H"; //replace with your MySQL password
    $dbname = "id20628670_doctorsearch34"; //replace with the name of your database
    
    
$conn = new mysqli($servername, $username, $password, $dbname);
    
//$sql = "SELECT * FROM 'doctor' WHERE DoctorLocation LIKE '%".$search_area."%' AND DoctorInformation LIKE '%".$search_param."%'";

$sql = "SELECT * FROM doctor WHERE DoctorLocation = '".$search_area."' OR DoctorInformation = '".$search_param."'";


$result = $conn->query($sql);

    if($result->num_rows > 0)
    {       $data = '<b><center>We found the following doctor in your area</center></b>';
       // $data = '<b class="serviceheading2">We found the following doctor in your area</b>';
        $doctor_data = "";
        while($row = $result->fetch_assoc()){
        $doctorid = $row["ID"];
        $doctorname = $row["DoctorName"];
        $doctorimage = $row["DoctorImage"];
        $doctorinfo = $row["DoctorInformation"];
        $contact = $row["contactNo"];
          
      /*$doctor_data = $doctor_data . "
      <div style='display: flex; align-items: center;'>
          <img class='dctext1-icon' alt='' style='padding: 30px; margin: 20px 0px 0px 10px;position: relative' src='{$doctorimage}' />
          <div style='font-size: 14px;'>
            <p style='display: inline-block; margin-right: 10px;'>Doctor Name:{$doctorname}</p><br/>
            <p style='display: inline-block; margin-right: 10px;'>Detail:{$doctorinfo}</p><br/>
            <p style='display: inline-block;'>Contact No.:{$contact}</p>
          </div>
        </div>
        
        "; */
      
      $doctor_data = $doctor_data . "<div style='display:inline-block; align-items: center;'>
      <div style='align-items: center;'>
          <img class='dctext1-icon' alt='' style='padding: 30px; margin: 20px 0px 0px 10px;position: relative' src='{$doctorimage}' />    </div>
          <div style='font-size: 14px;padding: 0px 32px 3px 45px;'>
            <p>Doctor Name:{$doctorname}</p>
            <p>Detail:{$doctorinfo}</p>
            <p>Contact No.:{$contact}</p>
          </div>
    
        </div>
        ";

                
       } 
    }
    else {
     $data = '<b><center>No doctor found in your area<center/></b>';
    $doctor_data="";
    }

} else {

    $data = '<b><center>Bad Query</center></b>';
    $doctor_data="";
}
$data = $data.$doctor_data;
echo $data;

?>
