<?php
    class Artist
    {
        private $name;
        private $genre_id;
        private $id;

        function __construct($name, $genre_id, $id=null)
        {
            $this->name = $name;
            $this->genre_id = $genre_id;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($name)
        {
            $this->name = $name;
        }

        function getId()
        {
            return $this->id;
        }

        function getGenreId()
        {
            return $this->genre_id;
        }

        function setGenreId($id)
        {
            $this->genre_id = $id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO artists (name, genre_id) VALUES ('{$this->getName()}', {$this->getGenreId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_artists = $GLOBALS['DB']->query("SELECT * FROM artists;");
            $artists = array();
            foreach ($returned_artists as $artist) {
                $name = $artist['name'];
                $genre_id = $artist['genre_id'];
                $id = $artist['id'];
                $new_artist = new Artist($name, $genre_id, $id);
                array_push($artists, $new_artist);
            }
            return $artists;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->query("DELETE FROM artists;");

        }

        static function find($search_id)
        {
            $found_artist = NULL;
            $artists = Artist::getAll();
            foreach ($artists as $artist) {
                if ($artist->getId() == $search_id) {
                    $found_artist = $artist;
                }
            }
            return $found_artist;
        }
    }
 ?>
