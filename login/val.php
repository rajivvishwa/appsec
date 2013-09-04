if (!$_SESSION["valid_user"])
{
// User not logged in, redirect to login page
Header("Location: login.php");
}