<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">



    <title>{{ config('app.name', 'Employee Portal') }} - @yield('title')</title>



    <!-- Fonts -->

    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">



    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    

    <!-- Font Awesome -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">



    <!-- Custom styles -->

    <style>

        body {

            font-family: 'Nunito', sans-serif;

            background-color: #f8f9fa;

        }

        

        .sidebar {

            height: 100vh;

            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);

            color: #fff;

            position: fixed;

            width: 280px;

            overflow-y: auto;

            scrollbar-width: thin;

            scrollbar-color: rgba(255, 255, 255, 0.3) transparent;

            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);

            transition: all 0.3s ease;

            z-index: 1000;

        }

        

        /* Webkit scrollbar styles */

        .sidebar::-webkit-scrollbar {

            width: 4px;

        }

        

        .sidebar::-webkit-scrollbar-track {

            background: transparent;

        }

        

        .sidebar::-webkit-scrollbar-thumb {

            background-color: rgba(255, 255, 255, 0.2);

            border-radius: 4px;

        }

        

        .sidebar::-webkit-scrollbar-thumb:hover {

            background-color: rgba(255, 255, 255, 0.4);

        }

        

        

        
        

        .sidebar .nav-item {

            margin: 4px 8px;

            border-radius: 8px;

            overflow: hidden;

        }

        

        .sidebar .nav-link {

            color: rgba(255, 255, 255, 0.8);

            padding: 0.75rem 1rem;

            font-weight: 500;

            border-radius: 8px;

            transition: all 0.2s ease;

        }

        

        .sidebar .nav-link:hover {

            color: #fff;

            background-color: rgba(255, 255, 255, 0.1);

            transform: translateX(4px);

        }

        

        .sidebar .nav-link.active {

            color: #fff;

            background-color: rgba(255, 255, 255, 0.2);

            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);

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

            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);

            border: none;

            border-radius: 6px;

            padding: 0.5rem 1.25rem;

            font-weight: 500;

            transition: all 0.2s ease;

        }

        

        .btn-primary:hover {

            transform: translateY(-2px);

            box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);

        }



        .stats-card {

            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);

            color: white;

            border-radius: 15px;

            padding: 1.5rem;

            border: none;

            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.15);

            transition: transform 0.3s ease;

        }



        .stats-card:hover {

            transform: translateY(-5px);

        }



        .stats-card .stats-icon {

            font-size: 2.5rem;

            opacity: 0.8;

        }



        .welcome-card {

            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);

            color: white;

            border-radius: 15px;

            border: none;

            box-shadow: 0 8px 25px rgba(240, 147, 251, 0.15);

        }
