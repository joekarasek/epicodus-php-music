<?php
    class Genre
    {
        private $type;
        private $id;

        function __construct($type, $id=null)
        {
            $this->type = $type;
        }

        function getType()
        {
            return $this->type;
        }

        function setType($type)
        {
            $this->type = $type;
        }

        function getID()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBAL['DB']->exec("INSERT INTO genres (type) VALUES ('{$this->getType()}')");
        }
    }
 ?>
