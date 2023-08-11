@extends('layouts.layout', ['title' => 'Projects list', 'current' => 'projects-list'])

@section('main')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-10">
                    <h5 class="card-title">Projects List</h5>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('projects.create') }}" class="btn btn-primary">
                        Add a project
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <!-- Table to display projects -->
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tableList">
                    <!-- View projects here -->
                    @foreach ($projects as $key => $project)
                        <tr class="list-item">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $project->name }}</td>
                            <td>{{ $project->description }}</td>
                            <td>
                                <!-- Buttons to edit and delete the project -->
                                <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-primary">
                                    Update
                                </a>
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this project?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('script')
    <script>
        
    </script>
@stop