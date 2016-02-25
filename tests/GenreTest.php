<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once __DIR__ . '/../src/Genre.php';

    $server = 'mysql:host=localhost:8889;dbname=music_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class GenreTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Genre::deleteAll();
        }

        function test_save()
        {
            // Arrange
            $type = 'Classic Rock';
            $test_Genre = new Genre($type);

            // Act
            $test_Genre->save();

            // Assert
            $result = Genre::getAll();
            $this->assertEquals($test_Genre, $result[0]);
        }

        function test_getId()
        {
            // Arrange
            $type = 'Classic Rock';
            $id = 1;
            $test_Genre = new Genre($type, $id);

            // Act
            $result = $test_Genre->getId();

            // Assert
            $this->assertEquals(1, $result);
        }

        function test_getAll()
        {
            // Arrange
            $type = 'Classic Rock';
            $test_Genre = new Genre($type);
            $test_Genre->save();
            $type2 = 'Modern Rock';
            $test_Genre2 = new Genre($type2);
            $test_Genre2->save();

            // Act
            $result = Genre::getAll();

            // Assert
            $this->assertEquals([$test_Genre, $test_Genre2], $result);

        }

        function test_deleteAll()
        {
            // Arrange
            $type = 'Classic Rock';
            $test_Genre = new Genre($type);
            $test_Genre->save();
            $type2 = 'Modern Rock';
            $test_Genre2 = new Genre($type2);
            $test_Genre2->save();

            // Act
            Genre::deleteAll();
            $result = Genre::getAll();

            // Assert
            $this->assertEquals([], $result);

        }

        function test_find()
        {
            // Arrange
            $type = 'Classic Rock';
            $test_Genre = new Genre($type);
            $test_Genre->save();
            $type2 = 'Modern Rock';
            $test_Genre2 = new Genre($type2);
            $test_Genre2->save();

            // Act
            $id = $test_Genre->getId();
            $result = Genre::find($id);

            // Assert
            $this->assertEquals($test_Genre, $result);
        }
    }
 ?>
