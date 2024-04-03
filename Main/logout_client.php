<?php
session_start();

// Clear the session variables
unset($_SESSION['account_id']);
unset($_SESSION['password']);
unset($_SESSION['role']);

// Clear the stored values in session storage from login.html
echo '<script>
        sessionStorage.removeItem("account_id");
        sessionStorage.removeItem("password");
        sessionStorage.removeItem("selectedRole");
      </script>';

// Redirect to the login page after logout
header("Location: login.html");
exit();
?>