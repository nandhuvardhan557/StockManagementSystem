<!DOCTYPE html>
<html>
<head>
    <title>Customer Management</title>
</head>
<body>
    <h1>Customer Management</h1>

    <?php
    // Database connection configuration
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sms_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Add a new customer
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];

    $sql = "INSERT INTO customer (FIRST_NAME, LAST_NAME, PHONE_NUMBER) VALUES ('$first_name', '$last_name', '$phone_number')";
    if ($conn->query($sql) === TRUE) {
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

   

    <!-- Customer Form -->
    <h2>Add New Customer</h2>
    <form method="post">
        First Name: <input type="text" name="first_name" required><br>
        Last Name: <input type="text" name="last_name"><br>
        Phone Number: <input type="text" name="phone_number"><br>
        <input type="submit" name="submit" value="Add Customer">
    </form>

    <!-- List of Customers -->
    <h2>List of Customers</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone Number</th>
        </tr>
        <?php
        $sql = "SELECT * FROM customer";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["CUST_ID"] . "</td>";
                echo "<td>" . $row["FIRST_NAME"] . "</td>";
                echo "<td>" . $row["LAST_NAME"] . "</td>";
                echo "<td>" . $row["PHONE_NUMBER"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "No customers in the database.";
        }
        ?>
    </table>

    <?php
    $conn->close();
    ?>

</body>
</html>
