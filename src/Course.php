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

        function getNumber()
        {
            return $this->number;
        }



        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO courses (name, number) VALUES ('{$this->getName()}', '{$this->getNumber()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
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
    }
 ?>
