@extends('layouts.layout', ['title' => 'Tasks list', 'current' => 'tasks-list'])

@section('main')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-8">
                    <h5 class="card-title">Tasks List</h5>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col">
                            <!-- Dropdown Project -->
                            <select name="project" class="form-control" id="projectSelect2" onChange="updatePath(this, 'project')">
                                <option value="all" @if($selectedProject == 'all') selected @endif>All projects</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}" @if($project->id == $selectedProject) selected @endif>{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <!-- Button to add a task -->
                            <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                                Add a task
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <!-- Table to display tasks -->
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Priority</th>
                        <th>Project</th>
                        <th>Start date</th>
                        <th>End date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tableList">
                    <!-- View tasks here -->
                    @foreach ($tasks as $key => $task)
                        <tr class="list-item" data-id="{{ $task->id }}" data-priority="{{ $task->priority }}">
                            <td>
                                <div class="sprite">
                                    <svg data-v-58927c3f="" class="w-svg-sprite">
                                        <!---->
                                        <use xlink:href="#ci-draghandle-tw" fill="#8A8D99">
                                            <symbol id="ci-draghandle-tw" viewBox="0 0 512 512"><path fill-rule="evenodd" d="M176 96c26.51 0 48 21.49 48 48s-21.49 48-48 48-48-21.49-48-48 21.49-48 48-48zm0 160c26.51 0 48 21.49 48 48s-21.49 48-48 48-48-21.49-48-48 21.49-48 48-48zm0 160c26.51 0 48 21.49 48 48s-21.49 48-48 48-48-21.49-48-48 21.49-48 48-48zM304 0c26.51 0 48 21.49 48 48s-21.49 48-48 48-48-21.49-48-48 21.49-48 48-48zm0 160c26.51 0 48 21.49 48 48s-21.49 48-48 48-48-21.49-48-48 21.49-48 48-48zm0 160c26.51 0 48 21.49 48 48s-21.49 48-48 48-48-21.49-48-48 21.49-48 48-48z"></path></symbol>
                                        </use>
                                    </svg>
                                </div>
                            </td>
                            <td>{{ $task->name }}</td>
                            <td>{{ $task->priority }}</td>
                            <td>{{ $task->project->name }}</td>
                            <td>{{ $task->start_date->format('Y-m-d'); }}</td>
                            <td>{{ $task->end_date->format('Y-m-d'); }}</td>
                            <td>
                                <!-- Buttons to edit and delete the task -->
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-primary">
                                    Update
                                </a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
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
        window.addEventListener('load', function() {
            // Retrieve all list items
            const listItems = document.querySelectorAll('.list-item');
            var dataDraggable = { id: null, priority: null };
            var dataAfterElement = { id: null, priority: null };

            // Enable drag-and-drop for each list item
            listItems.forEach(item => {
                item.draggable = true;

                // Drag-and-drop event handling
                item.addEventListener('dragstart', event => {
                    event.dataTransfer.setData('text/plain', event.target.id);
                    event.target.classList.add('dragging');
                });

                item.addEventListener('dragend', event => {
                    event.target.classList.remove('dragging');
                    fetchToChangePriority(dataDraggable, dataAfterElement);
                });
            });

            // Handling the List Item Move Event
            const tableList = document.getElementById('tableList');
            tableList.addEventListener('dragover', event => {
                event.preventDefault();
                const afterElement = getDragAfterElement(tableList, event.clientY);
                const draggable = document.querySelector('.dragging');

                if (afterElement == null) {
                    tableList.appendChild(draggable);
                } else {
                    dataDraggable.id = draggable.getAttribute('data-id');
                    dataAfterElement.id = afterElement.getAttribute('data-id');
                    dataDraggable.priority = draggable.getAttribute('data-priority');
                    dataAfterElement.priority = afterElement.getAttribute('data-priority');
                    tableList.insertBefore(draggable, afterElement);
                }
            });

            // Function to get the item after which to move the dragged item
            const getDragAfterElement = (container, y) => {
                const draggableElements = [...container.querySelectorAll('.list-item:not(.dragging)')];
                return draggableElements.reduce((closest, child) => {
                    const box = child.getBoundingClientRect();
                    const offset = y - box.top - box.height / 2;
                    if (offset < 0 && offset > closest.offset) {
                        return { offset: offset, element: child };
                    } else {
                        return closest;
                    }
                }, { offset: Number.NEGATIVE_INFINITY }).element;
            }

            const fetchToChangePriority = (task, afterTrask) => {
                $(document).ready(function(){
                    $.ajax({
                        method: "POST",
                        url: "/tasks/" + task.id + "/priority/" + task.priority + "/afterTasksId/" + afterTrask.id + "/afterTaskPriority/" + afterTrask.priority,
                        data: {},
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    })
                    .done(function(data) {
                        console.log('msg', data.success);
                    })
                    .fail(function(error){
                        alert("The query ended in failure. Info : " + JSON.stringify(error));
                    });
                });
            }
        });
    </script>
@stop