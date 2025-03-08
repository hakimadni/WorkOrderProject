@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!--begin::Post-->
    <div class="post" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container">
            <div class="row mb-10">
                <div class="col-12">
                    <!--begin::Card-->
                    <div class="card">
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h1>Welcome {{ auth()->user()->name }} </h1>
                            </div>
                            <!--begin::Card title-->
                        </div>
                        <!--end::Card header-->
                    </div>
                    <!--end::Card-->
                </div>
            </div>
            <div class="row mb-10">
                <div class="col-6">
                    <!--begin::Card-->
                    <div class="card">
                        <!--begin::Card body-->
                        <div class="card-body">
                            @php
                                $permissions = session('user_permissions', []);
                            @endphp

                            @if (!empty($permissions))
                                <div class="table-responsive">
                                    <table class="table table-striped" id="permission_tbl">
                                        <thead>
                                            <tr>
                                                <th>Menu</th>
                                                <th>Can Create</th>
                                                <th>Can Read</th>
                                                <th>Can Update</th>
                                                <th>Can Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($permissions as $item)
                                                @php
                                                    $menu = \App\Models\Menu::find($item['menu_id']); // Fetch menu details
                                                @endphp
                                                <tr>
                                                    <td>{{ $menu->name ?? 'Unknown' }}</td>
                                                    <td>
                                                        @if ($item['can_create'])
                                                            <span class="badge bg-success">Yes</span>
                                                        @else
                                                            <span class="badge bg-danger">No</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item['can_read'])
                                                            <span class="badge bg-success">Yes</span>
                                                        @else
                                                            <span class="badge bg-danger">No</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item['can_update'])
                                                            <span class="badge bg-success">Yes</span>
                                                        @else
                                                            <span class="badge bg-danger">No</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item['can_delete'])
                                                            <span class="badge bg-success">Yes</span>
                                                        @else
                                                            <span class="badge bg-danger">No</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted">No permissions found for the logged-in user.</p>
                            @endif
                        </div>
                        <!--end::Card body-->

                    </div>
                    <!--end::Card-->
                </div>
                <div class="col-6">
                    @if (auth()->user()->role_id == (1 || 2))
                        <div class="row mb-5">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h3>User count</h3>
                                        <h1>25</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h3>Payment pending</h3>
                                        <h1>25</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h3>Payment Total</h3>
                                        <h1>Rp. 1.200.000</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h3>Payment Done</h3>
                                        <h1>12</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                    @endif
                </div>

            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->

    <script>
        $(document).ready(function() {
            var table = $('#permission_tbl').DataTable()
        });
    </script>
@endsection
