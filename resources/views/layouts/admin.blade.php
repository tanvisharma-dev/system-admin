<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Employee Management') }} - @yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <!-- DataTables CSS -->
    {{-- <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet"> --}}
     <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.css">
     <!-- Select 1 CSS -->
     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <style>
        
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
        }
        
        .sidebar {
    height: 100vh;
    width: 280px;
    position: fixed;
    top: 0;
    left: 0;
    background: linear-gradient(180deg, #3f66a7ff, #263d70ff);
    color: #f1f5f9;
    overflow-y: auto;
    box-shadow: 4px 0 15px rgba(0, 0, 0, 0.25);
    transition: all 0.3s ease;
    z-index: 1000;
    padding: 20px 0;
    font-family: "Segoe UI", sans-serif;
}

/* Smooth scrollbar */
.sidebar::-webkit-scrollbar {
    width: 8px;
}
.sidebar::-webkit-scrollbar-track {
    background: transparent;
}
.sidebar::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, rgba(52,144,220,0.7), rgba(56,189,248,0.4));
    border-radius: 10px;
    transition: background 0.3s ease;
}
.sidebar::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(180deg, rgba(52,144,220,1), rgba(56,189,248,0.8));
}

        
        .sidebar-logo {
            padding: 1rem;
            display: flex;
            justify-content: center;
            align-items: center;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 0.5rem;
        }
        
        .sidebar-logo img {
            max-width: 85%;
            height: auto;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
        }
        
        .sidebar .nav-item {
            margin: 4px 8px;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.7);
            padding: 0.75rem 1rem;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        
        .sidebar .nav-link:hover {
            color: #fff;
            background-color: rgba(52, 144, 220, 0.2);
            transform: translateX(4px);
        }
        
        .sidebar .nav-link.active {
            color: #fff;
            background-color: #3490dc;
            box-shadow: 0 4px 8px rgba(52, 144, 220, 0.3);
        }
        
        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }
        
        .sidebar-heading {
            font-size: 0.75rem;
            letter-spacing: 1px;
            opacity: 0.6;
            font-weight: 600;
            text-transform: uppercase;
            margin-top: 1.5rem;
            margin-bottom: 0.5rem;
        }
        
        .main-content {
            margin-left: 280px;
            padding: 20px;
            transition: all 0.3s ease;
        }
        
        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            border: none;
        }
        
        .card-header {
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            font-weight: 600;
            padding: 1rem 1.5rem;
        }
        
        .btn-primary {
            background-color: #3490dc;
            border-color: #3490dc;
            border-radius: 6px;
            padding: 0.5rem 1.25rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        .btn-primary:hover {
            background-color: #2779bd;
            border-color: #2779bd;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(39, 121, 189, 0.3);
        }
        
        /* Sidebar dropdown styles */
        .sidebar .dropdown-menu {
            background-color: #2d3748;
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            margin-left: 1rem;
            margin-top: 0.5rem;
            display: none; /* Initially hidden */
            position: relative;
        }
        
        .sidebar .dropdown-item {
            color: rgba(255, 255, 255, 0.7);
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            border-radius: 6px;
            margin: 2px 8px;
            transition: all 0.2s ease;
        }
        
        .sidebar .dropdown-item:hover {
            color: #fff;
            background-color: rgba(52, 144, 220, 0.2);
            transform: translateX(4px);
        }
        
        .sidebar .dropdown-item.active {
            color: #fff;
            background-color: #3490dc;
        }
        
        .sidebar .dropdown-item i {
            margin-right: 8px;
            width: 16px;
            text-align: center;
        }
        
        .sidebar .dropdown-divider {
            border-color: rgba(255, 255, 255, 0.1);
            margin: 0.25rem 8px;
        }

        .sidebar-heading {
            text-align: center;
            font-size: 1rem;
            font-weight: 700;
            text-transform: uppercase;
            color: #000000ff; /* Bright cyan accent */
            margin: 20px 0;
            position: relative;
        }

        /* Decorative underline */
        .sidebar-heading span {
            position: relative;
            display: inline-block;
            padding-bottom: 5px;
        }

        .sidebar-heading span::after {
            content: "";
            position: absolute;
            left: 50%;
            bottom: -5px;
            transform: translateX(-50%);
            width: 60%;
            height: 3px;
            background: linear-gradient(90deg, #000000ff, #000000ff, #000000ff);
            border-radius: 2px;
        }

        .select2-selection.select2-selection--single {
            height: 37px;
            border: 1.5px solid #c4c4c4;
            padding: 4px 12px; /* adjust top/bottom and left/right */
            box-sizing: border-box;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 34px !important;
            width: 31px !important;
        }



    </style>

    @yield('styles')
</head>
<body>
    <div class="d-flex">
        
        <div class="sidebar">
    <!-- Logo -->
   <div class="sidebar-logo mb-4">
        <img src="{{ asset('images/Mindcode.svg') }}" 
             alt="Employee Management Logo" 
             class="img-fluid mb-3">
    </div>

<ul class="nav flex-column">

 <!-- Heading -->
  <div class="sidebar-heading px-3 mt-4 mb-4">
  <span>EMPLOYEE MANAGEMENT</span>
</div>



  <!-- Dashboard -->
  <li class="nav-item">
    <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" 
       href="{{ url('admin/dashboard') }}">
      <i class="fa fa-home"></i> Dashboard
    </a>
  </li>

 

  <!-- Departments -->
  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('departments.*') ? 'active' : '' }}" 
       href="{{ route('departments.index') }}">
      <i class="fas fa-building"></i> Departments
    </a>
  </li>

  <!-- Employees -->
  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}" 
       href="{{ route('employees.index') }}">
      <i class="fas fa-users"></i> Employees
    </a>
  </li>

  <!-- Attendance Dropdown -->
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle {{ request()->routeIs('attendances.*') ? 'active' : '' }}"
       href="#" id="attendanceDropdown"
       role="button" data-bs-toggle="dropdown" data-bs-display="static"
       aria-expanded="false">
      <i class="fas fa-calendar-check"></i> Attendance
    </a>
    <ul class="dropdown-menu" aria-labelledby="attendanceDropdown">
      <li><a class="dropdown-item {{ request()->routeIs('attendances.index') ? 'active' : '' }}" href="{{ route('attendances.index') }}"><i class="fas fa-list"></i> Employee Attendance</a></li>
      <li><a class="dropdown-item {{ request()->routeIs('attendances.upload.page') ? 'active' : '' }}" href="{{ route('attendances.upload.page') }}"><i class="fas fa-upload"></i> Upload Attendance</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item {{ request()->routeIs('attendances.dashboard') ? 'active' : '' }}" href="{{ route('attendances.dashboard') }}"><i class="fas fa-calendar-day"></i> Today's Attendance</a></li>
    </ul>
  </li>

  <!-- Master Dropdown -->
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle {{ request()->routeIs('leaves.*') || request()->is('salaries*') || request()->is('bank-details*') ? 'active' : '' }}"
       href="#" id="masterDropdown"
       role="button" data-bs-toggle="dropdown" data-bs-display="static"
       aria-expanded="false">
      <i class="fas fa-cogs"></i> Master
    </a>
    <ul class="dropdown-menu" aria-labelledby="masterDropdown">
      <li><a class="dropdown-item {{ request()->routeIs('leaves.*') ? 'active' : '' }}" href="{{ route('leaves.index') }}"><i class="fas fa-calendar-alt"></i> Leave Management</a></li>
      <li><a class="dropdown-item {{ request()->is('salaries*') ? 'active' : '' }}" href="{{ route('salaries.index') }}"><i class="fas fa-money-bill-alt"></i> Salary Management</a></li>
      <li><a class="dropdown-item {{ request()->is('bank-details*') ? 'active' : '' }}" href="{{ route('bank-details.index') }}"><i class="fas fa-university"></i> Bank Details</a></li>
    </ul>
  </li>

  <!-- Project Management Dropdown -->
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle {{ request()->is('employee-tasks*') || request()->is('projects*') || request()->is('tasks*') || request()->is('project-team*') || request()->is('payment-schedules*') ? 'active' : '' }}"
       href="#" id="projectManagementDropdown"
       role="button" data-bs-toggle="dropdown" data-bs-display="static"
       aria-expanded="false">
      <i class="fas fa-project-diagram"></i> Project Management
    </a>
    <ul class="dropdown-menu" aria-labelledby="projectManagementDropdown">
