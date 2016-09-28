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
            $enrollment = "1991-09-01";
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
            $enrollment = "1991-09-01";
            $test_student = new Student($id, $name, $enrollment);
            $test_student->save();

            $name2 = "Hermione Granger";
            $id = null;
            $enrollment = "1991-09-01";
            $test_student2 = new Student($id, $name2, $enrollment);
            $test_student2->save();

            //ACT
            $result = Student::getAll();

            //ASSERT
            $this->assertEquals([$test_student, $test_student2], $result);
        }

        function testDeleteAll()
        {
            //ARRANGE
            $name = "Harry Potter";
            $id = null;
            $enrollment = "1991-09-01";
            $test_student = new Student($id, $name, $enrollment);
            $test_student->save();

            $name2 = "Hermione Granger";
            $test_student2 = new Student($id, $name2, $enrollment);
            $test_student2->save();

            // Act
            Student::deleteAll();

            // Assert
            $this->assertEquals([], Student::getAll());
        }

        function test_addCourse()
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
            $test_student->addCourse($test_course);

            // Assert
            $this->assertEquals([$test_course], $test_student->getCourses());
        }

        function test_getCourses()
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
            $test_student->addCourse($test_course);

            $name2 = "Potions";
            $number2 = "POT101";
            $test_course2 = new Course($id, $name2, $number2);
            $test_course2->save();
            $test_student->addCourse($test_course2);

            // Act
            $result = $test_student->getCourses();

            // Assert
            $this->assertEquals([$test_course, $test_course2], $result);
        }

        function testUpdate()
        {
            //ARRANGE
            $id = null;
            $name = "Harry Potter";
            $enrollment = "1991-09-01";
            $test_student = new Student($id, $name, $enrollment);
            $test_student->save();

            $new_name = "Anand Angalig";

            //ACT
            $test_student->update($new_name);

            //ASSERT
            $this->assertEquals("Anand Angalig", $test_student->getName());

        }

        function testDelete()
        {
            //ARRANGE
            $id = null;
            $name = "Harry Potter";
            $enrollment = "1991-09-01";
            $test_student = new Student($id, $name, $enrollment);
            $test_student->save();

            $name2 = "Anand Angalig";
            $enrollment2 = "1999-11-20";
            $test_student2 = new Student($id, $name2, $enrollment2);
            $test_student2->save();

            //ACT
            $test_student->delete();

            //ASSERT
            $this->assertEquals([$test_student2], Student::getAll());
        }

        function testdeleteCourse()
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
            $test_student->addCourse($test_course);

            //ACT
            $test_student->deleteCourse($test_course->getId());

            //ASSERT
            $this->assertEquals([], $test_student->getCourses());

        }


    }




 ?>
