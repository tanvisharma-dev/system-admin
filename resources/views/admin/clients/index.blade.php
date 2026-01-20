@extends('layouts.admin')

@section('title', 'Clients')

@section('content')
<div class="container mt-4">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Clients</h2>

        <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary btn-sm" title="Refresh" onclick="location.reload()">
                <i class="fas fa-sync-alt"></i>
            </button>
            <button class="btn btn-outline-secondary btn-sm" id="toggleViewBtn" title="Toggle View">
                <i class="fas fa-th-large"></i>
            </button>
            <a href="{{ route('admin.clients.create') }}" class="btn btn-primary btn-sm">
                Add Client
            </a>
        </div>
    </div>

    {{-- Search --}}
    <div class="input-group input-group-sm mb-3" style="max-width: 300px;">
        <input type="text" class="form-control" id="searchInput" placeholder="Search...">
        <button class="btn btn-outline-secondary" type="button" disabled>
            <i class="fas fa-search"></i>
        </button>
    </div>

    {{-- Table View --}}
    <div id="clientTableView">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Company</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Billing Address</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody id="clientTableBody">
                @forelse($clients as $client)
                    <tr>
                        <td>{{ $client->company_name }}</td>
                        <td>{{ $client->contact_person }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->phone }}</td>
                        <td>{{ $client->billing_address }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.clients.show', $client->id) }}" class="btn btn-sm btn-outline-secondary" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.clients.edit', $client->id) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action="{{ route('admin.clients.destroy', $client->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-outline-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted">No clients found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Grid View --}}
    <div id="clientGridView" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 d-none">
        @forelse($clients as $client)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $client->company_name }}</h5>
                        <p class="mb-1"><strong>Contact:</strong> {{ $client->contact_person }}</p>
                        <p class="mb-1"><strong>Email:</strong> {{ $client->email }}</p>
                        <p class="mb-1"><strong>Phone:</strong> {{ $client->phone }}</p>
                        <p class="mb-1"><strong>Address:</strong> {{ $client->billing_address }}</p>
                        <div class="mt-3 d-flex gap-2">
                            <a href="{{ route('admin.clients.show', $client->id) }}" class="btn btn-sm btn-outline-secondary" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.clients.edit', $client->id) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action="{{ route('admin.clients.destroy', $client->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-outline-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">No clients found.</p>
        @endforelse
    </div>

</div>
@endsection

@section('scripts')
<script>
    // Search
    document.getElementById("searchInput").addEventListener("keyup", function () {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll("#clientTableBody tr");

        rows.forEach(row => {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? "" : "none";
        });
    });

    // View Toggle
    document.getElementById("toggleViewBtn").addEventListener("click", function () {
        const tableView = document.getElementById("clientTableView");
        const gridView = document.getElementById("clientGridView");

        const isTableVisible = !tableView.classList.contains("d-none");

        tableView.classList.toggle("d-none", isTableVisible);
        gridView.classList.toggle("d-none", !isTableVisible);

        this.innerHTML = isTableVisible
            ? '<i class="fas fa-list"></i>'
            : '<i class="fas fa-th-large"></i>';
    });
</script>
@endsection
