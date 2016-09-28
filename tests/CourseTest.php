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

    class CourseTest extends PHPUnit_Framework_TestCase {

        protected function tearDown()
        {
            Student::deleteAll();
            Course::deleteAll();
        }

        function testSave()
        {
            //ARRANGE
            $name = "Defence Against the Dark Arts";
            $id = null;
            $number = "DADA101";
            $test_course = new Course($id, $name, $number);

            //ACT
            $test_course->save();

            //ASSERT
            $result = Course::getAll();
            $this->assertEquals($test_course, $result[0]);

        }

        function testGetAll()
        {
            //ARRANGE
            $name = "Defence Against the Dark Arts";
            $id = null;
            $number = "DADA101";
            $test_course = new Course($id, $name, $number);
            $test_course->save();

            $name = "Potions";
            $id = null;
            $number = "POT101";
            $test_course2 = new Course($id, $name, $number);
            $test_course2->save();

            //ACT
            $result = Course::getAll();

            //ASSERT
            $this->assertEquals([$test_course, $test_course2], $result);
        }

        function testDeleteAll()
        {
            //ARRANGE
            $name = "Defence Against the Dark Arts";
            $id = null;
            $number = "DADA101";
            $test_course = new Course($id, $name, $number);
            $test_course->save();

            $name = "Potions";
            $id = null;
            $number = "POT101";
            $test_course2 = new Course($id, $name, $number);
            $test_course2->save();

            // Act
            Course::deleteAll();

            // Assert
            $this->assertEquals([], Course::getAll());
        }

        function test_addStudent()
        {
            //ARRANGE
            $name = "Defence Against the Dark Arts";
            $id = null;
            $number = "DADA101";
            $test_course = new Course($id, $name, $number);
            $test_course->save();

            $name = "Harry Potter";
            $enrollment = "1991-09-01";
            $test_student = new Student($id, $name, $enrollment);
            $test_student->save();

            // Act
            $test_course->addStudent($test_student);

            // Assert
            $this->assertEquals([$test_student], $test_course->getStudents());
        }

        function test_getStudents()
        {
            //ARRANGE
            $name = "Defence Against the Dark Arts";
            $id = null;
            $number = "DADA101";
            $test_course = new Course($id, $name, $number);
            $test_course->save();

            $name = "Harry Potter";
            $enrollment = "1991-09-01";
            $test_student = new Student($id, $name, $enrollment);
            $test_student->save();
            $test_course->addStudent($test_student);


            $name2 = "Hermione Granger";
            $test_student2 = new Student($id, $name2, $enrollment);
            $test_student2->save();
            $test_course->addStudent($test_student2);

            // Act
            $result = $test_course->getStudents();

            // Assert
            $this->assertEquals([$test_student, $test_student2], $result);
        }

        function testUpdate()
        {
            //ARRANGE
            $name = "History of Europe";
            $id = null;
            $number = "HIST103";
            $test_course = new Course($id, $name, $number);
            $test_course->save();

            $new_name = "History of Asia";

            //ACT
            $test_course->update($new_name);

            //ASSERT
            $this->assertEquals("History of Asia", $test_course->getName());

        }

        function testDelete()
        {
            //ARRANGE
            $name = "Defence Against the Dark Arts";
            $id = null;
            $number = "DADA101";
            $test_course = new Course($id, $name, $number);
            $test_course->save();

            $name2 = "History of Europe";
            $number2 = "HIST103";
            $test_course2 = new Course($id, $name2, $number2);
            $test_course2->save();

            //ACT
            $test_course->delete();

            //ASSERT
            $this->assertEquals([$test_course2], Course::getAll());
        }

        function testDeleteStudent()
        {
            //ARRANGE
            $id = null;
            $name = "Harry Potter";
            $enrollment = "1991-09-01";
            $test_student = new Student($id, $name, $enrollment);
            $test_student->save();

            $name = "Defence Against the Dark Arts";
            $number = "DADA101";
            $test_course = new Course($id, $name, $number);
            $test_course->save();

            $test_course->addStudent($test_student);

            //ACT
            $test_course->deleteStudent($test_student->getId());

            //ASSERT
            $this->assertEquals([], $test_course->getStudents());

        }

    }




 ?>
