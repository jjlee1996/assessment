<?php

use App\Http\Controllers\Question1Controller;
use App\Http\Controllers\Question2Controller;
use App\Http\Controllers\Question3Controller;
use App\Http\Controllers\Question4Controller;
use Illuminate\Support\Facades\Route;


Route::view('/question1', 'question1');
Route::get('/download/{memberType}/{fileType}', [Question1Controller::class, 'checkDownload']);

Route::view('/question2', 'question2');
Route::get('/analyze/{input}/{output}', [Question2Controller::class, 'analyzeMsg']);

Route::view('/question3', 'question3'); 
Route::post('/summary', [Question3Controller::class, 'insertData']);

Route::view('/question4', 'question4'); 
Route::get('/simulate', [Question4Controller::class, 'simulate']);

Route::view('/question5', 'question5'); 

