<?php
 /* include 'db_connect.php';
session_start();
//$connection = mysqli_connect("localhost","root","");
//$db = mysqli_select_db($connection,"lms");
$password = "";
$query = "select * from admins where email = '$_SESSION[email]'";
$query_run = mysqli_query($connection,$query);
while($row = mysqli_fetch_assoc($query_run)){
$password = $row['password'];
}
if($password == $_POST['old_password']){
$query = "update admins set password = '$_POST[new_password]' where email = '$_SESSION[email]'";
$query_run = mysqli_query($connection,$query);
}*/
	?>
 <!--<script type="text/javascript">
	alert("Updated successfully...");
	window.location.href = "admin_dashboard.php";
</script>-->


<?php
include 'db_connect.php';
session_start();

// Initialize variables
$password = "";
$new_password = "";

// Check if form is submitted with old and new passwords
if(isset($_POST['old_password']) && isset($_POST['new_password'])) {
    // Retrieve old and new passwords from form
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    // Query to fetch the current password of the admin
    $query = "SELECT password FROM admins WHERE email = '$_SESSION[email]'";
    $query_run = mysqli_query($connection, $query);

    // Check if query executed successfully
    if($query_run) {
        // Fetch the password from the database
        $row = mysqli_fetch_assoc($query_run);
        if($row) {
            $password = $row['password'];
        }

        // Check if old password matches the one in the database
        if($password == $old_password) {
            // Update the password
            $update_query = "UPDATE admins SET password = '$new_password' WHERE email = '$_SESSION[email]'";
            $update_query_run = mysqli_query($connection, $update_query);

            // Check if password was updated successfully
            if($update_query_run) {
                echo '<script type="text/javascript">
                        alert("Password updated successfully...");
                        window.location.href = "admin_dashboard.php";
                    </script>';
                exit();
            } else {
                echo '<script type="text/javascript">
                        alert("Error updating password. Please try again.");
                        window.location.href = "admin_dashboard.php";
                    </script>';
                exit();
            }
        } else {
            echo '<script type="text/javascript">
                    alert("Incorrect old password. Please try again.");
                    window.location.href = "admin_dashboard.php";
                </script>';
            exit();
        }
    } else {
        echo '<script type="text/javascript">
                alert("Error fetching admin details. Please try again.");
                window.location.href = "admin_dashboard.php";
            </script>';
        exit();
    }
} else {
    echo '<script type="text/javascript">
            alert("Please provide both old and new passwords.");
            window.location.href = "admin_dashboard.php";
        </script>';
    exit();
}
?>
