<?php
include './Database.php';

if (isset($_GET['id'])) {
    $db = new Database();
    $row = $db->find("employe", $_GET['id']);
    if ($row) {
?>
        <!DOCTYPE html>
        <html>

        <head>
            <title>Delete Employee Confirmation</title>
            <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        </head>

        <body>
            <div class="container">
                <h1>Delete Employee Confirmation</h1>

                <p> delete employee <?php echo $row['name']; ?>?</p>

                <form method="post" action="employees.php">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />

                    <button type="submit" class="btn btn-danger">Back</button>

                </form>

                <div class="alert alert-success" role="alert">
                    <?php echo $db->delete("employe", $row['id']) ?>
                </div>

            </div>
        </body>

        </html>

<?php } // end if $row
} // end if isset($_GET['id'])
?>