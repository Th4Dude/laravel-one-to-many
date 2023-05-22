@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('message'))
    <h5 class="alert alert-danger ms-auto p-2" role="alert">{{ session('message') }}</h5>
    @endif
    <h1 class="fs-4 text-secondary my-4 text-center"> Dettaglio Progetto: {{ $project->title }}</h1>
    <h3><strong>Project Name:</strong> {{ $project->title }}</h3>
    <div>
        <img src="{{asset('storage/' . $project->image)}}" alt="{{ $project->title }}">
    </div>
    <p><strong>Description:</strong> {{ $project->description }}</p>
    <p><strong>type:</strong> {{ $project->type?->name ?: 'No selection' }}</p>
    <p><strong>Start date:</strong> {{ $project->start_date }}</p>
    <p><strong>End date:</strong> {{ $project->end_date }}</p>
    <p><strong>Slug:</strong> {{ $project->slug }}</p>
    <a href="{{Route('admin.projects.index') }}" class="btn btn-sm btn-success">Go back</a>
    <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-primary btn-sm">Make a change</a>
    <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#project-{{ $project->id }}">Delete</a>
</div>

<div class="modal fade" id="project-{{ $project->id }}" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                Are you sure you want to delete project Id <strong>{{ $project->id }}</strong>?
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>

  </div>

@endsection