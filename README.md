# _School Registrar_

####_A basic app practicing many-to-many relationships for a students and courses enrolled. 09/28/2016_

#### By _**Anand Angalig**_


## Description

_The Registrar(user) is able to Create, Read, Update, and Delete courses and students. Also, he/she can enroll/drop students from a class and add/delete courses from a student's schedule._


## Setup/Installation Requirements

* _If you wish to view the source code locally on your machine please follow the following steps:_

    * _Navigate to the directory in which you want the project to reside_

    * _Enter the following command into your terminal:_
        _git clone https://github.com/anandangalig/registrar.git_

    * _Navigate to the cloned directory, and execute the following command in the terminal:_
          _composer install_

    * _Start your local hosting program, such as MAMP, and set the Web Server preference to highest level of the  downloaded repository file_

    * _To start the MySQL, go to the terminal and execute:_
        _/Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot_

    * _Using PHPMyAdmin, create a new Database named **registrar**, then import the registrar.sql.zip file_

    * _Start a new tab on the Terminal and navigate to the web directory and start your local host by executing the following command in your terminal:_
          _php -S localhost:8000_

    * _Open up the browser of your choice and go to the following url:_
          _http://localhost:8000/_

    * _If you wish to look at the source code, feel free to browse through the files in the directory_


## User Stories:

* _As a user, he/she is able to create new courses and students

* _As a user, he/she is able to see the existing courses and students_

* _As a user, he/she is able to update information of existing courses and students_

* _As a user, he/she is able to delete courses and students one by one or all at once_

* _As a user, he/she is able create relationships between the two courses:_
    * _Any given student can be enrolled into or dropped from any existing class
    * _Any given class can be added to or dropped from any student's schedule_



## MySQL Commands Used:

* _CREATE DATABASE registrar;_
* _USE registrar;_
* _CREATE TABLE courses (id serial PRIMARY KEY, name VARCHAR (255));_
* _CREATE TABLE students (id serial PRIMARY KEY, name VARCHAR (255));_
* _CREATE TABLE courses_students (id serial PRIMARY KEY, course_id INT, student_id INT);_


## Known Bugs

_None for now, but please contact me if you find one_


## Support and Contact Details

_Please feel free to contact us at:_
    _anandangalig@gmail.com_

## Technologies Used

* _silex v~2.0_
* _twig v~1.0_
* _phpunit v5.5.*_
* _MAMP_



### License
_Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:_

_The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software._

_THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE._

Copyright (c) 2016 **_Anand Angalig_**
