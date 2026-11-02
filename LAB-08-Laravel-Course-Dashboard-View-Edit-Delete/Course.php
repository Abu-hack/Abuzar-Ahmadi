<?php

// Defines the location (folder) of this model in the Laravel project.
namespace App\Models;

// Imports Laravel's built-in Model class.
// This allows the Course class to interact with the database.
use Illuminate\Database\Eloquent\Model;

// Creates a model named Course.
// Laravel connects this model to the "courses" database table by default.
class Course extends Model
{
    // Lists the fields that Laravel allows us to fill automatically
    // when creating or updating a course.
    protected $fillable = [
        'user_id',       
        'course_code',    
        'course_name',   
        'credit_hours',  
        'semester',      
    ];
}