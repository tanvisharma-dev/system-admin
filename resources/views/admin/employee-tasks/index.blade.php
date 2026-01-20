@extends('layouts.admin')

@section('title', 'Employee Tasks')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Employee Tasks</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Employee Tasks</li>
            </ol>
        </nav>
    </div>


    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-search mr-2"></i>Search & Filter Employees
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('employee-tasks.index') }}" method="GET">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="search" class="form-label">Search Employee</label>
                                <input type="text" 
                                       id="search"
                                       name="search" 
                                       class="form-control" 
                                       placeholder="Search by name, ID, or designation" 
                                       value="{{ request('search') }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="department" class="form-label">Department</label>
                                <select name="department" id="department" class="form-control">
                                    <option value="">All Departments</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}" 
                                                {{ request('department') == $department->id ? 'selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="sort_by" class="form-label">Sort By</label>
                                <select name="sort_by" id="sort_by" class="form-control">
                                    <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Name</option>
                                    <option value="employee_id" {{ request('sort_by') == 'employee_id' ? 'selected' : '' }}>Employee ID</option>
                                    <option value="task_count" {{ request('sort_by') == 'task_count' ? 'selected' : '' }}>Task Count</option>
                                    <option value="designation" {{ request('sort_by') == 'designation' ? 'selected' : '' }}>Designation</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="sort_order" class="form-label">Order</label>
                                <select name="sort_order" id="sort_order" class="form-control">
                                    <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                                    <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Descending</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary mr-2">
                                    <i class="fas fa-search mr-1"></i> Search
                                </button>
                                <a href="{{ route('employee-tasks.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times mr-1"></i> Clear
                                </a>
                                @if(request()->hasAny(['search', 'department', 'sort_by']))
                                    <span class="ml-3 text-muted">
                                        <i class="fas fa-filter mr-1"></i>
                                        Showing filtered results
                                    </span>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Employee Cards -->
    <div class="row">
        @forelse($employees as $employee)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 employee-card">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    {{ $employee->employee_id }}
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $employee->name }}
                                </div>
                                <div class="text-xs text-gray-600 mb-2">
                                    <i class="fas fa-briefcase mr-1"></i>{{ $employee->designation }}
                                    @if($employee->department)
                                        <span class="mx-1">•</span>
                                        <i class="fas fa-building mr-1"></i>{{ $employee->department->name }}
                                    @endif
                                </div>
                                {{-- <div class="row text-center">
                                    <div class="col-4">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total</div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">{{ $employee->daily_tasks_count }}</div>
                                    </div>
                                    <div class="col-4">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">This Month</div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            {{ $employee->dailyTasks()->whereMonth('date', now()->month)->count() }}
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">This Week</div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            {{ $employee->dailyTasks()->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])->count() }}
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                            {{-- <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div> --}}
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('employee-tasks.show', $employee->id) }}" class="btn btn-primary btn-sm btn-block">
                                <i class="fas fa-tasks mr-1"></i> View Tasks
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-users fa-3x text-gray-300 mb-3"></i>
                        <h5 class="text-gray-600">No Employees Found</h5>
                        @if(request()->hasAny(['search', 'department']))
                            <p class="text-gray-500">No employees match your search criteria. Try adjusting your filters.</p>
                            <a href="{{ route('employee-tasks.index') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-times mr-1"></i> Clear Filters
                            </a>
                        @else
                            <p class="text-gray-500">There are no active employees in the system.</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($employees->hasPages())
        <div class="row mt-4">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    @endif

    <!-- Summary Statistics -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-chart-bar mr-2"></i>Task Overview
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Tasks
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $employees->sum('daily_tasks_count') }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-tasks fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Active Employees
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $employees->count() }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Avg Tasks per Employee
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $employees->count() > 0 ? round($employees->sum('daily_tasks_count') / $employees->count(), 1) : 0 }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calculator fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Most Active Employee
                                            </div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800">
                                                @if($employees->count() > 0)
                                                    {{ $employees->sortByDesc('daily_tasks_count')->first()->name }}
                                                    <small class="text-gray-500">
                                                        ({{ $employees->sortByDesc('daily_tasks_count')->first()->daily_tasks_count }} tasks)
                                                    </small>
                                                @else
                                                    N/A
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-trophy fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .border-left-primary {
        border-left: 0.25rem solid #4e73df !important;
    }
    .border-left-success {
        border-left: 0.25rem solid #1cc88a !important;
    }
    .border-left-info {
        border-left: 0.25rem solid #36b9cc !important;
    }
    .border-left-warning {
        border-left: 0.25rem solid #f6c23e !important;
    }
    .card {
        transition: all 0.3s ease;
    }
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important;
    }
    .search-highlight {
        background-color: #fff3cd;
        border-radius: 3px;
        padding: 1px 3px;
    }
    .employee-card {
        transition: all 0.3s ease;
    }
    .employee-card.filtered-out {
        opacity: 0.3;
        transform: scale(0.95);
    }
