@extends('layouts.client')

@section('content')


    <style>
        .custom-sidebar {
            width: 100%;
            background: linear-gradient(135deg, #28a745, #198754);
            padding: 10px;
            border-radius: 10px;
            height: 100%;
            min-height: 300px;
            max-height: 420px;
        }

        .custom-links {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .custom-link {
            display: block;
            padding: 10px 15px;
            color: #ffffff;
            font-weight: 500;
            text-decoration: none;
            border-radius: 6px;
            transition: background 0.3s, transform 0.2s;
        }

        .custom-link:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(5px);
            text-decoration: none;
        }
    </style>


    <div class="row">
        <div class="col-md-2">
            <div class="custom-sidebar">
                <ul class="custom-links">
                    <li><a href="projects" class="custom-link">Projects</a></li>
                    <li><a href="project-modules" class="custom-link">Modules</a></li>
                    <li><a href="active-projects" class="custom-link">Active Projects</a></li>
                    <li><a href="completed-projects" class="custom-link">Completed Projects</a></li>
                    <li><a href="onHold-projects" class="custom-link">Projects on Hold</a></li>
                    
                </ul>
            </div>
        </div>
        <div class="col-md-10">
            @yield('container')
        </div>
    </div>



@endsection

@section('scripts')
    @yield('scripts')  <!-- this will pass scripts from child page to main layout -->
@endsection