<li>
  <a class="dropdown-item {{ request()->is('daily-tasks*') ? 'active' : '' }}" 
     href="{{ route('daily_tasks.index') }}">
     <i class="fas fa-user-clock"></i> Employee Daily Tasks
  </a>
</li>
      <li><a class="dropdown-item {{ request()->is('projects*') ? 'active' : '' }}" href="{{ route('projects.index') }}"><i class="fas fa-project-diagram"></i> Projects</a></li>
      <li><a class="dropdown-item {{ request()->is('tasks*') ? 'active' : '' }}" href="{{ route('tasks.index') }}"><i class="fas fa-tasks"></i> Tasks</a></li>
      <li><a class="dropdown-item {{ request()->is('project-team*') ? 'active' : '' }}" href="{{ route('project-team.index') }}"><i class="fas fa-user-friends"></i> Project Team</a></li>
      <li><a class="dropdown-item {{ request()->is('payment-schedules*') ? 'active' : '' }}" href="{{ route('payment-schedules.index') }}"><i class="fas fa-money-bill-wave"></i> Decide Payments</a></li>
    </ul>
  </li>

  <!-- Communication Dropdown -->
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle {{ request()->is('letters*') || request()->is('notifications*') || request()->is('reminders*') || request()->is('emails*') ? 'active' : '' }}"
       href="#" id="communicationDropdown"
       role="button" data-bs-toggle="dropdown" data-bs-display="static"
       aria-expanded="false">
      <i class="fas fa-comments"></i> Communication
    </a>
    <ul class="dropdown-menu" aria-labelledby="communicationDropdown">
      <li><a class="dropdown-item {{ request()->is('letters*') ? 'active' : '' }}" href="{{ route('letters.index') }}"><i class="fas fa-envelope"></i> Letters</a></li>
      <li><a class="dropdown-item {{ request()->is('notifications*') ? 'active' : '' }}" href="{{ route('notifications.index') }}"><i class="fas fa-bell"></i> Notifications</a></li>
      <li><a class="dropdown-item {{ request()->is('reminders*') ? 'active' : '' }}" href="{{ route('reminders.index') }}"><i class="fas fa-calendar-check"></i> Reminders</a></li>
      <li><a class="dropdown-item {{ request()->is('emails*') ? 'active' : '' }}" href="{{ route('emails.send.form') }}"><i class="fas fa-paper-plane"></i> Send Email</a></li>
    </ul>
  </li>

 <!-- Resources Dropdown -->
