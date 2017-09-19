<?php
require_once "../src/MainFactory.php";
require_once "InjectableClass.php";
require_once "MyClass.php";

MainFactory::SetClass("InjectableClassName", "InjectableClass", []);
MainFactory::SetClass("MyClassName", "MyClass", ["InjectableClassName"]);

$class = MainFactory::BUILD("MyClassName");
?>