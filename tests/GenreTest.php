<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once __DIR__ . '/../src/Genre.php';

    $server = 'mysql:host=localhost;dbname=music_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class GenreTest extends PHPUnit_Framework_TestCase
    {
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
    }
 ?>
