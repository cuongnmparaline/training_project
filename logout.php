<?php
session_start();
session_destroy();
header("Location:index.php?controller=user&action=login");