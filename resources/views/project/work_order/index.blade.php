@extends('layouts.app')

@section('title', 'Production')
@section('content')
    <!--begin::Trigger-->
    <button type="button" id="actionButton" class="btn btn-primary floating-button bot ctr" data-kt-menu-trigger="click"
        data-kt-menu-placement="top">
        Actions <i class="fas fa-bars"></i>
    </button>
    <script>
        $(document).ready(function() {
            $("#actionButton").on("click", function() {
                $(this).toggleClass("btn-danger"); // Toggle background color
                $(this).find("i").toggleClass("fa-bars fa-times"); // Toggle icons
            });
        });
    </script>
    <!--end::Trigger-->

    <!--begin::Menu-->
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary bg-0 fw-bold fs-7 w-200px py-4 align-items-center bg-transparent shadow-none "
        data-kt-menu="true">

        @if (auth()->user()->role_id != 3)
            <!--begin::Menu item-->
            <div class="menu-item px-3">
                <a href="{{ route('workorderreport.excel', request()->all()) }}" class="btn btn-success mb-2">Export
                    Excel</a>
            </div>
            <!--end::Menu item-->
        @endif

        <!--begin::Menu item-->
        <div class="menu-item px-3">
            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#filterModal">
                <i class="fas fa-filter"></i> Filter
            </button>
        </div>
        <!--end::Menu item-->


        <!--begin::Menu item-->
        <div class="menu-item px-3">
            <a href="{{ route('workorder.create') }}">
                <button class="btn btn-primary">Add Work Order</button>
            </a>
        </div>
        <!--end::Menu item-->
    </div>
    <!--end::Menu-->

    <div class="px-5 px-lg-10">
        <div class="row mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Progress Board
                            @if (!empty($filters))
                                Filtered :
                                @foreach ($filters as $key => $value)
                                    <span class="badge bg-primary ms-2">{{ ucfirst(str_replace('_', ' ', $key)) }}:
                                        {{ $value }}</span>
                                @endforeach
                            @endif
                        </div>
                        <div class="card-toolbar">
                            <h2 id="liveClock" class="time text-center">00:00</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--begin::Row-->
        <div class="row">
            @foreach ($groupedSteps as $key => $steps)
                <div class="col-12 col-lg-3">
                    <div class="card mb-5 rounded-25">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="text-dark fw-bold">
                                    @if ($key == '2-99')
                                        In Progress ({{ $stepCounts[$key] ?? 0 }})
                                    @else
                                        {{ $steps->name }} ({{ $stepCounts[$key] ?? 0 }})
                                    @endif
                                </h3>
                            </div>
                        </div>

                        <div class="card-body">
                            @php
                                $filteredWorkOrders =
                                    $key === '2-99'
                                        ? $workorders->whereBetween('status', [2, 99])
                                        : $workorders->where('status', $steps->step ?? null);
                            @endphp


                            @foreach ($filteredWorkOrders as $workorder)
                                <div class="card border-0 rounded-25 mb-4 hover-effect">
                                    <a href="{{ route('workorder.show', $workorder->id) }}" class="text-decoration-none">
                                        <div
                                            class="card-header {{ $workorder->status == 101 ? 'bg-danger' : 'bg-primary' }}">
                                            <div class="card-title">
                                                <h2 class="fw-bold text-dark mb-3">{{ $workorder->work_order_number }}
                                                </h2>
                                            </div>
                                        </div>
                                        <div class="card-body d-flex flex-column justify-content-center p-0">
                                            <div class="card-body">
                                                <p class="text-dark mb-2 fs-4"><strong>Progress:</strong>
                                                    {{ $workorder->lastprogress->description }}</p>
                                                <p class="text-dark mb-2 fs-4"><strong>Product:</strong>
                                                    {{ $workorder->product_name }}</p>
                                                <p class="text-dark mb-2 fs-4"><strong>Quantity:</strong>
                                                    {{ $workorder->quantity }}</p>
                                                <p class="text-dark mb-2 fs-4"><strong>Due Date:</strong>
                                                    {{ $workorder->deadline ?? 'Not Set' }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <!--end::Row-->
    </div>

    <!-- Filter Modal -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filter Work Orders</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="GET" action="{{ route('workorder.index') }}">
                    <div class="modal-body">
                        <div class="row g-3">
                            <!-- Step Filter -->
                            <div class="col-12">
                                <label class="form-label">Step</label>
                                <select name="step" class="form-select">
                                    <option value="">All Steps</option>
                                    @foreach ($progressMasters as $master)
                                        <option value="{{ $master->step }}"
                                            {{ request('step') == $master->step ? 'selected' : '' }}>
                                            {{ $master->description }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @if (auth()->user()->role_id != 3)
                                <!-- Operator Filter -->
                                <div class="col-12">
                                    <label class="form-label">Operator</label>
                                    <select name="operator_id" class="form-select">
                                        <option value="">All Operators</option>
                                        @foreach ($operators as $operator)
                                            <option value="{{ $operator->id }}"
                                                {{ request('operator_id') == $operator->id ? 'selected' : '' }}>
                                                {{ $operator->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            <!-- Date Range Filter -->
                            <div class="col-12">
                                <label class="form-label">Date Range</label>
                                <input type="text" id="kt_daterangepicker_4" name="date_range" class="form-control"
                                    value="{{ request('date_range') }}">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Apply Filters</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var urlParams = new URLSearchParams(window.location.search);
            var dateRange = urlParams.get("date_range");

            var start = moment().subtract(29, "days");
            var end = moment();

            if (dateRange) {
                var dates = dateRange.split(" - ");
                start = moment(dates[0], "DD/MM/YYYY");
                end = moment(dates[1], "DD/MM/YYYY");
            }

            function cb(start, end) {
                $("#kt_daterangepicker_4").val(start.format("DD/MM/YYYY") + " - " + end.format("DD/MM/YYYY"));
            }

            $("#kt_daterangepicker_4").daterangepicker({
                startDate: start,
                endDate: end,
                locale: {
                    format: "DD/MM/YYYY",
                },
                ranges: {
                    "Today": [moment(), moment()],
                    "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                    "Last 7 Days": [moment().subtract(6, "days"), moment()],
                    "Last 30 Days": [moment().subtract(29, "days"), moment()],
                    "This Month": [moment().startOf("month"), moment().endOf("month")],
                    "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1,
                        "month").endOf("month")],
                },
            }, cb);

            cb(start, end);
        });
    </script>

    {{-- Live Clock --}}
    <script>
        $(document).ready(function() {
            // Function to update the live clock
            function updateClock() {
                var now = new Date();
                var hours = String(now.getHours()).padStart(2, '0');
                var minutes = String(now.getMinutes()).padStart(2, '0');
                var seconds = String(now.getSeconds()).padStart(2, '0');

                // Full format (HH:MM:SS)
                var fullTime = `${hours}:${minutes}:${seconds}`;
                // Without seconds (HH:MM)
                var shortTime = `${hours}:${minutes}`;

                if (hours === "00" && minutes === "00" && seconds === "30") {
                    window.location.reload(); // Reload the window
                }

                // Check the width of the #liveClock element
                var $clock = $('#liveClock');
                var fullWidth = $clock.width();
                $clock.text(fullTime);
            }

            // Update the clock every second
            setInterval(updateClock, 1000);

            updateClock();
        });
    </script>
@endsection