<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle {{ request()->is('documents*') || request()->is('assets*') || request()->is('financials*') || request()->is('client/register') ? 'active' : '' }}"
     href="#" id="resourcesDropdown"
     role="button" data-bs-toggle="dropdown" data-bs-display="static"
     aria-expanded="false">
    <i class="fas fa-archive"></i> Resources
  </a>
  <ul class="dropdown-menu" aria-labelledby="resourcesDropdown">
    <li>
      <a class="dropdown-item {{ request()->is('documents*') ? 'active' : '' }}" href="{{ route('documents.index') }}">
        <i class="fas fa-file-alt"></i> Documents
      </a>
    </li>
    <li>
      <a class="dropdown-item {{ request()->is('assets*') ? 'active' : '' }}" href="{{ route('assets.index') }}">
        <i class="fas fa-laptop"></i> Assets
      </a>
    </li>
    <li>
      <a class="dropdown-item {{ request()->is('financials*') ? 'active' : '' }}" href="{{ route('financials.index') }}">
        <i class="fas fa-money-bill-wave"></i> Company Financials
      </a>
    </li>
    <li>
  <a class="dropdown-item {{ request()->is('admin/clients*') ? 'active' : '' }}" href="{{ route('admin.clients.index') }}">
    <i class="fas fa-user-plus"></i> Our Clients
  </a>
</li>

  </ul>
