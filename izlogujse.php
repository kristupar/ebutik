<?php
include "inicijalizacija.php";
session_destroy();
header("Location: logovanje.php");