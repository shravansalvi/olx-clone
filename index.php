<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "olx_clone";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch listings from the database
$sql = "SELECT id, title, description, price FROM listings ORDER BY created_at DESC LIMIT 10";
$result = $conn->query($sql);

// Close connection after query
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OLX Clone - Home</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header>
        <h1>Welcome to OLX Clone</h1>
        <nav>
            <a href="#">Home</a> | <a href="#">Post an Ad</a> | <a href="#">Login</a>
        </nav>
    </header>

    <section class="listings">
        <h2>Latest Listings</h2>

        <?php
        if ($result->num_rows > 0) {
            // Output data for each row
            while($row = $result->fetch_assoc()) {
                echo "<div class='listing'>";
                echo "<h3>" . $row['title'] . "</h3>";
                echo "<p>" . substr($row['description'], 0, 100) . "...</p>";
                echo "<p><strong>Price: </strong>₹" . $row['price'] . "</p>";
                echo "<a href='view.php?id=" . $row['id'] . "'>View Details</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No listings available.</p>";
        }
        ?>
    </section>

    <footer>
        <p>&copy; 2024 OLX Clone</p>
    </footer>

</body>
</html>
