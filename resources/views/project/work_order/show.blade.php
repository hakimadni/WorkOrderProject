@extends('layouts.app')

@section('title', 'Work Order Details')
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
                        {{ $workorder->name }} Work Order Details
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <form action="#" method="POST">
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
                                value="{{ old('product_name', $workorder->product_name) }}" readonly>
                        </div>

                        <!-- Quantity -->
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity:</label>
                            <input type="number" name="quantity" id="quantity" class="form-control"
                                value="{{ old('quantity', $workorder->quantity) }}" readonly>
                        </div>

                        <!-- Deadline -->
                        <div class="mb-3">
                            <label for="deadline" class="form-label">Deadline:</label>
                            <input type="date" name="deadline" id="deadline" class="form-control" readonly
                                value="{{ old('deadline', $workorder->deadline) }}">
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label for="status" class="form-label">Status:</label>
                            <select name="status" id="status" class="form-select" disabled>
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
                            <select name="operator_id" id="operator_id" class="form-select" disabled>
                                <option value="">-- Select Operator --</option>
                                <option value="{{ $operator->id }}"
                                    {{ old('operator_id', $operator->id) == $operator->id ? 'selected' : '' }}>
                                    {{ $operator->name }}
                                </option>
                            </select>
                        </div>

                        <!-- Back Button -->
                        <div>
                            <a href="{{ route('workorder.index') }}" class="btn btn-secondary">Back</a>
                            <a href="{{ route('workorder.edit', $workorder) }}" class="btn btn-primary">Edit</a>
                        </div>
                    </form>

                </div>
                <!--end::Card body-->


            </div>
            <!--end::Card-->
        </div>

        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Progress Timeline
                    </div>
                </div>
                <div class="card-body">
                    @foreach ($progresses as $index => $item)
                        @php
                            $nextItem = $progresses[$index + 1] ?? null;
                        @endphp

                        <div class="row">
                            <div class="col">
                                <div class="card border mb-3">
                                    <div class="card-header bg-primary">
                                        <div class="card-title text-white">
                                            {{ $item->progressMaster->name }}
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h5>{{ $item->progressMaster->description ?? 'No Description' }}</h5>

                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <strong>Started At:</strong>
                                                {{ $item->started_at ? \Carbon\Carbon::parse($item->started_at)->format('Y-m-d H:i') : '-' }}
                                            </div>
                                            <div>

                                                @if ($nextItem && $nextItem->started_at)
                                                    <div class="mt-2">
                                                        <strong>Duration:</strong>
                                                        {{ \Carbon\Carbon::parse($item->started_at)->diffForHumans($nextItem->started_at, true) }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @php
                        $canUpdate =
                            collect(session('user_permissions', []))->firstWhere('route_name', 'workorder')[
                                'can_update'
                            ] ?? false;
                    @endphp

                    @if ($canUpdate && $workorder->status < 100)
                        <div class="row">
                            <div class="col">
                                <div class="card border mb-3">
                                    <div class="card-body">
                                        <form action="{{ route('workorder.nextStep') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="work_order_number"
                                                value="{{ $workorder->work_order_number }}">
                                            <button type="submit" class="btn btn-success w-100">
                                                Next Step
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--end::Row-->
@endsection
