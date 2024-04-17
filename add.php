<?php

include "connect.php";

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
        <button>Add Lender</button>
    </form>
</body>
</html>