</li>

  <!-- Students Program Dropdown -->
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle {{ request()->is('seminars*') || request()->is('students*') || request()->is('feedback*') || request()->is('evaluations*') ? 'active' : '' }}"
       href="#" id="studentsProgramDropdown"
       role="button" data-bs-toggle="dropdown" data-bs-display="static"
       aria-expanded="false">
      <i class="fas fa-graduation-cap"></i> Students Program
    </a>
    <ul class="dropdown-menu" aria-labelledby="studentsProgramDropdown">
      <li><a class="dropdown-item {{ request()->is('seminars*') ? 'active' : '' }}" href="{{ route('seminars.index') }}"><i class="fas fa-chalkboard-teacher"></i> College Seminars</a></li>
      <li><a class="dropdown-item {{ request()->is('students*') ? 'active' : '' }}" href="{{ route('students.index') }}"><i class="fas fa-user-graduate"></i> Student Hiring</a></li>
      <li><a class="dropdown-item {{ request()->is('feedback*') ? 'active' : '' }}" href="{{ route('feedback.index') }}"><i class="fas fa-comment-alt"></i> Student Feedback</a></li>
      <li><a class="dropdown-item {{ request()->is('evaluations*') ? 'active' : '' }}" href="{{ route('evaluations.index') }}"><i class="fas fa-clipboard-check"></i> Student Evaluations</a></li>
    </ul>
  </li>

</ul>





</div>


        <!-- Main Content -->
        <div class="main-content w-100">
            <!-- Top Navbar -->
<!-- Top Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    
  <div class="container-fluid">
    
    <!-- Mobile toggle -->
    <button 
      class="navbar-toggler" 
      type="button" 
      data-bs-toggle="collapse" 
      data-bs-target="#navbarSupportedContent" 
      aria-controls="navbarSupportedContent" 
      aria-expanded="false" 
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

        <!-- Notifications Dropdown -->
        <li class="nav-item dropdown">
          <a 
            class="nav-link dropdown-toggle mt-2 me-4 position-relative" 
            href="#" 
            id="notificationsDropdown" 
            role="button" 
            data-bs-toggle="dropdown" 
            aria-expanded="false">
            <i class="fas fa-bell fa-fw"></i>

            @php
              $notificationCount = isset($recentNotifications) ? count($recentNotifications) : 0;
              $reminderCount = isset($upcomingRemindersList) ? count($upcomingRemindersList) : 0;

              if ($reminderCount == 0) {
                  $bellData = \Illuminate\Support\Facades\Cache::get('reminder_bell_data', [
                      'total_count' => 0, 
                      'has_high_priority' => false
                  ]);
                  $reminderCount = $bellData['total_count'];
              }

              $totalNotifications = $notificationCount + $reminderCount;

              $hasHighPriority = false;
              if (isset($upcomingRemindersList)) {
                  $hasHighPriority = $upcomingRemindersList->where('priority', 3)->count() > 0;
              } else {
                  $bellData = \Illuminate\Support\Facades\Cache::get('reminder_bell_data', [
                      'has_high_priority' => false
                  ]);
                  $hasHighPriority = $bellData['has_high_priority'];
              }
            @endphp

            @if($totalNotifications > 0)
              <span class="position-absolute top-0 start-100 translate-middle 
                           p-1 bg-danger border border-light rounded-circle"
                    style="margin-left: -26px; margin-top: 10px;">
              </span>
            @endif
          </a>

          <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="notificationsDropdown" style="width: 300px;">
            <li><h6 class="dropdown-header">Notifications Center</h6></li>

            @forelse($recentNotifications as $notification)
    @if($notification->notification)
        <li>
            <a class="dropdown-item py-2 notification-link" 
               href="{{ route('notifications.show', $notification->notification->id) }}" 
               data-id="{{ $notification->id }}">
                <i class="fas fa-bell me-1 text-primary"></i>
                {{ Str::limit($notification->notification->title, 30) }}
                @if(!$notification->is_read)
                    <span class="unread-dot ms-2"></span>
                @endif
            </a>
        </li>
    @endif
@empty
    <li><span class="dropdown-item py-2 text-muted">No recent notifications</span></li>
