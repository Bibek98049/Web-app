<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "researchs";
$con = mysqli_connect($host, $user, $pass, $db) or die("Error " . mysqli_error($con));

//check if form is submitted
if (isset($_POST['submit']))
{
    $filename = $_FILES['file1']['name'];

    //upload file
    if($filename != '')
    {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $allowed = ['pdf', 'txt', 'doc', 'docx', 'png', 'jpg', 'jpeg',  'gif'];
    
        //check if file type is valid
        if (in_array($ext, $allowed))
        {
            // get last record id
            $sql = 'select max(id) as id from research';
            $result = mysqli_query($con, $sql);
            if (mysqli_connect($result) > 0)
            {
                $row = mysqli_fetch_array($result);
                $filename = ($row['id']+1) . '-' . $filename;
            }
            else
                $filename = '1' . '-' . $filename;

            //set target directory
            $path = 'uploads/';
            $title = $_POST['title'];
            $location = $_POST['location'];
            $submitted_by = $_POST['submitted_by'];
            $lat = $_POST['lat'];
            $lon = $_POST['lon'];
            $created = @date('Y-m-d H:i:s');
            move_uploaded_file($_FILES['file1']['tmp_name'],($path . $filename));
            
            // insert file details into database
            $sql = "INSERT INTO research(title, location, filename, submitted_by, lat, lon, status) VALUES('$title', '$location', '$filename', '$submitted_by', '$lat', '$lon', '0')";
            mysqli_query($con, $sql);
            header("Location: index.php?st=success");
        }
        else
        {
            header("Location: index.php?st=error");
        }
    }
    else
        header("Location: index.php");
}
?>