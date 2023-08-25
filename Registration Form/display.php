<?php
include('./connect.php');
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $mobile = $_POST['mobile'];
    $image = $_FILES['file'];

    $imagefilename = $image['name'];
    //print_r($imagefilename);

    $imagefileerror = $image['error'];
    //print_r($imagefileerror);

    $imagefiletmp = $image['tmp_name'];
    //print_r($imagefiletmp);


    $filename_separate = explode('.', $imagefilename);
    //print_r($filename_separate);

    $file_extension = strtolower($filename_separate[1]);
    // print_r($file_extension);
    // $file_extension = strtolower(end($filename_separate));
    //print_r($file_extension);

    $extension = array('jpeg', 'jpg', 'png');
    if (in_array($file_extension, $extension)) {
        $upload_image = 'images/' . $imagefilename;
        move_uploaded_file($imagefiletmp, $upload_image);

        $sql = "insert into image (name,mobile,image) values('$username','$mobile','$upload_image') ";
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo '<div class="alert alert-success" role="alert">
            <strong>success</strong>Data inserted successfully
          </div>';
        } else {
            die(mysqli_error($con));
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        img{
            width:100px;
        }
    </style>
</head>

<body>
    <h1 class="text-center my-4">User data</h1>
    <div class="container mt-5 d-flex justify-content-center">
        <table class="table table-bordered w-50">
            <thead class="table-dark">
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "Select * from image";
                $result = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $image = $row['image'];
                    echo '<tr>
                    <th scope="row">' . $id . '</th>
                    <td>' . $name . '</td>
                    <td><img src= '.$image.'/></td>
                    </tr>';
                }

                ?>


            </tbody>

        </table>
    </div>


</body>

</html>