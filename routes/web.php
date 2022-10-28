<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ExamTypesController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\YearController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/admin', function () {
    return view('admin/index');
})->name('dashbaord');

Route::get('/admin/exams', function () {
    return view('admin/exams');
})->name('exams');

Route::get('/admin/exam-results', function () {
    return view('admin/examResults');
})->name('exam_results');

Route::get('/admin/lecturers', function () {
    return view('admin/lecturers');
})->name('lecturers');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ACADAMIC YEARS ROUTES
Route::get('/admin/acadamic-years', [YearController::class, 'index'])->name('acadamic_years.index');
Route::post('/admin/acadamic-years', [YearController::class, 'addYear'])->name('acadamic_years.addYear');
Route::post('/admin/acadamic-years/remove', [YearController::class, 'removeYear'])->name('acadamic_years.remove');
Route::post('/admin/acadamic-years/edit', [YearController::class, 'editYear'])->name('acadamic_years.edit');

// DEPARTMENTS ROUTES
Route::get('/admin/departments', [DepartmentController::class, 'index'])->name('departments.index');
Route::post('/admin/departments', [DepartmentController::class, 'addDepartment'])->name('departments.add');
Route::post('/admin/departments/remove', [DepartmentController::class, 'removeDepartment'])->name('departments.remove');
Route::post('/admin/departments/edit', [DepartmentController::class, 'editDepartment'])->name('departments.edit');

// EXAM TYPES ROUTES
Route::get('/admin/exam-types', [ExamTypesController::class, 'index'])->name('exam_types.index');
Route::post('/admin/exam-types', [ExamTypesController::class, 'addExamType'])->name('exam_types.add');
Route::post('/admin/exam-types/remove', [ExamTypesController::class, 'removeExamType'])->name('exam_types.remove');
Route::post('/admin/exam-types/edit', [ExamTypesController::class, 'editExamType'])->name('exam_types.edit');

// SEMESTER ROUTES
Route::get('/admin/semesters', [SemesterController::class, 'index'])->name('semesters.index');
Route::post('/admin/semesters', [SemesterController::class, 'addSemester'])->name('semesters.add');
Route::post('/admin/semesters/remove', [SemesterController::class, 'removeSemester'])->name('semesters.remove');
Route::post('/admin/semesters/edit', [SemesterController::class, 'editSemester'])->name('semesters.edit');

// SCHOLARSHIP ROUTES
Route::get('/admin/scholarships', [ScholarshipController::class, 'index'])->name('scholarships.index');
Route::post('/admin/scholarships', [ScholarshipController::class, 'addScholarships'])->name('scholarships.add');
Route::post('/admin/scholarships/remove', [ScholarshipController::class, 'removeScholarships'])->name('scholarships.remove');
Route::post('/admin/scholarships/edit', [ScholarshipController::class, 'editScholarships'])->name('scholarships.edit');
Route::get('/admin/scholarships/{scUrl}/students', [ScholarshipController::class, 'scholarshipStudents'])->name('scholarships.students');

// COURSE ROUTES
Route::get('/admin/courses', [CourseController::class, 'index'])->name('courses.index');
Route::post('/admin/courses', [CourseController::class, 'addCourse'])->name('courses.add');
Route::post('/admin/courses/remove', [CourseController::class, 'removeCourse'])->name('courses.remove');
Route::post('/admin/courses/edit', [CourseController::class, 'editCourse'])->name('courses.edit');

// STUDENTS ROUTE
Route::get('/admin/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/admin/students/add-student', [StudentController::class, 'addStudent'])->name('students.add');
Route::post('/admin/students/save-student-data', [StudentController::class, 'saveStudent'])->name('students.save');
Route::get('/admin/students/{username}/edit', [StudentController::class, 'editStudent'])->name('students.edit');
Route::post('/admin/students/remove', [StudentController::class, 'removeStudent'])->name('students.remove');

// LECTURERS ROUTE
Route::get('/admin/lecturers', [StudentController::class, 'index'])->name('lecturers.index');
Route::get('/admin/lecturers/add-student', [StudentController::class, 'addStudent'])->name('lecturers.add');
Route::post('/admin/lecturers/save-student-data', [StudentController::class, 'saveStudent'])->name('lecturers.save');
Route::get('/admin/lecturers/{username}/edit', [StudentController::class, 'editStudent'])->name('lecturers.edit');
Route::post('/admin/lecturers/remove', [StudentController::class, 'removeStudent'])->name('lecturers.remove');
