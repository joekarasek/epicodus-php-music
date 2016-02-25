<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once __DIR__ . '/../src/Artist.php';

    $server = 'mysql:host=localhost:8889;dbname=music_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ArtistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Artist::deleteAll();
        }

        function test_save()
        {
            // Arrange
            $type = 'Classic Rock';
            $test_Genre = new Genre($type);
            $test_Genre->save();
            $genre_id = $test_Genre->getId();
            $name = 'Beatles';
            $test_Artist = new Artist($name, $genre_id);

            // Act
            $test_Artist->save();

            // Assert
            $result = Artist::getAll();
            $this->assertEquals($test_Artist, $result[0]);
        }

        function test_getId()
        {
            // Arrange
            $type = 'Classic Rock';
            $test_Genre = new Genre($type);
            $test_Genre->save();
            $genre_id = $test_Genre->getId();
            $name = 'Beatles';
            $id = 1;
            $test_Artist = new Artist($name, $genre_id, $id);

            // Act
            $result = $test_Artist->getId();

            // Assert
            $this->assertEquals(1, $result);
        }

        function test_getAll()
        {
            // Arrange
            $type = 'Classic Rock';
            $test_Genre = new Genre($type);
            $test_Genre->save();
            $genre_id = $test_Genre->getId();
            $name = 'Beatles';
            $test_Artist = new Artist($name, $genre_id);
            $test_Artist->save();
            $name2 = 'Rolling Stones';
            $test_Artist2 = new Artist($name2, $genre_id);
            $test_Artist2->save();

            // Act
            $result = Artist::getAll();

            // Assert
            $this->assertEquals([$test_Artist, $test_Artist2], $result);

        }

        function test_deleteAll()
        {
            // Arrange
            $type = 'Classic Rock';
            $test_Genre = new Genre($type);
            $test_Genre->save();
            $genre_id = $test_Genre->getId();
            $name = 'Beatles';
            $test_Artist = new Artist($name, $genre_id);
            $test_Artist->save();
            $name2 = 'Rolling Stones';
            $test_Artist2 = new Artist($name2, $genre_id);
            $test_Artist2->save();

            // Act
            Artist::deleteAll();
            $result = Artist::getAll();

            // Assert
            $this->assertEquals([], $result);

        }

        function test_find()
        {
            // Arrange
            $type = 'Classic Rock';
            $test_Genre = new Genre($type);
            $test_Genre->save();
            $genre_id = $test_Genre->getId();
            $name = 'Beatles';
            $test_Artist = new Artist($name, $genre_id);
            $test_Artist->save();
            $name2 = 'Rolling Stones';
            $test_Artist2 = new Artist($name2, $genre_id);
            $test_Artist2->save();

            // Act
            $id = $test_Artist->getId();
            $result = Artist::find($id);

            // Assert
            $this->assertEquals($test_Artist, $result);
        }
    }
 ?>
