<?php
    /**
    *@backupGlobals disabled
    *@backupStaticAttributes disabled
    */

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Student.php";
    require_once __DIR__."/../src/Course.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=registrar';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array ('twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use($app) {
        return $app['twig']->render("index.html.twig", array('students' => Student::getAll(), 'courses' => Course::getAll()));
    });

// STUDENTS

    $app->get("/create_student", function() use($app) {
        return $app['twig']->render("index.html.twig", array('students' => Student::getAll(), 'courses' => Course::getAll()));
    });
    $app->post("/create_student", function() use($app) {
        $id = null;
        $new_student = new Student($id, $_POST['name'], $_POST['enrollment_date']);
        $new_student->save();
        return $app['twig']->render("index.html.twig", array('students' => Student::getAll(), 'courses' => Course::getAll()));
    });
    $app->get("/student/{id}", function($id) use($app) {
        $student = Student::find($id);
        return $app['twig']->render("student.html.twig", array('student' => $student, 'courses' => Course::getAll()));
    });

    $app->post("/student/{id}/add_course", function($id) use($app) {
        $student = Student::find($id);
        $course = Course::find($_POST['course_id']);
        $student->addCourse($course);
        return $app['twig']->render("student.html.twig", array('student' => $student, 'courses' => Course::getAll()));
    });

    $app->post("/delete_all_students", function() use($app) {
        Student::deleteAll();
        return $app['twig']->render("index.html.twig", array('students' => Student::getAll(), 'courses' => Course::getAll()));
    });
// COURSES

    $app->get("/create_course", function() use($app) {
        return $app['twig']->render("index.html.twig", array('students' => Student::getAll(), 'courses' => Course::getAll()));
    });
    $app->get("/course/{id}", function($id) use($app) {
        $course = Course::find($id);
        return $app['twig']->render("course.html.twig", array('students' => Student::getAll(), 'course' => $course));
    });
    $app->post("/course/{id}/add_student", function($id) use($app) {
        $course = Course::find($id);
        $student = Student::find($_POST['student_id']);
        $course->addStudent($student);
        return $app['twig']->render("course.html.twig", array('students' => Student::getAll(), 'course' => $course));
    });
    $app->post("/create_course", function() use($app) {
        $id = null;
        $new_course = new Course($id, $_POST['name'], $_POST['number']);
        $new_course->save();
        return $app['twig']->render("index.html.twig", array('students' => Student::getAll(), 'courses' => Course::getAll()));
    });

    $app->post("/delete_all_courses", function() use($app) {
        Course::deleteAll();
        return $app['twig']->render("index.html.twig", array('students' => Student::getAll(), 'courses' => Course::getAll()));
    });











    return $app;
 ?>
