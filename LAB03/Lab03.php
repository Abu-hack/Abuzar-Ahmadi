<?php
// Task 1
// we create a class name Library 
class Library {

    // here we define a constant with a value of 3
    const MAX_BOOKS = 3; // this is constant because its value must not change throughout the program execution
}
// outside the class we echo the constant
echo "Maximum books allowed:".Library::MAX_BOOKS ."<br>";


// Task 2
// creating a class named StudentCounter
class StudentCounter {
    // we define a static property named count that belongs to that class itself not to individual objects with initial value of 0
    public static $count = 0;

    //here we define a public static method called addstudent
    public static function addStudent() {

    // here we use the static count property using self key word to refer to the class itself and increase count by 1 using ++ signs
        self::$count++;


    }
}
// here we call three times the addStudent function without creating objects
StudentCounter::addStudent();
StudentCounter::addStudent();
StudentCounter::addStudent();
// we print the the total students
echo "Total students:". StudentCounter::$count."<br>";



// Task 3
// we create an abstract class named Vehicle
abstract class  Vehicle {

// we define an abstract public function inside an abstract class that child classess make this method inside them and implement it
    abstract public function start();


}
// we create a class named Car and this car inhereit all property and method from vehicle
class Car extends Vehicle {

// this method of abstract class the Car class has declare again it and implement it 
    public function start() {
        echo "Car engine started! <br>";
    }
}

// we create a class named Bike and this bike class inhereits all property and method from vehicle
class Bike extends Vehicle {

// this method of abstract class the bike class has declare  it  again and implement it 
    public function start() {
        echo " Bike started!";

    }
}


 // creating object for the class Car and calling its method on the object
$car1 = new Car();
$car1->start();
// creating object for the class Bike and calling its method on the object
$bike = new Bike();
$bike->start();
?>



