<?php
@ob_start();
session_start();
require 'connect/connect.php';
?>
<?php
session_unset();
session_destroy();

header('Location: ../index');

?>