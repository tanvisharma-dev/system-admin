@extends('layouts.client')

@section('title', 'Dashboard')

@section('styles')
    <style>
        .info-card {
            border: 1px solid #d4edda;
            border-radius: 12px;
            background-color: #f9fffb;
            transition: all 0.3s ease-in-out;
        }

        .info-card:hover {
            box-shadow: 0 4px 20px rgba(72, 180, 97, 0.2);
            transform: translateY(-5px);
        }

        .info-icon {
            font-size: 1.5rem;
            color: #28a745;
            margin-right: 10px;
        }

        .info-label {
            font-weight: 600;
            color: #555;
        }

        .info-value {
            color: #333;
        }

        @media (max-width: 768px) {
            .info-grid {
                flex-direction: column;
            }
        }
    </style>
@endsection

@section('content')
    <div class="mb-4">
        <h3 class="text-success mb-3">Welcome, {{ $client->company_name }}</h3>

        <div class="d-flex flex-wrap gap-3 info-grid">
            <div class="info-card p-4 flex-fill">
                <a href="{{ route('client.projects') }}" class="text-decoration-none d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-diagram-project info-icon"></i>
                        <span class="info-label">Total Projects</span>
                    </div>
                    <div class="fs-1 fw-bolder pe-3 text-success">{{ $totalProjects }}</div>
                </a>
            </div>

            <div class="info-card p-4 flex-fill">
                <a href="{{ route('client.active_projects') }}" class="text-decoration-none d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-puzzle-piece info-icon"></i>
                        <span class="info-label">Active Projects</span>
                    </div>
                    <div class="fs-1 fw-bolder pe-3 text-success">{{ $activeProjects }}</div>
                </a>
            </div>

            <div class="info-card p-4 flex-fill">

                <a href="{{ route('client.CompletedProjects') }}" class="text-decoration-none d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-puzzle-piece info-icon"></i>
                        <span class="info-label">Completed Projects</span>
                    </div>
                    <div class="fs-1 fw-bolder pe-3 text-success">{{ $completedProjects }}</div>
                </a>
            </div>

            <div class="info-card p-4 flex-fill">
                <a href="{{ route('client.ProjectsonHold') }}" class="text-decoration-none d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-puzzle-piece info-icon"></i>
                        <span class="info-label">Projects on hold</span>
                    </div>
                    <div class="fs-1 fw-bolder pe-3 text-success">{{ $onHoldProjects }}</div>
                </a>
            </div>
        </div>
    </div>
    <div class="mb-4">
        <h3 class="text-success mb-3">Invoice</h3>

        <!-- <div class="d-flex flex-wrap gap-3 info-grid">
                    <div class="info-card p-4 flex-fill">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-envelope info-icon"></i>
                            <span class="info-label">Email</span>
                        </div>
                        <div class="info-value">{{ $client->email }}</div>
                    </div>

                    <div class="info-card p-4 flex-fill">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-user info-icon"></i>
                            <span class="info-label">Contact Person</span>
                        </div>
                        <div class="info-value">{{ $client->contact_person }}</div>
                    </div>
                </div> -->

        <div class="row gap-3">
            <div class="info-card p-4 col-md-4">
                <a href="" class="text-decoration-none">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-money-check-dollar info-icon"></i>
                        <span class="info-label">All Invoices</span>
                    </div>
                    <div class="info-value">{{ $client->contact_person }}</div>
                </a>
            </div>

            <div class="info-card p-4 col-md-4">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-solid fa-clock info-icon text-danger"></i>
                    <span class="info-label text-danger">Pending Invoices</span>
                </div>
                <div class="info-value">{{ $client->contact_person }}</div>
            </div>
        </div>
    </div>
@endsection