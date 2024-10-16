<?php
$passwords = ['setways1', 'setways2', 'setways3'];
foreach ($passwords as $password) {
    echo password_hash($password, PASSWORD_DEFAULT) . "\n";
}
?>
