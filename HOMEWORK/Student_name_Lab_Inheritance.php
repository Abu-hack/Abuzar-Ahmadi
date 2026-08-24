<?php
//  I create A class named StudentAccount using class key words
class StudentAccount {

    // we define three  properties such as public , private , protected for this class
    public $name;
    private $studentid;
    protected $department;

// here we define construct method to give to properities starting values
    public function __construct($name, $studentid, $department) {
        $this->name = $name;
        $this->studentid = $studentid;
        $this->department = $department;

    }
     // we define another method to show all information about StudentAccount
    function Showinfo() {
        echo "Name: {$this->name} <br>
              StudentId: {$this->studentid} <br>
              department: {$this->department} <br>";
    }
    // this method retun the private property 
    function getStudentId() {
        return $this->studentid;


    }
}
// I CREATE  an object named student1 with the key word new and the name of the class and assign it to the variable student1

$student1 = new StudentAccount("Abuzar",7777, "IT");
$student1 -> Showinfo();

echo "Student Id from method ".$student1 -> getStudentId() ;
echo $student1->name; // it prints the name which is defined in the class as public
//echo $student1->studentId; // it can not be printed because the variable is defined as private only accessble inside the class in method
//echo $student1->department; // it can not be printed because the variable is defined as protected only can be accessed in child class

// Task 2

// I create A parent class named person using class key words
class Person {

    // defining one protected property which is only accessble from child class and inside the class
    protected $name;

// here we define construct method to give to properity starting values
    function __construct ($name) {
        $this->name = $name;
        
    }
    
    // this method retun or print the protected property
    function introduce() {
        echo "<br>My name is {$this->name} <br>";
    
    }

}

// creating a class  named student to be child of parent class and inherit all properties and method
class Student extends Person {

// this method retun or print the protected property from parent class
    function study() {
        echo "{$this->name} is studying!";

    }
    


}
 // creating object for the class and calling its method on the object
$student2 = new Student("Sara");
$student2-> introduce();
$student2-> study();


// task3 
// //  I create A parent class named employee using class key words
class Employee {

  // we define three  properties such as public , private , protected for this class
    protected $name;
    public $company;
    private $salary;

    // here we define construct method to give to properities starting values
    function __construct($name, $company, $salary) {
        $this->name = $name;
        $this->company = $company;
        $this->salary = $salary;
    }

      // we define another method to show all information about employee
    function showEmployee() {
        echo "Name: {$this->name} <br>
              Company: {$this->company} <br>
              Salary: {$this->salary} <br>";
    }
 // this method retun or print the private property
    function getSalary(){
        echo "Salary from method: {$this->salary} <br>" ;
    }
    
}


// creating a class  named manager to be child of parent class named employee and inherit all properties and method
class Manager extends Employee {

// this method retun or print the protected property from parent class
    function manageTeam () {
        echo "{$this->name} is managing the team";
    }
}

 // creating object for the class and calling its method on the object
$manager1 = new Manager("Ali","Kabul Tech", 30000);
$manager1->showEmployee();
$manager1->getSalary();
$manager1->manageTeam();

?>


5. Short Questions
1. What does public mean? >>>>>>> public means that our property can be access from everywhere(indie php file)
2. What does private mean? >>>>>> private means that our property can only be access inside a class
3. What does protected mean? >>>> protected means that our property can only be access inside a class and child class 
4. What is the purpose of extends? >>>> it allows child class to inherit all property and method from parent class 
5. Which class is called the parent class? >>>>> the class that another class use or inherit all its public and protected property and method
6. Which class is called the child class? >>>>>> the class that use or inherit all  public and protected property and method from parent class
7. Why is protected useful in inheritance? because it only allows the child class use the property and method and other unrelated class can not access them