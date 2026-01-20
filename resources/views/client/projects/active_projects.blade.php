@extends('layouts.container')

@section('container')

    <div class="d-flex justify-content-between p-1 mb-2">

        <h3 class="mb-0">Active Projects</h3>
        <a href="#" class="btn btn-primary">Apply for New Project</a>
    </div>


    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Project Name</th>
                <th>Status</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
                <tr>
                    <td>{{ $loop->iteration + ($projects->currentPage() - 1) * $projects->perPage() }}</td>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->status }}</td>
                    <td>{{ $project->start_date }}</td>
                    <td>{{ $project->end_date }}</td>
                    <td class="d-flex">
                    <a href="{{ route('client.ProjectDetails', ['id' => $project->id]) }}" class="btn btn-sm btn-info text-white p-1 px-2 me-1">
                            <i class="fas fa-eye"></i>
                        </a>
                        <!-- <a href="#" class="btn btn-sm btn-warning text-white h-50 me-1">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="#" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this project?');">
                            <input type="hidden" name="_token" value="0zdQ5KqvdnIiRKAWME5J34KiwdAd1vHNbbNwRW5X"> <input
                                type="hidden" name="_method" value="DELETE"> <button type="submit"
                                class="btn btn-sm btn-danger text-white">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form> -->
                    </td>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination links -->
    <div>
        {{ $projects->links('pagination::bootstrap-5') }}
    </div>

@endsection