<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\BankDetailController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTaskController;
use App\Http\Controllers\ProjectTeamController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FinancialController;
use App\Http\Controllers\SeminarController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentFeedbackController;
use App\Http\Controllers\StudentEvaluationController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\PaymentScheduleController;
use App\Http\Controllers\Employee\AuthController as EmployeeAuthController;
use App\Http\Controllers\Employee\DashboardController as EmployeeDashboardController;
use App\Http\Controllers\Employee\DailyTaskController as EmployeeDailyTaskController;
use App\Http\Controllers\EmployeeTaskController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AdminSettingController;
use App\Http\Controllers\DailyTaskController;
use App\Http\Controllers\Client\RegisterController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Client\ClientAuthController;

// 🔧 Clear all Laravel caches
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return "✅ All caches cleared!";
});

// 💼 Daily Task Routes
Route::prefix('daily-tasks')->name('daily_tasks.')->group(function () {
    Route::get('/', [DailyTaskController::class, 'index'])->name('index');
    Route::get('/create', [DailyTaskController::class, 'create'])->name('create');
    Route::post('/', [DailyTaskController::class, 'store'])->name('store');
    Route::get('/{dailyTask}/edit', [DailyTaskController::class, 'edit'])->name('edit');
    Route::put('/{dailyTask}', [DailyTaskController::class, 'update'])->name('update');
    Route::delete('/{dailyTask}', [DailyTaskController::class, 'destroy'])->name('destroy');
});

// 🔐 Admin Auth
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile');
        Route::post('/profile/update', [AdminProfileController::class, 'update'])->name('profile.update');

        Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings');
        Route::post('/settings/update', [AdminSettingController::class, 'update'])->name('settings.update');
    });
});

