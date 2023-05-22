@extends('layouts.app')

@section('content')

    <div>

        <table class="table">

            <thead>

              <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Type</th>
                <th scope="col">Start Date</th>
                <th scope="col">End Date</th>
                <th scope="col">Slug</th>
                <th scope="col">Created at</th>
                <th scope="col">Updated at</th>
              </tr>

            </thead>

            @foreach ($projects as $project)

            <tbody>

                <tr>

                    <th scope="row">{{$project->id}}</th>
                    <td>{{$project->title}}</td>
                    <td>{{$project->description}}</td>
                    <td>{{ $project->type?->name ?: 'No selection' }}</td>
                    <td>{{$project->start_date}}</td>
                    <td>{{$project->end_date}}</td>
                    <td>{{$project->slug}}</td>
                    <td>{{$project->created_at}}</td>
                    <td>{{$project->updated_at}}</td>
                    <td><a href="{{route('admin.projects.show', $project->id)}}" class="btn btn-primary btn-sm">Details</a></td>

                </tr>

            </tbody>

            @endforeach

          </table>

    </div>
    
@endsection