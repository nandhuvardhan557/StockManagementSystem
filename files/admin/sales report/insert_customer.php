<?php

// Database connection
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'sms_db';
// Edit customer data
if (isset($_GET['id'])) {
    $customer_id = $_GET['id'];

    if (isset($_POST['submit'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone_number = $_POST['phone_number'];

        $update_query = "UPDATE customer SET FIRST_NAME='$first_name', LAST_NAME='$last_name', PHONE_NUMBER='$phone_number' WHERE CUST_ID=$customer_id";
        $db->query($update_query);

        header("Location: index.php");
        exit;
    }

    $query = "SELECT * FROM customer WHERE CUST_ID=$customer_id";
    $result = $db->query($query);
    $customer = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Customer</title>
</head>
<body>
    <h2>Edit Customer</h2>
    <form method="post" action="">
        First Name: <input type="text" name="first_name" value="<?php echo $customer['FIRST_NAME']; ?>" required><br>
        Last Name: <input type="text" name="last_name" value="<?php echo $customer['LAST_NAME']; ?>"><br>
        Phone Number: <input type="text" name="phone_number" value="<?php echo $customer['PHONE_NUMBER']; ?>"><br>
        <input type="submit" name="submit" value="Update Customer">
    </form>
</body>
</html>
