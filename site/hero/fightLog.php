<?php

class FightLogLine
{
    public $name_class;
    public $into;
    function __construct($name_class, $into)
    {
        $this->name_class = $name_class;
        $this->into       = $into;
    }

    function logName($name)
    {
        $this->into->log("<span class='$class'>" . $name . "</span>");
        return $this;
    }
    function log($str)
    {
        $this->into->log($str);
        return $this;
    }

    function br()
    {
        $this->into->log("<br />");
        return $this;
    }

    function show()
    {
        return $this->str;
    }
}

class FightLog
{
    public $lines = "";
    function log($line)
    {
        $this->lines .= $line->show();
    }

    function show()
    {
        return $this->lines;
    }
}

?>
