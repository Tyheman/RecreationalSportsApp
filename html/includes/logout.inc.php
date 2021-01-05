


<?php 

//Logout Script
//Unset and destroys session
//Goes back to the main screen

session_start();
session_unset();
session_destroy();
header("Location: ../../index.html");