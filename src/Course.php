<?php
    class Course
    {
        private $id;
        private $name;
        private $number;

        function __construct($id=null, $name, $number)
        {
            $this->id = $id;
            $this->name = $name;
            $this->number = $number;
        }

        function getId()
        {
            return $this->id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function getNumber()
        {
            return $this->number;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO courses (name, number) VALUES ('{$this->getName()}', '{$this->getNumber()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function addStudent($new_student)
        {
            $GLOBALS['DB']->exec("INSERT INTO courses_students (course_id, student_id) VALUES ({$this->getId()}, {$new_student->getId()});");
        }

        function getStudents()
        {
            $returned_students = $GLOBALS['DB']->query("SELECT students.* FROM courses
            JOIN courses_students ON (courses_students.course_id = courses.id)
            JOIN students ON (students.id = courses_students.student_id)
            WHERE courses.id = {$this->getId()};");
            $students = array();
            foreach ($returned_students as $student) {
                $id = $student['id'];
                $name = $student['name'];
                $enrollment = $student['enrollment_date'];
                $new_student = new Student($id, $name, $enrollment);
                array_push($students, $new_student);
            }
            return $students;
        }

        static function getAll()
        {
            $returned_courses = $GLOBALS['DB']->query("SELECT * FROM courses;");
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

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM courses;");
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM courses WHERE id = {$this->getId()};");
        }

        static function find($search_id)
        {
            $found_course = null;
            $courses = Course::getAll();
            foreach ($courses as $course) {
                $course_id = $course->getId();
                if ($course_id == $search_id) {
                    $found_course = $course;
                }
            }
            return $found_course;
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE courses SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);

        }

        function deleteStudent($student_id)
        {
            $GLOBALS['DB']->exec("DELETE FROM courses_students WHERE course_id = {$this->getId()} AND student_id = $student_id;");
        }
    }
 ?>
