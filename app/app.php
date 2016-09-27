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
    $app->get("/create_student", function() use($app) {
        $creating_student = true;
        return $app['twig']->render("index.html.twig", array('students' => Student::getAll(), 'courses' => Course::getAll()));
    });
    $app->post("/create_student", function() use($app) {
        $creating_student = false;
        $id = null;
        $new_student = new Student($id, $_POST['name'], $_POST['enrollment_date']);
        $new_student->save();
        return $app['twig']->render("index.html.twig", array('students' => Student::getAll(), 'courses' => Course::getAll()));
    });
    $app->get("/create_course", function() use($app) {
        $creating_course = true;
        return $app['twig']->render("index.html.twig", array('students' => Student::getAll(), 'courses' => Course::getAll()));
    });
    $app->post("/create_course", function() use($app) {
        $creating_course = false;
        $id = null;
        $new_course = new Course($id, $_POST['name'], $_POST['number']);
        $new_course->save();
        return $app['twig']->render("index.html.twig", array('students' => Student::getAll(), 'courses' => Course::getAll()));
    });









    return $app;
 ?>
