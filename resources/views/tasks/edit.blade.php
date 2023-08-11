@extends('layouts.layout', ['title' => 'Edit task', 'current' => 'tasks-list'])

@section('main')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Edit Task</h5>
        </div>
        <div class="card-body">
            <!-- Form to edit tasks -->
            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" aria-describedby="nameHelp" value="{{ $task->name }}">
                    <small id="nameHelp" class="form-text text-muted">A name of task</small>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="priority">Priority</label>
                    <input type="number" class="form-control @error('priority') is-invalid @enderror" name="priority" aria-describedby="priorityHelp" value="{{ $task->priority }}">
                    <small id="priorityHelp" class="form-text text-muted">A priority of task</small>
                    @error('priority')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="start_date">Start date</label>
                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" aria-describedby="startDateHelp" value="{{ $task->start_date }}">
                    <small id="startDateHelp" class="form-text text-muted">A start date of task</small>
                    @error('start_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="end_date">End date</label>
                    <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" aria-describedby="endDateHelp" value="{{ $task->end_date }}">
                    <small id="endDateHelp" class="form-text text-muted">A end date of task</small>
                    @error('end_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="projectSelect1">Project</label>
                    <select name="project_id" class="form-control" id="projectSelect1">
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" @if($project->id == $task->project_id) selected @endif>{{ $project->name }}</option>
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