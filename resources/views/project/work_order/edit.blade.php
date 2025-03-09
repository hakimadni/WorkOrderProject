@extends('layouts.app')

@section('title', 'Edit Work Order')
@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-12 col-lg-6">
            <!--begin::Card-->
            <div class="card mb-10">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        Edit Work Order
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <form action="{{ route('workorder.update', $workorder) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Work Order Number (Read-only) -->
                        <div class="mb-3">
                            <label for="work_order_number" class="form-label">Work Order Number:</label>
                            <input type="text" name="work_order_number" id="work_order_number" class="form-control"
                                value="{{ $workorder->work_order_number }}" readonly>
                        </div>

                        <!-- Product Name -->
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Product Name:</label>
                            <input type="text" name="product_name" id="product_name" class="form-control"
                                value="{{ old('product_name', $workorder->product_name) }}" required>
                        </div>

                        <!-- Quantity -->
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity:</label>
                            <input type="number" name="quantity" id="quantity" class="form-control"
                                value="{{ old('quantity', $workorder->quantity) }}" required>
                        </div>

                        <!-- Deadline -->
                        <div class="mb-3">
                            <label for="deadline" class="form-label">Deadline:</label>
                            <input type="date" name="deadline" id="deadline" class="form-control"
                                value="{{ old('deadline', $workorder->deadline) }}">
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label for="status" class="form-label">Status:</label>
                            <select name="status" id="status" class="form-select" required>
                                @foreach ($progressMasters as $progress)
                                    <option value="{{ $progress->step }}"
                                        {{ old('status', $workorder->status) === $progress->step ? 'selected' : '' }}>
                                        {{ $progress->description }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <!-- Operator -->
                        <div class="mb-3">
                            <label for="operator_id" class="form-label">Operator:</label>
                            <select name="operator_id" id="operator_id" class="form-select">
                                <option value="">-- Select Operator --</option>
                                @foreach ($operators as $operator)
                                    <option value="{{ $operator->id }}"
                                        {{ old('operator_id', $workorder->operator_id) == $operator->id ? 'selected' : '' }}>
                                        {{ $operator->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Buttons -->
                        <div>
                            <a class="btn btn-secondary" href="{{ route('workorder.index') }}">Back</a>

                            <!-- Delete Button -->
                            <button type="button" class="btn btn-danger" id="deleteworkorderBtn">
                                Delete
                            </button>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>


                    <!-- Delete Form -->
                    <form id="deleteWorkOrderForm" action="{{ route('workorder.destroy', $workorder->id) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                    </form>

                    <!-- jQuery Delete Confirmation -->
                    <script>
                        $(document).ready(function() {
                            $('#deleteworkorderBtn').click(function() {
                                Swal.fire({
                                    title: "Are you sure?",
                                    text: "This workorder will be permanently deleted!",
                                    icon: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#d33",
                                    cancelButtonColor: "#3085d6",
                                    confirmButtonText: "Yes, delete it!"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $('#deleteWorkOrderForm').submit();
                                    }
                                });
                            });
                        });
                    </script>

                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
    </div>
    <!--end::Row-->
@endsection