</style>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Enhanced search functionality
    let searchTimeout;
    
    $('#search').on('input', function() {
        clearTimeout(searchTimeout);
        const searchTerm = $(this).val().toLowerCase();
        
        searchTimeout = setTimeout(function() {
            filterEmployeeCards(searchTerm);
        }, 300); // Debounce search for 300ms
    });
    
    function filterEmployeeCards(searchTerm) {
        if (searchTerm === '') {
            // Show all cards if search is empty
            $('.employee-card').removeClass('filtered-out');
            removeHighlights();
            return;
        }
        
        $('.employee-card').each(function() {
            const card = $(this);
            const employeeId = card.find('.text-primary').text().toLowerCase();
            const employeeName = card.find('.h5').text().toLowerCase();
            const designation = card.find('.text-gray-600').text().toLowerCase();
            
            const matches = employeeId.includes(searchTerm) || 
                          employeeName.includes(searchTerm) || 
                          designation.includes(searchTerm);
            
            if (matches) {
                card.removeClass('filtered-out');
                highlightSearchTerm(card, searchTerm);
            } else {
                card.addClass('filtered-out');
                removeHighlights(card);
            }
        });
    }
    
    function highlightSearchTerm(card, searchTerm) {
        // Remove existing highlights first
        removeHighlights(card);
        
        if (searchTerm.length < 2) return; // Don't highlight very short terms
        
        const elementsToHighlight = card.find('.text-primary, .h5, .text-gray-600');
        
        elementsToHighlight.each(function() {
            const element = $(this);
            const text = element.text();
            const regex = new RegExp(`(${searchTerm})`, 'gi');
            
            if (regex.test(text)) {
                const highlightedText = text.replace(regex, '<span class="search-highlight">$1</span>');
                element.html(highlightedText);
            }
        });
    }
    
    function removeHighlights(card = null) {
        const target = card || $('.employee-card');
        target.find('.search-highlight').each(function() {
            $(this).parent().text($(this).parent().text());
        });
    }
    
    // Clear search functionality
    $('.btn-secondary').on('click', function(e) {
        if ($(this).attr('href') === '{{ route("employee-tasks.index") }}') {
            $('#search').val('');
            $('#department').val('');
            $('#sort_by').val('name');
            $('#sort_order').val('asc');
            $('.employee-card').removeClass('filtered-out');
            removeHighlights();
        }
    });
    
    // Form auto-submit on filter change
    $('#department, #sort_by, #sort_order').on('change', function() {
        $(this).closest('form').submit();
    });
    
    // Enter key search
    $('#search').on('keypress', function(e) {
        if (e.which === 13) { // Enter key
            $(this).closest('form').submit();
        }
    });
    
    // Show search results count
    function updateSearchResultsCount() {
        const visibleCards = $('.employee-card').not('.filtered-out').length;
        const totalCards = $('.employee-card').length;
        
        let countText = '';
        if ($('#search').val()) {
            countText = `Showing ${visibleCards} of ${totalCards} employees`;
        }
        
        // Remove existing count
        $('.search-results-count').remove();
        
        // Add new count if there's a search term
        if (countText) {
            $('<small class="search-results-count text-muted ml-2">' + countText + '</small>')
                .insertAfter('.btn-secondary');
        }
    }
    
    $('#search').on('input', function() {
        setTimeout(updateSearchResultsCount, 350);
    });
});
</script>
@endsection