.sidebar-logo {
            padding: 1rem;
            display: flex;
            justify-content: center;
            align-items: center;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 0.5rem;
            margin-top:20px;
            padding-bottom: 22px;
        }
        
        .sidebar-logo img {
            max-width: 85%;
            height: auto;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
        }
         .sidebar-heading {
    text-align: center;
    font-size: 18px;
    font-weight: 900;
    text-transform: uppercase;
    color: #000000ff;
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
    </style>



    @yield('styles')

</head>

<body>

    <div class="d-flex">

        <!-- Sidebar -->

        <div class="sidebar">

            <div class="sidebar-logo mb-3 ">
        <img src="{{ asset('images/Mindcode.svg') }}" 
             alt="Employee Management Logo" 
             class="img-fluid mb-2">
    </div>

            <ul class="nav flex-column">
 <div class="sidebar-heading px-3 mt-4 mb-4">
  <span>YOUR INFORMATION</span>
</div>
                <!-- Dashboard -->

                <li class="nav-item mt-4">

                    <a class="nav-link {{ request()->routeIs('employee.dashboard') ? 'active' : '' }}" href="{{ route('employee.dashboard') }}">

                        <i class="fas fa-tachometer-alt"></i> Dashboard

                    </a>

                </li>

                

                
                


                <li class="nav-item">

                    <a class="nav-link {{ request()->routeIs('employee.attendance') ? 'active' : '' }}" href="{{ route('employee.attendance') }}">

                        <i class="fas fa-calendar-check"></i> My Attendance

                    </a>

                </li>



                <li class="nav-item">

                    <a class="nav-link {{ request()->routeIs('employee.leaves') ? 'active' : '' }}" href="{{ route('employee.leaves') }}">

                        <i class="fas fa-calendar-alt"></i> My Leaves

                    </a>

                </li>



                <li class="nav-item">

                    <a class="nav-link {{ request()->routeIs('employee.salary') ? 'active' : '' }}" href="{{ route('employee.salary') }}">

                        <i class="fas fa-money-bill-alt"></i> My Salary

                    </a>

                </li>



                <li class="nav-item">

                    <a class="nav-link {{ request()->routeIs('employee.daily_tasks.*') ? 'active' : '' }}" href="{{ route('employee.daily_tasks.index') }}">

                        <i class="fas fa-tasks"></i> Daily Tasks

                    </a>

                </li>

                

                <li class="nav-item">

                    <a class="nav-link {{ request()->routeIs('employee.project-tasks') ? 'active' : '' }}" href="{{ route('employee.project-tasks') }}">

                        <i class="fas fa-project-diagram"></i> Project Tasks

                    </a>

                </li>

                

               

                

                <li class="nav-item">

                    <a class="nav-link {{ request()->routeIs('employee.notifications-reminders') ? 'active' : '' }}" href="{{ route('employee.notifications-reminders') }}">

                        <i class="fas fa-bell"></i> Notifications

                        <span class="badge bg-danger ms-2" id="sidebar-notification-count" style="display: none;">0</span>

                    </a>

                </li>

            </ul>

        </div>



        <!-- Main Content -->

        <div class="main-content w-100">

            <!-- Top Navbar -->

           <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm sticky-top">
  <div class="container-fluid">

    <!-- Mobile Toggle -->
    <button 
      class="navbar-toggler border-0" 
      type="button" 
      data-bs-toggle="collapse" 
      data-bs-target="#navbarSupportedContent" 
      aria-controls="navbarSupportedContent" 
      aria-expanded="false" 
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapsible Content -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

        <!-- Notifications Dropdown -->
       <!-- Notifications -->
<li class="nav-item dropdown me-3">
    <a class="nav-link dropdown-toggle position-relative" href="#" id="notificationDropdown"
       role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-bell" style="font-size: 1.2rem;"></i>

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
        @endphp

        @if($totalNotifications > 0)
            <!-- Small elegant red dot -->
            <span class="position-absolute top-1  translate-middle bg-danger rounded-circle"
                  style="width: 7px; height: 7px; box-shadow: 0 0 6px rgba(0,0,0,0.2); margin-left: -4px;">
            </span>
        @endif
    </a>

    <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 p-0"
        style="width: 350px; max-height: 400px; overflow-y: auto;"
        id="notifications-dropdown">

        <!-- Header -->
        <li class="p-3 border-bottom d-flex justify-content-between align-items-center">
            <h6 class="m-0 fw-semibold">Notifications & Reminders</h6>
            <a href="{{ route('employee.notifications-reminders') }}"
               class="btn btn-sm btn-link text-decoration-none">View All</a>
        </li>

        <!-- Tabs -->
        <li class="px-3 py-2">
            <ul class="nav nav-tabs nav-tabs-sm" id="notificationTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="notifications-tab"
                            data-bs-toggle="tab" data-bs-target="#notifications"
                            type="button" role="tab">
                        Notifications
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="reminders-tab"
                            data-bs-toggle="tab" data-bs-target="#reminders"
                            type="button" role="tab">
                        Reminders
                    </button>
                </li>
            </ul>
        </li>

        <!-- Tab Content -->
        <div class="tab-content" id="notificationTabsContent">

            <!-- Notifications Tab -->
            <div class="tab-pane fade show active" id="notifications" role="tabpanel">
                <div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
                    <small class="text-muted">Recent Notifications</small>
                </div>
                <div id="notifications-container">
                    @forelse($recentNotifications as $notification)
                        @if($notification->notification)
                            <li class="border-bottom">
                                <a class="dropdown-item py-2 d-flex align-items-center"
                                   href="{{ route('notifications.show', $notification->notification->id) }}">
                                    <i class="fas fa-bell me-2 text-primary"></i>
                                    <span>{{ Str::limit($notification->notification->title, 40) }}</span>
                                    @if(!$notification->is_read)
                                        <span class="ms-2 rounded-circle bg-primary"
                                              style="width:8px;height:8px;display:inline-block;"></span>
                                    @endif
                                </a>
                            </li>
                        @endif
                    @empty
                        <li class="text-center p-3 text-muted">
                            <i class="fas fa-bell-slash mb-2"></i><br>
                            No recent notifications
                        </li>
                    @endforelse
                </div>
            </div>

            <!-- Reminders Tab -->
            <div class="tab-pane fade" id="reminders" role="tabpanel">
                <div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
                    <small class="text-muted">Active Reminders</small>
                </div>
                <div id="reminders-container">
                    @php
                        $urgentReminders = \Illuminate\Support\Facades\Cache::get('urgent_reminders', collect());
                        $upcomingReminders = \Illuminate\Support\Facades\Cache::get('upcoming_reminders', collect());
                        $overdueReminders = \Illuminate\Support\Facades\Cache::get('overdue_reminders', collect());
                        $allCachedReminders = $overdueReminders->merge($urgentReminders)->merge($upcomingReminders->take(3));
                    @endphp

                    @forelse($allCachedReminders as $reminder)
                        <li class="border-bottom">
                            <a class="dropdown-item py-2 d-flex align-items-center"
                               href="{{ route('reminders.show', $reminder->id) }}">
                                @if($reminder->due_date < now()->toDateString())
                                    <i class="fas fa-exclamation-triangle me-2 text-danger"></i>
                                    <span>{{ Str::limit($reminder->title, 30) }}</span>
                                    <span class="badge bg-danger ms-2">Overdue</span>
                                @elseif($reminder->due_date == now()->toDateString())
                                    <i class="fas fa-calendar-check me-2 text-warning"></i>
                                    <span>{{ Str::limit($reminder->title, 30) }}</span>
                                    <span class="badge bg-danger ms-2">Today</span>
                                @else
                                    <i class="fas fa-calendar me-2 text-info"></i>
                                    <span>{{ Str::limit($reminder->title, 30) }}</span>
                                    <span class="badge bg-info ms-2">
                                        {{ \Carbon\Carbon::parse($reminder->due_date)->diffForHumans() }}
                                    </span>
                                @endif
                                @if($reminder->priority == 3)
                                    <i class="fas fa-star text-warning ms-1" title="High Priority"></i>
                                @endif
                            </a>
                        </li>
                    @empty
                        <li class="text-center p-3 text-muted">
                            <i class="fas fa-calendar-times mb-2"></i><br>
                            No upcoming reminders
                        </li>
                    @endforelse
                </div>
            </div>
        </div>
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
            aria-expanded="false"
            style="margin-top: -8px;">

            @if(Session::get('employee_photo'))
              <img src="{{ asset('storage/' . Session::get('employee_photo')) }}" 
                   alt="Profile" 
                   class="rounded-circle me-2 shadow-sm" 
                   style="width: 36px; height: 36px; object-fit: cover;">
            @else
              <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2 shadow-sm" 
                   style="width: 36px; height: 36px;">
                <span>{{ substr(Session::get('employee_name', 'E'), 0, 1) }}</span>
              </div>
            @endif
            <span>{{ Session::get('employee_name', 'Employee') }}</span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="profileDropdown">
            <li>
              <a class="dropdown-item" href="{{ route('employee.profile') }}">
                <i class="fas fa-user me-2"></i> My Profile
              </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <a class="dropdown-item text-danger" href="{{ route('employee.logout') }}">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
              </a>
            </li>
          </ul>
        </li>

      </ul>
    </div>
  </div>
</nav>






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



    <!-- Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

    

    <!-- jQuery -->

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>



@yield('scripts')



<script>

$(document).ready(function() {

    const notificationDropdown = $('#notificationDropdown');

    const notificationsContainer = $('#notifications-container');

    const remindersContainer = $('#reminders-container');

    const notificationCount = $('#notification-count');

    const markAllNotificationsReadButton = $('#mark-all-notifications-read');

    const markAllRemindersReadButton = $('#mark-all-reminders-read');



    // Fetch notifications

    function fetchNotifications() {

        $.get('{{ route('employee.notifications') }}', function(response) {

            const notifications = response.notifications;

            notificationsContainer.empty();



            if (notifications.length > 0) {

                const unreadNotifications = notifications.filter(n => !n.is_read);

                markAllNotificationsReadButton.toggle(unreadNotifications.length > 0);



                notifications.forEach(notification => {

                    const isReadClass = notification.is_read ? 'text-muted' : '';

                    const readButton = notification.is_read ? '' : `<button class="btn btn-sm btn-link text-decoration-none mark-notification-read" data-id="${notification.id}">Mark as read</button>`;



                    notificationsContainer.append(`

                        <li class="dropdown-item ${isReadClass}">

                            <div class="d-flex justify-content-between">

                                <div>

                                    <strong>${notification.title}</strong>

                                    <p class="small mb-1">${notification.message}</p>

                                    <small>${new Date(notification.created_at).toLocaleDateString()}</small>

                                </div>

                                ${readButton}

                            </div>

                        </li>

                        <li><hr class="dropdown-divider"></li>

                    `);

                });

            } else {

                notificationsContainer.append('<li class="text-center text-muted">No notifications</li>');

            }

        });

    }



    // Fetch reminders

    function fetchReminders() {

        $.get('{{ route('employee.reminders') }}', function(response) {

            const reminders = response.reminders;

            remindersContainer.empty();



            if (reminders.length > 0) {

                const unreadReminders = reminders.filter(r => !r.is_read);

                markAllRemindersReadButton.toggle(unreadReminders.length > 0);



                reminders.forEach(reminder => {

                    const isReadClass = reminder.is_read ? 'text-muted' : '';

                    const readButton = reminder.is_read ? '' : `<button class="btn btn-sm btn-link text-decoration-none mark-reminder-read" data-id="${reminder.id}">Mark as read</button>`;

                    

                    // Priority badge

                    let priorityBadge = '';

                    if (reminder.priority === 3) {

                        priorityBadge = '<span class="badge bg-danger ms-2">High</span>';

                    } else if (reminder.priority === 2) {

                        priorityBadge = '<span class="badge bg-warning ms-2">Medium</span>';

                    }



                    remindersContainer.append(`

                        <li class="dropdown-item ${isReadClass}">

                            <div class="d-flex justify-content-between">

                                <div>

                                    <strong>${reminder.title}${priorityBadge}</strong>

                                    <p class="small mb-1">${reminder.description || 'No description'}</p>

                                    <small>Due: ${new Date(reminder.due_date).toLocaleDateString()}</small>

                                </div>

                                ${readButton}

                            </div>

                        </li>

                        <li><hr class="dropdown-divider"></li>

                    `);

                });

            } else {

                remindersContainer.append('<li class="text-center text-muted">No reminders</li>');

            }

        });

    }



    // Update notification count

    function updateNotificationCount() {

        Promise.all([

            $.get('{{ route('employee.notifications') }}'),

            $.get('{{ route('employee.reminders') }}')

        ]).then(([notificationsResponse, remindersResponse]) => {

            const unreadNotifications = notificationsResponse.notifications.filter(n => !n.is_read).length;

            const unreadReminders = remindersResponse.reminders.filter(r => !r.is_read).length;

            const totalUnread = unreadNotifications + unreadReminders;

            

            // Update header bell icon count

            notificationCount.text(totalUnread).toggle(totalUnread > 0);

            

            // Update sidebar notification count

            const sidebarCount = $('#sidebar-notification-count');

            sidebarCount.text(totalUnread).toggle(totalUnread > 0);

        });

    }



    // Load data when dropdown is opened

    notificationDropdown.click(function() {

        fetchNotifications();

        fetchReminders();

    });



    // Load reminders when tab is clicked

    $('#reminders-tab').click(function() {

        fetchReminders();

    });



    // Mark notification as read

    notificationsContainer.on('click', '.mark-notification-read', function() {

        const button = $(this);

        const notificationId = button.data('id');



        $.post(`{{ url('employee/notifications') }}/${notificationId}/read`, {

            _token: '{{ csrf_token() }}'

        }, function() {

            button.closest('.dropdown-item').addClass('text-muted').find('.mark-notification-read').remove();

            const remainingUnread = notificationsContainer.find('.mark-notification-read').length;

            markAllNotificationsReadButton.toggle(remainingUnread > 0);

            updateNotificationCount();

        });

    });



    // Mark reminder as read

    remindersContainer.on('click', '.mark-reminder-read', function() {

        const button = $(this);

        const reminderId = button.data('id');



        $.post(`{{ url('employee/reminders') }}/${reminderId}/read`, {

            _token: '{{ csrf_token() }}'

        }, function() {

            button.closest('.dropdown-item').addClass('text-muted').find('.mark-reminder-read').remove();

            const remainingUnread = remindersContainer.find('.mark-reminder-read').length;

            markAllRemindersReadButton.toggle(remainingUnread > 0);

            updateNotificationCount();

        });

    });



    // Mark all notifications as read

    markAllNotificationsReadButton.click(function() {

        $.post(`{{ route('employee.notifications.read-all') }}`, {

            _token: '{{ csrf_token() }}'

        }, function() {

            notificationsContainer.find('.dropdown-item').addClass('text-muted').find('.mark-notification-read').remove();

            markAllNotificationsReadButton.hide();

            updateNotificationCount();

        });

    });



    // Mark all reminders as read

    markAllRemindersReadButton.click(function() {

        $.post(`{{ route('employee.reminders.read-all') }}`, {

            _token: '{{ csrf_token() }}'

        }, function() {

            remindersContainer.find('.dropdown-item').addClass('text-muted').find('.mark-reminder-read').remove();

            markAllRemindersReadButton.hide();

            updateNotificationCount();

        });

    });



    // Initial load of count

    updateNotificationCount();

});

</script>

</body>

</html>

