<?php

class MyClass
{
    public function __construct($injectable_class)
    {
        echo "<br/>Created MyClass<br/>";
        $injectable_class->Hello("MyClass");
    }
}

?>