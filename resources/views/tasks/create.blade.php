@extends('layouts.layout', ['title' => 'New task', 'current' => 'tasks-list'])

@section('main')
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">New Task</h5>
        </div>
        <div class="card-body">
            <!-- Form to create a new tasks -->
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" aria-describedby="nameHelp" value="{{ old('name') }}">
                    <small id="nameHelp" class="form-text text-muted">A name of task</small>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="priority">Priority</label>
                    <input type="number" class="form-control @error('priority') is-invalid @enderror" name="priority" aria-describedby="priorityHelp" value="{{ old('priority') }}">
                    <small id="priorityHelp" class="form-text text-muted">A priority of task</small>
                    @error('priority')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="start_date">Start date</label>
                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" aria-describedby="startDateHelp" value="{{ old('start_date') }}">
                    <small id="startDateHelp" class="form-text text-muted">A start date of task</small>
                    @error('start_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="end_date">End date</label>
                    <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" aria-describedby="endDateHelp" value="{{ old('end_date') }}">
                    <small id="endDateHelp" class="form-text text-muted">A end date of task</small>
                    @error('end_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="projectSelect1">Project</label>
                    <select name="project_id" class="form-control" id="projectSelect1">
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" @if(old('project_id') == $project->id) selected @endif>{{ $project->name }}</option>
                        @endforeach
                    </select>
                    @error('project_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@stop