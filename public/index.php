<?php header('Location: ' . preg_replace('/^(.+)\/index\.php$/i', '${1}/login.php', $_SERVER['SCRIPT_NAME'])); ?>
