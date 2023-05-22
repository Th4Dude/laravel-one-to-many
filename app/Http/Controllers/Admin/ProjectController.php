<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types=Type::all();
        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {

        $data = $request->validated();

        $new_project = new Project();
        $new_project->fill($data);
        $new_project->slug = Str::slug($data['title']);

        if(isset ($data['image'])){
            $new_project->image = Storage::put('uploads', $data['image']);
        }
        $new_project->save();

        return to_route('admin.projects.show', $new_project->id)->with('message', 'Progetto creato');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project )
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types=Type::all();
        return view('admin.projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
{
    $data = $request->validated();

    if ($request->hasFile('image')) {
        $newImage = $request->file('image');

        // Elimina l'immagine precedente se presente
        if ($project->image) {
            Storage::delete($project->image);
        }

        // Carica la nuova immagine
        $newImageName = uniqid() . '_' . $newImage->getClientOriginalName();
        $newImagePath = $newImage->storeAs('uploads', $newImageName);
        
        $project->image = $newImagePath;
    }

    $project->update($data);
    $project->slug = Str::slug($data['title']);
    $project->save();

    return redirect()->route('admin.projects.index')->with('message', 'Modifica avvenuta con successo');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $old_id = $project->id;
        $project->delete();

        return redirect()->route('admin.projects.index')->with('message', "Progetto $old_id cancellato con successo");
    }
}
