<?php
include './nav.php';
include './Database.php';
$departments = array("it", "cs", "sc");
$error = '';
$success = '';
if (isset($_POST['submit'])) {

    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $department = filter_var($_POST['department'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    if (empty($name) || empty($email) || empty($department) || empty($password)) {
        $error = "Please Fill All Fields";
    } else {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $department = strtolower($department);
            if (in_array($department, $departments)) {
                if (strlen($password) > 6) {
                    $db = new Database();
                    $newPassword = $db->enc_password($password);
                    $sql = "INSERT INTO employe(`name`,`email`,`department`,`password`)
                    VALUES ('$name','$email','$department','$newPassword')
                    ";
                    $success = $db->insert($sql);
                } else {
                    $error = "This Password is too short";
                }
            } else {
                $error = "This Department Not Found";
            }
        } else {
            $error = "Please Type Valid Email";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Employee</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Add Employee</h1>
        <?php if ($error != "") : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error ?> </div>
        <?php endif; ?>
        <?php if ($success != "") : ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success ?> </div>
        <?php endif; ?>


        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Department</label>
                <input type="text" name="department" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Add Employee</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

</html>