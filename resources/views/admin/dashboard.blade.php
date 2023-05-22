@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{-- <h1>{{ __('Dashboard') }}</h1> --}}
                    <h4> {{ __('Welcome, You are logged in!') }}</h4>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="d-flex justify-content-between">
                        <div>
                            <a class="nav-link" href="{{Route('admin.projects.index') }}">{{ __('Your Projects') }}</a>
                        </div>
                        <div>
                            <a class="nav-link" href="{{ Route('admin.projects.create') }}">{{ __('Create New Project') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
