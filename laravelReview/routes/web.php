<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->orderby('id')->cursorPaginate(3);
    return view('jobs.index', [
        'jobs' => $jobs 
    ]);
});

//Create
Route::post('/jobs', function () {
    request()->validate([
        'title' => ['required' , 'min:3'],
        'salary' => ['required']
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => '1'
    ]);

    return redirect('/jobs');
});

Route::get('/jobs/create', function() {
    return view('jobs.create');
});

//show
Route::get('/jobs/{id}', function ($id) {
    
    $job = job::find($id);
    
    return view('jobs.show', ['job' => $job]);
});

//edit
Route::get('/jobs/{id}/edit', function($id) {

    $job = job::find($id);

    return view('jobs.edit', ['job' => $job]);
});

//update
Route::patch('/jobs/{id}', function ($id) {
    
    request()->validate([
        'title' => ['required' , 'min:3'],
        'salary' => ['required']
    ]);

    $job = Job::findOrFail($id);

    $job->title = request('title');
    $job->salary = request('salary');
    $job->save();

    return redirect('/jobs/'.$id);
});

//remove
Route::delete('/jobs/{id}', function ($id) {
    
    Job::findOrFail($id)->delete();
    
    return redirect('/jobs');
});

Route::get('/contact', function () {
    return view('contact');
});