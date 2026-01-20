<?php

namespace App\Http\Controllers;

use App\Models\DailyTask;
use App\Models\Employee;
use Illuminate\Http\Request;

class DailyTaskController extends Controller
{
   public function index(Request $request)
{
    // Fetch employees for dropdown
    $employees = Employee::orderBy('name')->get();

    // Query tasks
    $query = DailyTask::with('employee');

    if ($request->filled('employee_id')) {
        $query->where('employee_id', $request->employee_id);
    }

    if ($request->filled('status')) {
        $query->where('completion_status', $request->status);
    }

    $tasks = $query->latest()->paginate(10);

    return view('daily_tasks.index', compact('tasks', 'employees'));
}


    public function create()
    {
        $employees = Employee::all();
        return view('daily_tasks.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'description' => 'required|string|max:255',
            'date' => 'required|date',
            'status' => 'required|in:pending,completed',
        ]);

        DailyTask::create([
            'employee_id' => $request->employee_id,
            'description' => $request->description,
            'date' => $request->date,
            'status' => $request->status,
        ]);

        return redirect()->route('daily_tasks.index')->with('success', 'Task added successfully!');
    }
}
