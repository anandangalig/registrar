<?php

/**
   *@backupGlobals disabled
   *@backupStaticAttributes disabled
   */

    require_once "src/Student.php";
    require_once "src/Course.php";

    $server = 'mysql:host=localhost:8889;dbname=registrar_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO ($server, $username, $password);

    class StudentTest extends PHPUnit_Framework_TestCase {

        protected function tearDown()
        {
            Student::deleteAll();
            Course::deleteAll();
        }

        function testSave()
        {
            //ARRANGE
            $name = "Harry Potter";
            $id = null;
            $enrollment = 1991-09-01;
            $test_student = new Student($id, $name, $enrollment);

            //ACT
            $test_student->save();

            //ASSERT
            $result = Student::getAll();
            $this->assertEquals($test_student, $result[0]);

        }

        function testGetAll()
        {
            //ARRANGE
            $name = "Harry Potter";
            $id = null;
            $enrollment = 1991-09-01;
            $test_student = new Student($id, $name, $enrollment);
            $test_student->save();

            $name2 = "Hermione Granger";
            $id = null;
            $enrollment = 1991-09-01;
            $test_student2 = new Student($id, $name2, $enrollment);
            $test_student2->save();

            //ACT
            $result = Student::getAll();

            //ASSERT
            $this->assertEquals([$test_student, $test_student2], $result);



        }


    }




 ?>
