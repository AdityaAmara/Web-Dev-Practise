<?php 

    require 'db_conn.php'; //include 'db_conn.php';
    /*
    //select or delete
    $sql = "SELECT * FROM test;";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result))
    {

    }

    */

    /*

    //Insert or Update

    $sql = "UPDATE test SET stuname=? WHERE ID=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        echo '<script> alert("SQL ERROR") </script>';
        exit();
    } 
    else {
        mysqli_stmt_bind_param($stmt, "ss", $var);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn); 
    }*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DB Basics</title>
</head>
<body>
    <form action="" method="GET">
        <br>
        <label for="name">Enter Name</label>
        <input type="text" name="stu_name" placeholder="Enter Name" id="name">
        <br>
        <br>
        <label for="tele">Enter Name</label>
        <input type="tel" name="stu_phone" placeholder="Enter Phone" id="tele">
        <br>
        <br>
        <select name="gender">
            <option value="M">Male</option>
            <option value="F">Female</option>
        </select>
        <br>
        <br>
        <select name="course">
            <?php 
            $sql = "SELECT * FROM enrolled_course";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result))
            {
                echo '<option value="'.$row['CourseID'].'">'.$row['CourseName'].'</option>'; // " '.$variable.' "
            }
            ?>
        </select>
        <br>
        <br>
        <input type="submit" name="ADD_btn" value="submit">

    </form>    

    <?php 

        if(isset($_GET['ADD_btn'])) 
        {
        $stu_name = $_GET['stu_name'];
        $stu_phone = $_GET['stu_phone'];
        $stu_gender = $_GET['gender'];
        $stu_course = $_GET['course'];
        
        $sql = "INSERT INTO student(Stu_Name,Stu_Phone,Stu_Gender,Course_Enrolled) VALUES(?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql))
        {
            echo '<script> alert("SQL INSERT ERROR") </script>';
            exit();
        } 
        else {
            mysqli_stmt_bind_param($stmt, "sisi", $stu_name, $stu_phone, $stu_gender, $stu_course);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }

        echo "<br><br>Result:<br>".$stu_name." - ".$stu_phone." - ".$stu_gender." - ".$stu_course;
        }
        
    ?>

</body>
</html>