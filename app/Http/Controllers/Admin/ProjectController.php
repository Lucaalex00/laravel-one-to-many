<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Type;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /* dd(Project::all()); */

        return view('admin.portfolio.index', ['projects' => Project::orderByDesc('id')->paginate(8),]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        $types = Type::all();
        return view('admin.portfolio.create', compact('project', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        /* dd($request->all()); */ //CHECK REQUEST'S VALUE

        /* dd(Auth()->user()); */ //CHECK WHO IS USER'S LOGGED IN

        /* Validate */
        $validated = $request->validated();

        //SLUG
        $slug = Str::slug($request->title, '-');
        $validated['slug'] = $slug;

        //COVER_IMAGE
        if ($request->has('cover_image')) {
            $image_path = Storage::put('uploads', $validated['cover_image']);  //IMG MAKER
            $validated['cover_image'] = $image_path;
        }

        //TYPE
        $validated['type_id'] = Auth::id();
        //CONNECT Type_id (Foreign Key) to id on User Table



        /* Create */
        Project::create($validated);


        /* Redirect */
        return to_route('admin.portfolio.index')->with('message', 'Project "' . $validated['title'] . '" Created');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {

        /* dd($project->all()); */
        return view('admin.portfolio.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();

        return view('admin.portfolio.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        /*  dd($request->all()); */

        /* Validate */

        //SLUG
        $validated = $request->validated();
        $slug = Str::slug($request->slug, '-');
        $validated['slug'] = $slug;


        //COVER_IMAGE
        if ($request->has('cover_image')) {

            if ($project->cover_image) {
                Storage::delete($project->cover_image);
            }
            $image_path = Storage::put('uploads', $validated['cover_image']);  //IMG MAKER
            /* dd($image_path); */
            $validated['cover_image'] = $image_path;
            /* dd($validated); */
        }

        /* Update */
        $project->update($validated);


        /* Redirect */
        return to_route('admin.portfolio.show', $project)->with('message', 'Project "' . $project->title . '" Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {


        if ($project->cover_image) {
            //REMOVE THE OLD IMAGE INSIDE ON LOCAL STORAGE
            Storage::delete($project->cover_image);
        };
        $project->delete();
        return to_route('admin.portfolio.index')->with('message', 'Project "' . $project->title . '" Deleted');
    }
}
