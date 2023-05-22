@extends('layouts.app')

@section('content')
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="d-flex align-items-center">
        <h2 class="fs-4 text-secondary my-4">Modifica Progetto</h2>
    </div>

    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Project Name</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $project->title) }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $project->description) }}">
        </div>
        <div class="mb-3">
            <label class="form-label" for="start_date">Start date</label>
            <input type="date" id="start_date" name="start_date" value="{{ old('start_date', $project->start_date) }}">

            <label class="form-label ms-3" for="end_date">End date</label>
            <input type="date" id="end_date" name="end_date" value="{{ old('end_date', $project->end_date) }}">
        </div>


    <div class="mb-3">
        <label for="type_id" class="form-label">type</label>
        <select class="form-select" name="type_id" id="type_id">
        <option value="">Select type</option>
        @foreach ($types as $type)
            <option value="{{ $type->id }}" {{ old('type_id', $project->type_id) == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
        @endforeach
    </div>





        <div class="mb-3">
            <label for="image" class="form-label">Add Image</label>
            <input class="form-control" type="file" id="formFile" name="image">
        </div> 
        
        <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
    </form>
</div>
@endsection 