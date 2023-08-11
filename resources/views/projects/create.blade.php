@extends('layouts.layout', ['title' => 'New project', 'current' => 'projects-list'])

@section('main')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">New Project</h5>
        </div>
        <div class="card-body">
            <!-- Form to create a new projects -->
            <form action="{{ route('projects.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" aria-describedby="nameHelp" value="{{ old('name') }}">
                    <small id="nameHelp" class="form-text text-muted">A name of project</small>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" rows="3" name="description" aria-describedby="descriptionHelp" value="{{ old('description') }}"></textarea>
                    <small id="descriptionHelp" class="form-text text-muted">A description of project</small>
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@stop