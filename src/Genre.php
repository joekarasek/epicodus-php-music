<?php
    class Genre
    {
        private $name;
        private $id;

        function __construct($name, $id=null)
        {
            $this->name = $name;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($name)
        {
            $this->name = $name;
        }

        function getID()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO genres (name) VALUES ('{$this->getName()}');");
        }

        static function getAll()
        {
            $returned_genres = $GLOBALS['DB']->query("SELECT * FROM genres;");
            $genres = array();
            foreach ($returned_genres as $genre) {
                $name = $genre['name'];
                $new_genre = new Genre($name);
                array_push($genres, $new_genre);
            }
            return $genres;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->query("DELETE FROM genres;");

        }
    }
 ?>
