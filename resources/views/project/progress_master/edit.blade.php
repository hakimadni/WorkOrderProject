@extends('layouts.app')

@section('title', 'Edit Progress Master')
@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card mb-10">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        {{ isset($sponsor) ? 'Edit Progress Master' : 'Add Progress Master' }}
                    </div>
                </div>

                <div class="card-body pt-0">
                    <form action="{{ route('workorderprogressmaster.update', $progressMaster->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name', $progressMaster->name) }}" required>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description:</label>
                            <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $progressMaster->description) }}</textarea>
                        </div>
                        @php
                            $canCreate =
                                collect(session('user_permissions', []))->firstWhere(
                                    'route_name',
                                    'workorderprogressmaster',
                                )['can_create'] ?? false;
                        @endphp
                        @if ($canCreate)
                            <div class="col-12 col-md-6 col-lg-3">
                                <a href="{{ route('workorderprogressmaster.create') }}" class="text-decoration-none">
                                    <div class="card border-0 rounded-25 mb-4 hover-effect h-125px">
                                        <div
                                            class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                                            <i class="fas fa-plus-circle text-primary" style="font-size: 3rem;"></i>
                                            <h3 class="mt-3 text-dark fw-bold">Add New Progress</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif@php
                            $canCreate =
                                collect(session('user_permissions', []))->firstWhere(
                                    'route_name',
                                    'workorderprogressmaster',
                                )['can_create'] ?? false;
                        @endphp
                        @if ($canCreate)
                            <div class="col-12 col-md-6 col-lg-3">
                                <a href="{{ route('workorderprogressmaster.create') }}" class="text-decoration-none">
                                    <div class="card border-0 rounded-25 mb-4 hover-effect h-125px">
                                        <div
                                            class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                                            <i class="fas fa-plus-circle text-primary" style="font-size: 3rem;"></i>
                                            <h3 class="mt-3 text-dark fw-bold">Add New Progress</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif@php
                            $canCreate =
                                collect(session('user_permissions', []))->firstWhere(
                                    'route_name',
                                    'workorderprogressmaster',
                                )['can_create'] ?? false;
                        @endphp
                        @if ($canCreate)
                            <div class="col-12 col-md-6 col-lg-3">
                                <a href="{{ route('workorderprogressmaster.create') }}" class="text-decoration-none">
                                    <div class="card border-0 rounded-25 mb-4 hover-effect h-125px">
                                        <div
                                            class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                                            <i class="fas fa-plus-circle text-primary" style="font-size: 3rem;"></i>
                                            <h3 class="mt-3 text-dark fw-bold">Add New Progress</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif

                        @php
                            $canUpdate =
                                collect(session('user_permissions', []))->firstWhere(
                                    'route_name',
                                    'workorderprogressmaster',
                                )['can_update'] ?? false;
                        @endphp

                        <div>
                            <a class="btn btn-secondary" href="{{ route('workorderprogressmaster.index') }}">Back</a>


                            @if ($canUpdate)
                                <!-- Delete Button -->
                                <button type="button" class="btn btn-danger" id="deleteProgress MasterBtn">
                                    Delete
                                </button>

                                <button type="submit" class="btn btn-primary">Update</button>
                            @endif
                        </div>
                    </form>

                    <!-- Delete Form -->
                    <form id="deleteProgress MasterForm"
                        action="{{ route('workorderprogressmaster.destroy', $progressMaster->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>

                    <!-- jQuery Delete Confirmation -->
                    <script>
                        $(document).ready(function() {
                            $('#deleteProgress MasterBtn').click(function() {
                                Swal.fire({
                                    title: "Are you sure?",
                                    text: "This Progress Master will be permanently deleted!",
                                    icon: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#d33",
                                    cancelButtonColor: "#3085d6",
                                    confirmButtonText: "Yes, delete it!"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $('#deleteProgress MasterForm').submit();
                                    }
                                });
                            });
                        });
                    </script>

                    <script>
                        $(document).ready(function() {
                            $('#link').keyup(function(event) {
                                let linkInput = $('#link');
                                let linkValue = linkInput.val().trim();

                                if (linkValue && !linkValue.startsWith('http://') && !linkValue.startsWith('https://')) {
                                    linkInput.val('https://' + linkValue);
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
    <!--end::Row-->
@endsection
