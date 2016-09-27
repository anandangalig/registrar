<?php
    class Student
    {
        private $id;
        private $name;
        private $enrollment;

        function __construct($id=null, $name, $enrollment)
        {
            $this->id = $id;
            $this->name = $name;
            $this->enrollment = $enrollment;
        }

        function getId()
        {
            return $this->id;
        }

        function getName()
        {
            return $this->name;
        }

        function getEnrollment()
        {
            return $this->enrollment;
        }



        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO students (name, enrollment_date) VALUES ('{$this->getName()}', '{$this->getEnrollment()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function addCourse($new_course)
        {
            $GLOBALS['DB']->exec("INSERT INTO courses_students (course_id, student_id) VALUES ({$new_course->getId()}, {$this->getId()});");
        }

        function getCourses()
        {
            $returned_courses = $GLOBALS['DB']->query("SELECT courses.* FROM students
            JOIN courses_students ON (courses_students.student_id = students.id)
            JOIN courses ON (courses.id = courses_students.course_id)
            WHERE students.id = {$this->getId()};");
            $courses = array();
            foreach ($returned_courses as $course)
            {
                $id = $course['id'];
                $name = $course['name'];
                $number = $course['number'];
                $new_course = new Course($id, $name, $number);
                array_push($courses, $new_course);
            }
            return $courses;
        }

        static function getAll()
        {
            $returned_students = $GLOBALS['DB']->query("SELECT * FROM students;");
            $students = array();
            foreach ($returned_students as $student)
            {
                $id = $student['id'];
                $name = $student['name'];
                $enrollment = $student['enrollment_date'];
                $new_student = new Student($id, $name, $enrollment);
                array_push($students, $new_student);
            }
            return $students;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM students;");
        }
    }
 ?>
