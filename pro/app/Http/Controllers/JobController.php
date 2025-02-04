<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Mail\JobPosted;

class JobController extends Controller
{
    public function index()
    {

        $jobs = Job::with('employer')->latest()->cursorPaginate(3);

        return view('jobs.index', [
            'jobs' => $jobs
        ]);
    }

    public function create()
    {
        if (Auth::guest()) {
            return redirect()->route('login');
        }

        // Route::get('posts/{post}');
        return view('jobs.create');
    }

    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    public function store()
    {
        //dd(request('title'));

        //validation...


        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']

        ]);

        $job = Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1
        ]);

        Mail::to($job->employer->user)->send(
            new JobPosted($job)
        );
        return redirect('/jobs');
    }

    public function edit(Job $job)
    {

        //    if(Auth::user()->cannot('edit-job',$job)){
        //             dd('Failure');
        //    }

        // if (Auth::guest()) {
        //     return redirect()->route('login');

        // }

        
        
        // Gate::authorize('edit-job', $job);

        return view('jobs.edit', ['job' => $job]);
    }

    


    public function update(Job $job)
    {
        Gate::authorize('edit-job', $job);

        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
    
        ]);
    
        // authorite (On hold...)
    
        // update the job
    
        // $job=Job::findOrFail($id);
        // $job->title = request('title');
        // $job->salary = request('salary');
        // $job->save();
    
    
        $job->update([
            'title' => request('title'),
            'salary' => request('salary')
        ]);
    
        //and persist
    
    
        // redrict to the job page
        return redirect('/jobs/' . $job->id);
    }

    public function destroy(Job $job)
    {
        // authorite (On hold...)
        
        Gate::authorize('edit-job', $job);

        // delete the job
        $job->delete();  //Job::findOrFail($id) -> delete();


        // redrict
        return redirect('/jobs');
    }
}
