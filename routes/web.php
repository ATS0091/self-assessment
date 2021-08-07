<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
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


Route::redirect('/', '/login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/questions', [QuestionController::class, 'index'])->middleware('admin')->name('questions.index');
Route::get('/questions/create', [QuestionController::class, 'create'])->middleware('admin')->name('questions.create');
Route::post('/questions', [QuestionController::class, 'store'])->middleware('admin')->name('questions.store');
Route::get('/questions/{id}/edit', [QuestionController::class, 'edit'])->middleware('admin')->name('questions.edit');
Route::put('/questions/{id}', [QuestionController::class, 'update'])->middleware('admin')->name('questions.update');
Route::delete('/questions/{id}', [QuestionController::class, 'destroy'])->middleware('admin')->name('questions.destroy');


Route::get('/exam', [ExamController::class, 'index'])->middleware('user')->name('exam.instructions');
Route::post('/exam/start', [ExamController::class, 'startExam'])->middleware('user')->name('exam.start');
Route::post('/exam/start/{count}', [ExamController::class, 'getQuestion'])->middleware('user')->name('exam.getQuestion');
Route::get('/exam/result', [ExamController::class, 'getResult'])->middleware('user')->name('exam.getResult');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
