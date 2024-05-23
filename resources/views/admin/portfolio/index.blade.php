@extends('layouts.admin')

@section('content')
    <header class="py-3 bg-dark text-light">
        <div class="container d-flex align-items-center justify-content-between">
            <h1>Projects :</h1>
            <a class="btn btn-primary" href="{{ route('admin.portfolio.create') }}"> New Project </a>
        </div>

        @if (session('message'))
            <div class="alert alert-success w-50 my-3 mx-auto text-center">
                <h4> {{ session('message') }}</h4>
            </div>
        @endif
    </header>

    <div class="container table_container my-4">
        <div class="table-responsive">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">ID</th>
                        <th class="text-center" scope="col">Image</th>
                        <th class="text-center" scope="col">Title</th>
                        <th class="text-center" scope="col">Link</th>
                        <th class="text-center" scope="col">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($projects as $project)
                        <tr>
                            {{-- ID --}}
                            <td class=" text-center">{{ $project->id }}</td>

                            {{-- COVER_IMAGE --}}
                            @if (Str::startsWith($project->cover_image, 'https://'))
                                <td class=" text-center py-3"><img width="200" height="auto"
                                        src="{{ $project->cover_image }}" alt=" Image N/A"></td>
                            @else
                                <td class="text-center py-3"><img class="border border-warning" width="200"
                                        height="200" src="{{ asset('storage/' . $project->cover_image) }}"
                                        alt=" Image N/A">
                                </td>
                            @endif

                            {{-- TITLE --}}
                            <td class=" text-center shadow">{{ $project->title }}</td>

                            {{-- LINK --}}
                            <td class=" text-center w-25">
                                <a target="_blank" class=" text-decoration-none text-warning shadow"
                                    href="{{ $project->link }}">{{ $project->link }}
                                </a>
                            </td>

                            {{-- CONTROLS --}}
                            <td class="text-center">
                                <div class="d-flex flex-column gap-5 py-2">
                                    <a class="btn btn-warning" href="{{ route('admin.portfolio.show', $project) }}">
                                        &RightArrow; View
                                    </a>
                                    <a class="btn btn-secondary" href="{{ route('admin.portfolio.edit', $project) }}">
                                        &boxminus; Modify</a>

                                    <!-- Modal trigger button -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#{{ $project->id }}">
                                        &cross; Delete
                                    </button>
                                </div>

                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal fade text-dark" id="{{ $project->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="modalTitle{{ $project->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitle{{ $project->id }}">
                                                    Delete Post "{{ $project->title }}"
                                                </h5>
                                            </div>
                                            <div class="modal-body text-danger">Are you sure to delete this item ? </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>

                                                <form action="{{ route('admin.portfolio.destroy', $project) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger">
                                                        Confirm
                                                    </button>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center">N/A : No projects yet!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
        <footer class="text-light">
            <a class="text-decoration-none text-danger bg-warning rounded p-2 " href="https://github.com/Lucaalex00">Made
                by
                Luca Cirio
            </a>
        </footer>
        {{ $projects->links('pagination::bootstrap-5') }}
    </div>
@endsection
