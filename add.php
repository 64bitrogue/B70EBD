<?php

include "connect.php";
include "functions.php";

$errors = [];

$id = null;
$first_name = null;
$middle_name = null;
$last_name = null;
$reg_date = null;
$loanable = null;

if (isset($_POST['create'])) {
    $first_name = sanitizeInput($_POST['first_name']);
    $middle_name = sanitizeInput($_POST['middle_name']);
    $last_name = sanitizeInput($_POST['last_name']);
    $reg_date = sanitizeInput($_POST['reg_date']);
    $loanable = sanitizeInput($_POST['loanable']);

    // Validate

    if (empty($first_name)) {
        $errors['first_name'] = "Please enter the first name.";
    } else if (!preg_match("/[^a-zA-Z ]*$/", $first_name)) {
        $errors['first_name'] = "Please enter a valid first name.";
    }

    if (empty($middle_name)) {
        $errors['middle_name'] = "Please enter the middle name.";
    } else if (!preg_match("/[^a-zA-Z ]*$/", $middle_name)) {
        $errors['middle_name'] = "Please enter a valid middle name.";
    }

    if (empty($last_name)) {
        $errors['last_name'] = "Please enter the last name.";
    } else if (!preg_match("/[^a-zA-Z ]*$/", $last_name)) {
        $errors['last_name'] = "Please enter a valid last name.";
    }

    $date_timestamp = strtotime($reg_date);

    if (!$date_timestamp) {
        $errors['reg_date'] = "Please enter a valid date.";
    } else if ($date_timestamp > time()) {
        $errors['reg_date'] = "Registration date cannot be a future date.";
    }

    if (empty($loanable)) {
        $errors['loanable'] = "Please enter the loanable amount.";
    } else if ($loanable <= 0) {
        $errors['loanable'] = "Loanable amount cannot be negative or zero.";
    }

    if (count($errors) == 0) {
        $id = generateID($last_name, $reg_date);

        $query = "INSERT INTO lenders VALUES ('$id', '$reg_date', '$last_name', '$first_name', '$middle_name', $loanable)";

        if ($conn->query($query)) {
            $conn->close();
            header("Location: index.php");
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>

    <style>
        p.error {
            color: bold;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <a href="index.php">Go Back</a>
    <hr>
    <form action="add.php" method="post">
        <div>
            <label for="first_name">First Name</label>
            <input value="<?= $first_name ?>" type="text" name="first_name" id="first_name">
            <?php
            if (isset($errors['first_name'])) {
                ?>
                <p class="error"><?= $errors['first_name'] ?></p>
                <?php
            }
            ?>
        </div>
        <div>
            <label for="middle_name">Middle Name</label>
            <input value="<?= $middle_name ?>" type="text" name="middle_name" id="middle_name">
            <?php
            if (isset($errors['middle_name'])) {
                ?>
                <p class="error"><?= $errors['middle_name'] ?></p>
                <?php
            }
            ?>
        </div>
        <div>
            <label for="last_name">Last Name</label>
            <input value="<?= $last_name ?>" type="text" name="last_name" id="last_name">
            <?php
            if (isset($errors['last_name'])) {
                ?>
                <p class="error"><?= $errors['last_name'] ?></p>
                <?php
            }
            ?>
        </div>
        <div>
            <label for="reg_date">Registration Date</label>
            <input value="<?= $reg_date ?>" type="date" name="reg_date" id="reg_date">
            <?php
            if (isset($errors['reg_date'])) {
                ?>
                <p class="error"><?= $errors['reg_date'] ?></p>
                <?php
            }
            ?>
        </div>
        <div>
            <label for="loanable">Loanable Amount</label>
            <input value="<?= $loanable ?>" type="number" step="any" name="loanable" id="loanable">
            <?php
            if (isset($errors['loanable'])) {
                ?>
                <p class="error"><?= $errors['loanable'] ?></p>
                <?php
            }
            ?>
        </div>
        <button type="submit" name="create">Add Lender</button>
    </form>
</body>
</html>