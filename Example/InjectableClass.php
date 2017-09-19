<?php

class InjectableClass
{
    public function __construct()
    {
        echo "<br/>Created Injectable<br/>";
    }

    public function Hello($name)
    {
        echo "<br/>Hello {$name}!<br/>";
    }
}

?>