@endforelse


            @if(isset($recentNotifications) && count($recentNotifications) > 0 && isset($upcomingRemindersList) && count($upcomingRemindersList) > 0)
              <li><hr class="dropdown-divider my-1"></li>
            @endif

            @php
              $urgentReminders = \Illuminate\Support\Facades\Cache::get('urgent_reminders', collect());
              $upcomingReminders = \Illuminate\Support\Facades\Cache::get('upcoming_reminders', collect());
              $overdueReminders = \Illuminate\Support\Facades\Cache::get('overdue_reminders', collect());
              $allCachedReminders = $overdueReminders->merge($urgentReminders)->merge($upcomingReminders->take(3));
            @endphp

            @forelse($allCachedReminders as $reminder)
              <li>
                <a class="dropdown-item py-2" href="{{ route('reminders.show', $reminder->id) }}">
                  @if($reminder->due_date < now()->toDateString())
                    <i class="fas fa-exclamation-triangle me-1 text-danger"></i>
                    {{ Str::limit($reminder->title, 20) }}
                    <span class="badge bg-danger ms-1">Overdue</span>
                  @elseif($reminder->due_date == now()->toDateString())
                    <i class="fas fa-calendar-check me-1 text-warning"></i>
                    {{ Str::limit($reminder->title, 20) }}
                    <span class="badge bg-danger ms-1">Today</span>
                  @else
                    <i class="fas fa-calendar me-1 text-info"></i>
                    {{ Str::limit($reminder->title, 20) }}
                    <span class="badge bg-info ms-1">
                      {{ \Carbon\Carbon::parse($reminder->due_date)->diffForHumans() }}
                    </span>
                  @endif

                  @if($reminder->priority == 3)
                    <i class="fas fa-star text-warning ms-1" title="High Priority"></i>
                  @endif
                </a>
              </li>
            @empty
              @if(!isset($recentNotifications) || count($recentNotifications) == 0)
                <li><span class="dropdown-item py-2 text-muted">No upcoming reminders</span></li>
              @endif
            @endforelse

            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-center" href="{{ route('notifications.index') }}">View all notifications</a></li>
            <li><a class="dropdown-item text-center" href="{{ route('reminders.index') }}">View all reminders</a></li>
          </ul>
        </li>

        <!-- User Profile -->
        <li class="nav-item dropdown">
          <a 
            class="nav-link dropdown-toggle d-flex align-items-center" 
            href="#" 
            id="profileDropdown" 
            role="button" 
            data-bs-toggle="dropdown" 
            aria-expanded="false">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2" 
                 style="width: 36px; height: 36px;">
              <span>A</span>
            </div>
            <span>Admin</span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="profileDropdown">
            <li>
              <a class="dropdown-item" href="{{ route('admin.profile') }}">
                <i class="fas fa-user me-2"></i> Profile
              </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                @csrf
              </form>
              <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
              </a>
            </li>
          </ul>
        </li>

      </ul>
    </div>
  </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/your-fa-kit.js" crossorigin="anonymous"></script>


            <!-- Page Content -->
            <div class="container-fluid">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> --}}
    
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    
    <!-- DataTables CSS with Buttons -->
    {{-- <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap5.min.css" rel="stylesheet"> --}}
    
    <!-- DataTables JS with Buttons -->
    {{-- <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script> --}}


     <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
 
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
 
        <!-- Bootstrap Table Core JS -->
        <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>
 
        <!-- Bootstrap Table Extensions -->
        <script
            src="https://unpkg.com/bootstrap-table@1.22.1/dist/extensions/export/bootstrap-table-export.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/js-xlsx/0.8.0/xlsx.core.min.js"></script>
        <script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script>
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: "toast-top-right",
            timeOut: 3000
        };
        

        $(document).ready(function() {
            // Handle sidebar dropdown toggle
            $('.sidebar .dropdown-toggle').off('click').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                var $this = $(this);
                var $dropdown = $this.next('.dropdown-menu');
                var isOpen = $dropdown.is(':visible');
                
                console.log('Dropdown clicked, currently open:', isOpen);
                
                // Close all other dropdowns first
                $('.sidebar .dropdown-menu').not($dropdown).slideUp(200);
                
                // Toggle current dropdown
                if (isOpen) {
                    $dropdown.slideUp(200);
                    $this.attr('aria-expanded', 'false');
                } else {
                    $dropdown.slideDown(200);
                    $this.attr('aria-expanded', 'true');
                }
                
                return false;
            });
            
            // Close dropdown when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.sidebar .dropdown').length) {
                    $('.sidebar .dropdown-menu').slideUp();
                }
            });
            
            // Configuration for DataTables
            var dataTableConfig = {
                "paging": true,
                "ordering": true,
                "info": true,
                "responsive": true,
                "language": {
                    "search": "_INPUT_",
                    "searchPlaceholder": "Search..."
                },
                dom: '<"d-flex justify-content-between align-items-center mb-3"<"d-flex align-items-center"l><"d-flex"f><"d-flex"B>>rtip',
                buttons: [
                    {
                        extend: 'collection',
                        text: '<i class="fas fa-download"></i> Export',
                        className: 'btn-sm btn-outline-primary me-2',
                        buttons: [
                            { extend: 'copy', className: 'btn-sm' },
                            { extend: 'csv', className: 'btn-sm' },
                            { extend: 'excel', className: 'btn-sm' },
                            { extend: 'pdf', className: 'btn-sm' },
                            { extend: 'print', className: 'btn-sm' }
                        ]
                    },
                    {
                        text: '<i class="fas fa-upload"></i> Import',
                        className: 'btn-sm btn-outline-success me-2',
                        action: function (e, dt, node, config) {
                            // Get the table ID to determine which entity we're importing for
                            var tableId = dt.table().node().id;
                            var importModal = $('#importModal');
                            
                            if (importModal.length === 0) {
                                // Create modal if it doesn't exist
                                $('body').append(`
                                    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="importModalLabel">Import Data</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="importForm" enctype="multipart/form-data" method="POST">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="importFile" class="form-label">Choose CSV/Excel File</label>
                                                            <input type="file" class="form-control" id="importFile" name="importFile" accept=".csv,.xlsx,.xls" required>
                                                        </div>
                                                        <div class="form-text mb-3">Please ensure your file follows the required format.</div>
                                                        <div class="d-flex justify-content-between">
                                                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-sm btn-primary">Import</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `);
                                importModal = $('#importModal');
                            }
                            
                            // Set the form action based on the table ID
                            var formAction = '/admin/import';
                            if (tableId.includes('employees')) {
                                formAction = '/admin/employees/import';
                            } else if (tableId.includes('projects')) {
                                formAction = '/admin/projects/import';
                            } else if (tableId.includes('tasks')) {
                                formAction = '/admin/tasks/import';
                            } else if (tableId.includes('assets')) {
                                formAction = '/admin/assets/import';
                            } else if (tableId.includes('financials')) {
                                formAction = '/admin/financials/import';
                            }
                            
                            $('#importForm').attr('action', formAction);
                            importModal.modal('show');
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fas fa-columns"></i> Columns',
                        className: 'btn-sm btn-outline-primary'
                    }
                ]
            };

            // Initialize existing dataTable
            if($.fn.DataTable.isDataTable('#dataTable')) {
                $('#dataTable').DataTable(dataTableConfig);
            } else {
                // Initialize all tables with class 'table'
                var tables = $('table.table').not('.dataTable');
                tables.each(function() {
                    if($(this).find('thead').length > 0) {
                        $(this).attr('id', 'dataTable-' + Math.floor(Math.random() * 1000));
                        $(this).DataTable(dataTableConfig);
                    }
                });
            }
        });
        
        // Auto-refresh bell notification data every 5 minutes
        setInterval(function() {
            refreshBellNotifications();
        }, 300000); // 5 minutes
        
        function refreshBellNotifications() {
            fetch('{{ route("reminders.process-now") }}')
                .then(response => {
                    if (response.ok) {
                        // Refresh the page to update bell icon
                        location.reload();
                    }
                })
                .catch(error => {
                    console.log('Bell notification refresh failed:', error);
                });
        }
    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @yield('scripts')
</body>
</html>