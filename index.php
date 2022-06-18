<?php
require_once 'vendor/autoload.php';
include 'database.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>ReUSE</title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="card my-3">
                <div class="card-header">
                    Seed Database
                </div>
                <div class="card-body">

                    <form action="index.php" method="post">
                        <button type="submit" name="submit" class="btn btn-primary btn-sm mb-3">Run Seed</button>
                    </form>

                    <?php
                    $faker = Faker\Factory::create();

                    if(isset($_POST['submit'])) {
                        //echo date('Y-m-d H:i:s', strtotime($faker->iso8601));
                        //echo $studentName . ' - ' . $studentAddress . ' - ' . $studentClass . ' - ' . $studentPhone;

                        for($i = 0; $i < 2; $i++) {
                            $studentName = $faker->firstNameMale . ' ' . $faker->lastName;
                            $studentAddress = $faker->streetAddress;
                            $studentClass = $faker->randomNumber();
                            $studentPhone = $faker->phoneNumber;

                            $sql1 = "INSERT INTO `student` (`student_name`, `student_address`, `student_class`, `student_phone`)
                                    VALUES ('$studentName', '$studentAddress', $studentClass, '$studentPhone');";

                            $result1 = mysqli_query($connect, $sql1) or die('Query Error: '.mysqli_error($sql1));

                            if(!$result1) {
                                echo "<p>Query [$sql1] couldn't be executed </p>";
                            }
                        }
                    }
                    ?>

                    <?php
                    $sql2 = "SELECT * FROM student ORDER BY student_id DESC";

                    $result2 = mysqli_query($connect, $sql2) or die('Query Error: '.mysqli_error($sql2));
                    ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-0">
                            <thead>
                            <tr class="bg-light">
                                <th scope="col">Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Class</th>
                                <th scope="col">Phone</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(mysqli_num_rows($result2) > 0) {
                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row2['student_name']; ?></td>
                                        <td><?php echo $row2['student_address']; ?></td>
                                        <td><?php echo $row2['student_class']; ?></td>
                                        <td><?php echo $row2['student_phone']; ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>