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

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();


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

    $app->post("/delete_student/{id}", function($id) use ($app) {
        $student = Student::find($id);
        $student->delete();
        return $app['twig']->render('index.html.twig', array('students' => Student::getAll(), 'courses' => Course::getAll()));
    });

    $app->get("/students/{id}/edit", function($id) use ($app) {
        $student = Student::find($id);
        return $app['twig']->render('student_edit.html.twig', array('student' => $student));
    });

    $app->patch("/students/{id}", function($id) use ($app) {
        $new_name = $_POST['new_student_name'];
        $student = Student::find($id);
        $student->update($new_name);
        return $app['twig']->render('student.html.twig', array('courses' => Course::getAll(), 'student' => $student));
    });

    $app->delete("/students/{id}/course_delete", function($id) use ($app) {
        //$test_student->deleteCourse($test_course->getId());
        $student = Student::find($_POST['student_id']);
        $student->deleteCourse($id);
        return $app['twig']->render("student.html.twig", array('courses' => Course::getAll(), 'student' => $student));
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

    $app->post("/delete_course/{id}", function($id) use ($app) {
        $course = Course::find($id);
        $course->delete();
        return $app['twig']->render('index.html.twig', array('students' => Student::getAll(), 'courses' => Course::getAll()));
    });
    $app->get("/courses/{id}/edit", function($id) use ($app) {
        $course = Course::find($id);
        return $app['twig']->render('course_edit.html.twig', array('course' => $course));
    });

    $app->patch("/courses/{id}", function($id) use ($app) {
        $new_name = $_POST['new_course_name'];
        $course = Course::find($id);
        $course->update($new_name);
        return $app['twig']->render('course.html.twig', array('students' => Student::getAll(), 'course' => $course));
    });

    $app->delete("/courses/{id}/student_delete", function($id) use ($app) {
        //$test_course->deleteStudent($test_student->getId());
        $course = Course::find($_POST['course_id']);
        $course->deleteStudent($id);
        return $app['twig']->render("course.html.twig", array('students' => Student::getAll(), 'course' => $course));
    });

    return $app;
 ?>
