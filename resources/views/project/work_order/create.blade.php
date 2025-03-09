@extends('layouts.app')

@section('title', 'Create Work Order')
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
                        Create Work Order
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <form action="{{ route('workorder.store') }}" method="POST">
                        @csrf

                        <!-- Product Name -->
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Product Name:</label>
                            <input type="text" name="product_name" id="product_name" class="form-control"
                                value="{{ old('product_name') }}" required>
                        </div>

                        <!-- Quantity -->
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity:</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" min="1"
                                value="{{ old('quantity') }}" required>
                        </div>

                        <!-- Due Date -->
                        <div class="mb-3">
                            <label for="deadline" class="form-label">Due Date:</label>
                            <input type="date" name="deadline" id="deadline" class="form-control"
                                value="{{ old('deadline') }}" required>
                        </div>

                        <!-- Operator ID -->
                        <div class="mb-3">
                            <label for="operator_id" class="form-label">Assigned Operator:</label>
                            <select name="operator_id" id="operator_id" class="form-select" required>
                                @foreach ($operators as $operator)
                                    <option value="{{ $operator->id }}"
                                        {{ old('operator_id') == $operator->id ? 'selected' : '' }}>
                                        {{ $operator->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
                <!--end::Card body-->
            </div>

            <!--end::Card-->
        </div>
    </div>
    <!--end::Row-->
@endsection