// 🛡️ Admin Middleware-Protected Routes
Route::group(['prefix' => 'admin', 'middleware' => 'admin.auth'], function () {
    Route::get('/client/register', function () {
        return view('client.register');
    })->name('client.register');

    // ✅ CLIENT MANAGEMENT ROUTES
    Route::get('clients', [ClientController::class, 'index'])->name('admin.clients.index');
    Route::get('clients/create', [ClientController::class, 'create'])->name('admin.clients.create');
    Route::post('clients', [ClientController::class, 'store'])->name('admin.clients.store');
    Route::get('clients/{client}', [ClientController::class, 'show'])->name('admin.clients.show');
    Route::get('clients/{client}/edit', [ClientController::class, 'edit'])->name('admin.clients.edit');
    Route::put('clients/{client}', [ClientController::class, 'update'])->name('admin.clients.update');
    Route::delete('clients/{client}', [ClientController::class, 'destroy'])->name('admin.clients.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/dashboard/financial', [DashboardController::class, 'storeFinancial'])->name('dashboard.financial.store');

    Route::resource('departments', DepartmentController::class);
    Route::resource('employees', EmployeeController::class);
    Route::get('employees/{employee}/attendance-details', [EmployeeController::class, 'getAttendanceDetails'])->name('employees.attendance-details');

    Route::get('attendances/dashboard', [AttendanceController::class, 'dashboard'])->name('attendances.dashboard');
    Route::get('attendances/upload-page', [AttendanceController::class, 'uploadPage'])->name('attendances.upload.page');
    Route::post('attendances/upload', [AttendanceController::class, 'uploadExcel'])->name('attendances.upload');
    Route::get('attendances/preview', [AttendanceController::class, 'previewUploaded'])->name('attendances.preview');
    Route::get('attendances/debug-excel', [AttendanceController::class, 'debugExcelFile'])->name('attendances.debug.excel');
    Route::post('attendance/mark', [AttendanceController::class, 'markAttendance'])->name('attendances.mark');
    Route::post('attendance/comment', [AttendanceController::class, 'saveComment'])->name('attendances.comment');
    Route::resource('attendances', AttendanceController::class);

    Route::resource('leaves', LeaveController::class)->except(['edit', 'update']);
    Route::resource('salaries', SalaryController::class);
    Route::resource('bank-details', BankDetailController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('tasks', ProjectTaskController::class);
    Route::get('/projects/{project}/modules', [ProjectTaskController::class, 'getModules']);

    Route::resource('project-team', ProjectTeamController::class);

    Route::resource('letters', LetterController::class);
    Route::post('letters/{letter}/send', [LetterController::class, 'send'])->name('letters.send');
    Route::get('letters/{letter}/download', [LetterController::class, 'download'])->name('letters.download');

    Route::resource('notifications', NotificationController::class)->except(['edit', 'update']);
    Route::resource('assets', AssetController::class);
    Route::resource('documents', DocumentController::class);
    Route::get('documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');

    Route::resource('financials', FinancialController::class);
    Route::resource('seminars', SeminarController::class);
    Route::resource('students', StudentController::class);
    Route::resource('feedback', StudentFeedbackController::class);
    Route::resource('evaluations', StudentEvaluationController::class);

    Route::get('emails', [EmailController::class, 'index'])->name('emails.index');
    Route::get('emails/send', [EmailController::class, 'showSendForm'])->name('emails.send.form');
    Route::post('emails/send', [EmailController::class, 'send'])->name('emails.send');
    Route::get('emails/compose', fn() => redirect()->route('emails.send.form'))->name('emails.compose');

    Route::resource('reminders', ReminderController::class);
    Route::patch('/reminders/{reminder}/mark-completed', [ReminderController::class, 'markAsCompleted'])->name('reminders.mark-completed');
    Route::get('/reminders/process-now', function() {
        Artisan::call('reminders:process');
        return redirect()->back()->with('success', 'Reminders processed successfully!');
    })->name('reminders.process-now');

    Route::resource('payment-schedules', PaymentScheduleController::class);
    Route::patch('/payment-schedules/{paymentSchedule}/mark-paid', [PaymentScheduleController::class, 'markAsPaid'])->name('payment-schedules.mark-paid');

    Route::get('employee-tasks', [EmployeeTaskController::class, 'index'])->name('employee-tasks.index');
    Route::get('employee-tasks/{employee}', [EmployeeTaskController::class, 'show'])->name('employee-tasks.show');
    Route::get('employee-tasks/{employee}/tasks', [EmployeeTaskController::class, 'tasks'])->name('employee-tasks.tasks');
    Route::get('/debug-excel', [AttendanceController::class, 'debugExcelFile']);
});

// 👩‍💼 Employee Routes
Route::prefix('employee')->group(function () {
    Route::get('login', [EmployeeAuthController::class, 'showLoginForm'])->name('employee.login');
    Route::post('login', [EmployeeAuthController::class, 'login'])->name('employee.login.post');

    Route::middleware(['employee.auth'])->group(function () {
        Route::get('dashboard', [EmployeeDashboardController::class, 'index'])->name('employee.dashboard');
        Route::get('profile', [EmployeeDashboardController::class, 'profile'])->name('employee.profile');
        Route::get('attendance', [EmployeeDashboardController::class, 'attendance'])->name('employee.attendance');
        Route::get('leaves', [EmployeeDashboardController::class, 'leaves'])->name('employee.leaves');
        Route::get('salary', [EmployeeDashboardController::class, 'salary'])->name('employee.salary');

        Route::resource('daily-tasks', EmployeeDailyTaskController::class)->names('employee.daily_tasks');

        Route::get('notifications', [EmployeeDashboardController::class, 'getNotifications'])->name('employee.notifications');
        Route::post('notifications/{id}/read', [EmployeeDashboardController::class, 'markAsRead'])->name('employee.notifications.read');
        Route::post('notifications/read-all', [EmployeeDashboardController::class, 'markAllAsRead'])->name('employee.notifications.read-all');

        Route::get('reminders', [EmployeeDashboardController::class, 'getReminders'])->name('employee.reminders');
        Route::post('reminders/{id}/read', [EmployeeDashboardController::class, 'markReminderAsRead'])->name('employee.reminders.read');
        Route::post('reminders/read-all', [EmployeeDashboardController::class, 'markAllRemindersAsRead'])->name('employee.reminders.read-all');

        Route::get('notifications-reminders', [EmployeeDashboardController::class, 'notificationsAndReminders'])->name('employee.notifications-reminders');
        Route::get('project-tasks', [EmployeeDashboardController::class, 'projectTasks'])->name('employee.project-tasks');
        Route::post('project-tasks/{id}/update-status', [EmployeeDashboardController::class, 'updateTaskStatus'])->name('employee.project-tasks.update-status');

        Route::post('logout', [EmployeeAuthController::class, 'logout'])->name('employee.logout');
    });
});

Route::post('/employee/profile/update', [DashboardController::class, 'update'])->name('employee.profile.update');

// 🔁 Redirect /admin to dashboard
Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});

Route::get('departments/ajax', [DepartmentController::class, 'ajax'])->name('departments.ajax');
Route::get('employees/ajax', [EmployeeController::class, 'ajax'])->name('employees.ajax');

// Route::prefix('client')->name('client.')->group(function () {
//     Route::get('/login', [ClientAuthController::class, 'showLoginForm'])->name('login');
//     Route::post('/login', [ClientAuthController::class, 'login'])->name('login.submit');
//     Route::post('/logout', [ClientAuthController::class, 'logout'])->name('logout');

//     Route::middleware('auth:client')->group(function () {
//         Route::get('/dashboard', [ClientAuthController::class, 'dashboard'])->name('dashboard');

//         // Optional stub routes
//         Route::get('/projects', fn () => view('client.projects'))->name('projects');
//         Route::get('/payments', fn () => view('client.payments'))->name('payments');
//         Route::get('/maintenance', fn () => view('client.maintenance'))->name('maintenance');
//         Route::get('/feedback', fn () => view('client.feedback'))->name('feedback');
//         Route::get('/reports', fn () => view('client.reports'))->name('reports');
//     });
// });

