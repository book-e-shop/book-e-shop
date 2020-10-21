<?php
// Производим выход пользователя
unset($_SESSION['logged_user']);

// Редирект на главную страницу
header('Location: index.php');
?>