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
