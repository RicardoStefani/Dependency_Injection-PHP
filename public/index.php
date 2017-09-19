<?php
require_once "../src/MainFactory.php";
require_once "MyClass.php";

MainFactory::SetClass("MyClassName", "MyClass", []);

$class = MainFactory::build("MyClassName");

?>