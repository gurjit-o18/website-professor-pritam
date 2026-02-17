<?php
require_once 'functions.php';

// Destroy session and logout
session_destroy();

// Redirect to homepage
header('Location: index.php');
exit;
