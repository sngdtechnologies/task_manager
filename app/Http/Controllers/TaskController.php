<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Carbon\Carbon;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $selectedProject = $request->project;

        if ($request->project != 'all' && $request->project != '') $tasks = Task::orderBy('priority')->where('project_id', $selectedProject)->get();
        else $tasks = Task::orderBy('priority')->get();

        $projects = Project::all();

        return view('tasks.index', compact('tasks', 'projects', 'selectedProject'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all();

        return view('tasks.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);

        if ($start_date->gt($end_date)) {
            return redirect()->route('tasks.create')->with('error', 'Start date is greater than End date.');
        }

        $task = Task::create($request->all());

        // Realigning priorities
        Task::where('priority', '>=', $task->priority)->where('id', '!=', $task->id)->increment('priority');

        return redirect()->route('tasks.index')->with('success', 'Successfully created task.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $projects = Project::all();

        return view('tasks.edit', compact('task', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);

        if ($start_date->gt($end_date)) {
            return redirect()->route('tasks.edit')->with('error', 'Start date is greater than End date.');
        }

        $task->update($request->all());

        // Realigning priorities
        Task::where('priority', '>=', $task->priority)->where('id', '!=', $task->id)->increment('priority');

        return redirect()->route('tasks.index')->with('success', 'Task successfully updated.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePriority(Request $request, Task $task, $priority, $afterTasksTask, $afterTasksPriority)
    {
        // Realigning priorities
        if ($priority < $afterTasksPriority) {
            $task->update(['priority' => $afterTasksPriority]);
            Task::where('priority', '>=', $afterTasksPriority)->where('id', '!=', $task->id)->increment('priority');
        } else {
            // TOTO:
        }   

        return ['success' => 'Task successfully updated.'];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        // Realigning priorities
        Task::where('priority', '>', $task->priority)->decrement('priority');

        return redirect()->route('tasks.index')->with('success', 'Task successfully deleted.');
    }
}
