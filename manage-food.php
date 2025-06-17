<?php
 include('constants.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Food</title>
    <link rel="stylesheet" href="all.css"> <!-- Link to your CSS file -->
</head>
<body>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>

        <br /><br />

        <!-- Button to Add Food -->
        <a href="<?php echo SITEURL; ?>add-food.php" class="btn-primary">Add Food</a>

        <br /><br /><br />

        <?php 
            if(isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['unauthorize'])) {
                echo $_SESSION['unauthorize'];
                unset($_SESSION['unauthorize']);
            }

            if(isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php 
                // Create a SQL Query to Get all the Food
                $sql = "SELECT * FROM tbl_food";

                // Execute the query
                $res = mysqli_query($conn, $sql);

                // Count Rows to check whether we have foods or not
                $count = mysqli_num_rows($res);

                // Create Serial Number Variable and Set Default Value as 1
                $sn = 1;

                if($count > 0) {
                    // We have food in Database
                    // Get the Foods from Database and Display
                    while($row = mysqli_fetch_assoc($res)) {
                        // Get the values from individual columns
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                        ?>

                        <tr>
                            <td><?php echo $sn++; ?>. </td>
                            <td><?php echo htmlspecialchars($title); ?></td>
                            <td>$<?php echo htmlspecialchars($price); ?></td>
                            <td>
                                <?php  
                                    // Check whether we have image or not
                                    if($image_name == "") {
                                        // We do not have image, Display Error Message
                                        echo "<div class='error'>Image not Added.</div>";
                                    } else {
                                        // We Have Image, Display Image
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/<?php echo htmlspecialchars($image_name); ?>" width="100px">
                                        <?php
                                    }
                                ?>
                            </td>
                            <td><?php echo htmlspecialchars($featured); ?></td>
                            <td><?php echo htmlspecialchars($active); ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a><br><br><br>
                                <a href="<?php echo SITEURL; ?>delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                            </td>
                        </tr>

                        <?php
                    }
                } else {
                    // Food not Added in Database
                    echo "<tr> <td colspan='7' class='error'> Food not Added Yet. </td> </tr>";
                }
            ?>
        </table>
    </div>
</div>

<?php include('footer.php'); ?>
</body>
</html>
