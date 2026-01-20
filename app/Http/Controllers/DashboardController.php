<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Financial;
use App\Models\NotificationRecipient;
use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with the summary information.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalEmployees = Employee::count();
        $activeEmployees = Employee::where('status', 1)->count();
        $inactiveEmployees = Employee::where('status', 0)->count();
        
        $today = date('Y-m-d');

$todayEmployees = Employee::where('status', 1)
    ->with(['attendances' => function($query) use ($today) {
        $query->where('date', $today);
    }])
    ->orderBy('name')
    ->paginate(10) // ✅ enables pagination
    ->through(function ($employee) {
        // map-like transformation but works with paginator
        $employee->attendance = $employee->attendances->first();
        return $employee;
    });
        
        // Get recent notifications
        $recentNotifications = NotificationRecipient::with('notification')
            ->where('is_read', false)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        // Get upcoming reminders
        $upcomingRemindersList = Reminder::where('is_completed', false)
            ->whereDate('due_date', '>=', Carbon::today())
            ->whereDate('due_date', '<=', Carbon::tomorrow())
            ->orderBy('due_date')
            ->take(5)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalEmployees',
            'activeEmployees',
            'inactiveEmployees',
            'todayEmployees',
            'recentNotifications',
            'upcomingRemindersList'
        ));
    }

    /**
     * Store a new financial entry from dashboard.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeFinancial(Request $request)
    {
        try {
            $validated = $request->validate([
                'date' => 'required|date',
                'type' => 'required|in:Income,Expense',
                'category' => 'required|string|max:100',
                'description' => 'nullable|string',
                'amount' => 'required|numeric|min:0',
                'payment_mode' => 'nullable|string|max:50',
                'status' => 'required|in:Paid,Pending',
                'remarks' => 'nullable|string',
            ]);

            Financial::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Financial entry created successfully!'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error creating financial entry from dashboard: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the financial entry.'
            ], 500);
        }
    }
}
