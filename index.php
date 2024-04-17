<?php

include "connect.php";
include "functions.php";

$search = null;
$query = null;

if (isset($_GET['search']) && strlen($_GET['search']) > 0) {
    $search = sanitizeInput($_GET['search']);

    $query = "SELECT * FROM lenders WHERE first_name LIKE '%$search%' OR middle_name LIKE '%$search%' OR last_name LIKE '%$search%'";
} else {
    $query = "SELECT * FROM lenders";
}

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    <a href="add.php">Add Lender</a>
    <a href="transact.php">Transaction Module</a>
    <!-- Read -->
    <h1>Lease Management System</h1>
    <form action="index.php" method="get">
        <input type="text" name="search" id="search" value="<?= $search ?>">
        <button type="submit">Search</button>
    </form>
    <table>
        <thead>
            <th>Lender ID</th>
            <th>Date of Registration</th>
            <th>Lender Name</th>
            <th>Loanable Amount</th>
            <th>Actions</th>
        </thead>
        <tbody>
            <?php
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['reg_date'] ?></td>
                        <td><?= $row['first_name'] . " " . $row['middle_name'] . " " . $row['last_name'] ?></td>
                        <td><?= "Php " . number_format($row['loanable'], 2) ?></td>
                        <td>
                            <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                            <form action="delete.php" method="post">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <button type="submit" name="delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
    <!-- Transaction -->
</body>
</html>