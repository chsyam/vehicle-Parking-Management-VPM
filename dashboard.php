<?php include "conn.php";
include "session.php";
$oemail = $_SESSION['uemail'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Information</title>
    <link rel="stylesheet" href="style.css">
    <style>
        td label {
            text-decoration: underline;
            cursor: pointer;
        }

        .menu {
            text-align: right;
        }

        .menu li {
            text-align: right;
            display: inline-block;
        }

        .menu button {
            cursor: pointer;
            background-color: white;
            color: red;
            padding: 10px;
            font-size: 17px;
            margin: 10px 50px;
            border: 1px solid red;
        }

        .menu button:hover {
            background-color: red;
            color: white;
            transition: 0.5s all ease;
        }

        .menu a {
            text-decoration: none;
            border: 1px solid black;
            font-size: 17px;
            padding: 10px;
            background-color: gray;
            color: white;
        }

        .menu a:hover {
            background-color: black;
            color: white;
            border: 1px soli green;
            transition: 0.5s all ease;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="menu">
            <ul>
                <li>
                    <a href="records.php">All Records</a>
                </li>
                <li>
                    <button onclick="logout()">Logout</button>
                </li>
            </ul>
        </div>
    </div>
    <div class="form">
        <form action="" method="post">
            <div>
                <p>Enter Vehicle details Below....</p>
            </div>
            <input type="text" name="owner_name" placeholder="Owner Name" required><br>
            <input type="text" name="vehicle_name" placeholder="Vehicle Name" required><br>
            <input type="text" name="number_plate" placeholder="Number Plate" required><br>
            <label for="entry_time">Vehicle Entry Time</label><br>
            <input type="date" name="entry_time" id="entry_time" required><br>
            <label for="exit_time">Vehicle Exit Time (Approximate)</label><br>
            <input type="date" name="exit_time" id="exit_time" required><br>
            <button class="submit" type="submit">Save</button>
            <button class="reset" type="reset">Reset</button>
        </form>
    </div>
    <hr>
    <p>All details in Record Book Listed Here...</p>
    <?php
    if (isset($_REQUEST['owner_name'])) {
        $owner_name = $_REQUEST['owner_name'];
        $vehicle_name = $_REQUEST['vehicle_name'];
        $number_plate = $_REQUEST['number_plate'];
        $entry_time = $_REQUEST['entry_time'];
        $exit_time = $_REQUEST['exit_time'];
        $query = "insert into parking_info(owner_email,name,vehicle_name,number_plate,entryTime,exitTime) values('$oemail','$owner_name','$vehicle_name','$number_plate','$entry_time','$exit_time')";
        $res = mysqli_query($con, $query);
    }
    ?>
    <input type="checkbox" name="" id="print">
    <div class="table">
        <table>
            <tr>
                <th>Serial Number</th>
                <th>Owner Name</th>
                <th>Vehicle Name</th>
                <th>Number Plate</th>
                <th>Entry Time</th>
                <th>Exit Time</th>
                <th>Status</th>
                <th>Reciept</th>
            </tr>
            <?php
            $res1 = "select * from parking_info where owner_email='$oemail' order by id desc";
            $res2 = mysqli_query($con, $res1);
            $counter = 0;
            while ($row = mysqli_fetch_array($res2)) {
                $counter += 1;
            ?>
                <tr>
                    <td><?php echo $counter; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['vehicle_name']; ?></td>
                    <td><?php echo $row['number_plate']; ?></td>
                    <td><?php echo $row['entryTime']; ?></td>
                    <td><?php echo $row['exitTime']; ?></td>
                    <td>
                        <?php
                        $current_day = date("d");
                        $current_month = date("m");
                        $current_year = date("Y");
                        $entry_day = substr($row['entryTime'], 8);
                        $exit_day = substr($row['exitTime'], 8);
                        $exit_month = substr($row['exitTime'], 5, 2);
                        $exit_year = substr($row['exitTime'], 0, 4);
                        if ($exit_year <= $current_year) {
                            if ($exit_month <= $current_month) {
                                if ($current_day <= $exit_day) {
                                    echo "Still in Parking Area";
                                } else {
                                    echo "Exited";
                                }
                            } else {
                                echo "Still in Parking Area";
                            }
                        } else {
                            echo "Still in Parking Area";
                        }
                        ?>
                    </td>
                    <td><label for="print">Print</label></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
<script>
    function logout() {
        window.location.replace("logout.php");
    }
</script>

</html>