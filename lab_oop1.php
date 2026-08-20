<?php
//  I create A class named Student using class key words
class Student {
    // we define three public properties for this class
    public $name;
    public $studentid;
    public $department;
    // here we define construct method to give to properities starting values
    public function __construct($name, $studentid, $department){
        $this->name=$name;
        $this->studentid=$studentid;
        $this->department=$department;
            }
        // we define another method to show all information about student
        public function showInfo(){
            echo "Name: {$this->name} <br>
                  Student ID: {$this->studentid} <br>
                  Department: {$this->department}";

        }
        
// inside the class student we create a function called sayhello to print s/th
    public function sayHello() {
        echo "Hello! I am a student.";
    }



}

// I CREATE  an object named student1 with the key word new and the name of the class and assign it to the variable student1
//$student1 = New Student();
// calling the method sayHello on object
//$student1->sayHello();
$student1 = new Student("Abuzar",1001,"Computer Science");
$student1->showInfo();
// I CREATE  the second object named student2 with the key word new and the name of the class and assign it to the variable student2
$student2 = new Student("Sara",1002, "Information System");
$student2->showInfo();