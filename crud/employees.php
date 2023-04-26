<?php

include './Database.php';
include './nav.php';


?>

<!DOCTYPE html>
<html>

<head>
    <title>Employees</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <?php $db = new Database(); ?>
    <?php if (count($db->read("employe"))) : ?>
        <div class="container">
            <h1>Employees</h1>
            <a href="add_employees.php" class="btn btn-primary mb-3">Add Employe</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($db->read("employe") as $row) : ?>
                        <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo strtoupper($row['name']) ?></td>
                            <td><?php echo $row['email'] ?></td>
                            <td><?php echo strtoupper($row['department']) ?></td>
                            <td>
                                <a href="edit_employee.php?id=<?php echo $row['id'] ?>" class="btn btn-success">Edit</a>
                                <a href="delete_employe.php?id=<?php echo $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</body>

</html>