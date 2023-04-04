<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JobsController extends Controller
{
    // ------------------------------ get & show all jobs
    public function index()
    {
        return view('jobs.index', [
            'jobs' => Job::latest()->filter(request(['tag', 'search']))->simplePaginate(6)
        ]);
    }

    // ------------------------------
    public function create()
    {
        return view('jobs.create');
    }

    // ------------------------------ store job data
    public function store(Request $request)
    {
        $request->validate([
            'company' => ['required', Rule::unique('jobs', 'company')],
            'title' => 'required',
            'location' => 'required',
            'email' => ['required', 'email', Rule::unique('jobs', 'email')],
            'website' => ['required', 'url'],
            'tags' => 'required',
            'description' => 'required'
        ]);
        $jobs = new Job(); // ! create an instance from Job model

        // ! get information 
        $jobs->user_id = strip_tags(auth()->user()->id);
        $jobs->title = strip_tags($request->input('title'));
        // ? upload file
        $jobs->logo = strip_tags($request->hasFile('logo') ? $request->file('logo')->store('logos', 'public') : '');
        $jobs->tags = strip_tags($request->input('tags'));
        $jobs->company = strip_tags($request->input('company'));
        $jobs->location = strip_tags($request->input('location'));
        $jobs->email = strip_tags($request->input('email'));
        $jobs->website = strip_tags($request->input('website'));
        $jobs->description = strip_tags($request->input('description'));

        // ! save information into db
        $jobs->save();

        // ! upload logo 
        // if ($request->hasFile('logo')) {
        //     $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        // }

        // ! add user_id to the specific job
        // $formFields['user_id'] = auth()->user()->id;

        // ! store to db
        // Job::create($formFields);

        // ! redirect to home page
        return redirect('/')->with('message', 'Job created successfully');
    }

    // ------------------------------ get & show single job
    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    // ------------------------------ show edit form
    public function edit(Job $job)
    {
        // dd($job->title);
        return view('jobs.edit', [
            'job' => $job
        ]);
    }

    // ------------------------------
    public function update(Request $request, Job $job)
    {
        // * Make sure the user logged in
        if ($job->user_id !== auth()->user()->id) {
            abort('404', 'Unauthorized Action');
        }

        $request->validate([
            'company' => 'required',
            'title' => 'required',
            'location' => 'required',
            'email' => ['required', 'email'],
            'website' => ['required', 'url'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        // ! update information 
        $job->user_id = strip_tags(auth()->user()->id);
        $job->title = strip_tags($request->input('title'));
        $job->logo = strip_tags($request->hasFile('logo') ? $request->file('logo')->store('logos', 'public') : $job->logo);
        $job->tags = strip_tags($request->input('tags'));
        $job->company = strip_tags($request->input('company'));
        $job->location = strip_tags($request->input('location'));
        $job->email = strip_tags($request->input('email'));
        $job->website = strip_tags($request->input('website'));
        $job->description = strip_tags($request->input('description'));

        // ! update infos
        $job->update();

        // ! redirect to show page
        return redirect(route('jobs.show', $job->id))->with('message', 'Job updated successfully');
    }
    // ------------------------------ manage jobs
    public function manageJobs()
    {
        return view("jobs.manage", [
            'jobs' => auth()->user()->Jobs
        ]);
    }


    // ------------------------------ destroy job
    public function destroy(Job $job)
    {
        // * Make sure the user logged in
        if ($job->user_id !== auth()->user()->id) {
            abort('404', 'Unauthorized Action');
        }

        $job->delete();
        return redirect(route('jobs.index'))->with('message', 'Job deleted successfully');
    }
}
