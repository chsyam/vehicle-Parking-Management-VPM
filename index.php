<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Information</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
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
    $con = mysqli_connect('sql200.epizy.com','epiz_31122228','Syam190543','epiz_31122228_parking_data');
    if(isset($_REQUST['owner_name']))
    {
        $owner_name = $_REQUEST['owner_name'];
        $vehicle_name = $_REQUEST['vehicle_name'];
        $number_plate = $_REQUEST['number_plate'];
        $entry_time = $_REQUEST['entry_time'];
        $exit_time = $_REQUEST['exit_time'];
        $query = "insert into parking_info(name,vehicle_name,number_plate,entryTime,exitTime) values('$owner_name','$vehicle_name','$number_plate','$entry_time','$exit_time')";
        $res = mysqli_query($con,$query);
        // echo $query;
    }
    ?>
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
            </tr>
            <?php 
            $res1 = "select * from parking_info order by id desc";
            $res2 = mysqli_query($con,$res1);
            $counter = 0;
            while($row = mysqli_fetch_array($res2)){
                $counter+=1;
                ?>
            <tr>
                <td><?php echo $counter;?></td>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['vehicle_name'];?></td>
                <td><?php echo $row['number_plate'];?></td>
                <td><?php echo $row['entryTime'];?></td>
                <td><?php echo $row['exitTime'];?></td>
                <td>
                <?php 
                    $current_day = date("d");
                    $current_month = date("m");
                    $current_year = date("Y");
                    $entry_day = substr($row['entryTime'],8);
                    $exit_day = substr($row['exitTime'],8);
                    $exit_month = substr($row['exitTime'],5,2);
                    $exit_year = substr($row['exitTime'],0,4);
                    if($exit_year<=$current_year)
                    {
                        if($exit_month<=$current_month)
                        {
                            if($current_day <= $exit_day)
                            {
                                echo "Still in Parking Area";
                            }
                            else
                            {
                                echo "Exited";
                            }
                        }
                        else
                        {
                            echo "Still in Parking Area";
                        }
                    }
                    else{
                        echo "Still in Parking Area";
                    }
                   ?>
                </td>
            </tr>
        <?php } ?>
        </table>
    </div>
</body>

</html>
