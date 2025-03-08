@extends('layouts.app')

@section('title', 'Menu List')
@php
    use Illuminate\Support\Str;
    $parentMenus = $menus->whereNull('parent_id');
    $childMenus = $menus->whereNotNull('parent_id');
@endphp
@section('content')
    <!--begin::Row-->
    <div class="row">
        <!-- Parent and Non-Parent Menus DataTable -->
        <!--begin::Card-->
        <div class="card mb-10">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                    transform="rotate(45 17.0365 15.1223)" fill="black" />
                                <path
                                    d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                    fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <input type="text" data-kt-menu-table-filter="search"
                            class="form-control form-control-solid w-250px ps-15" placeholder="Search Menu" />
                    </div>
                    <!--end::Search-->
                </div>
                <!--begin::Card title-->

                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-menu-table-toolbar="base">
                        <!--begin::Add menu-->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_add_menu">Add Menu</button>
                        <!--end::Add menu-->
                    </div>
                    <!--end::Toolbar-->
                    <!--begin::Group actions-->
                    <div class="d-flex justify-content-end align-items-center d-none" data-kt-menu-table-toolbar="selected">
                        <div class="fw-bolder me-5">
                            <span class="me-2" data-kt-menu-table-select="selected_count"></span>Selected
                        </div>
                        <button type="button" class="btn btn-danger" data-kt-menu-table-select="delete_selected">Delete
                            Selected</button>
                    </div>
                    <!--end::Group actions-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_menus_table">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="">ID</th>
                            <th class="min-w-125px">Name</th>
                            <th class="min-w-125px">Icon</th>
                            <th class="min-w-125px">Route/Link</th>
                            <th class="min-w-50px">No. Menu</th>
                            <th class="min-w-125px">Parent of</th>
                            <th class="min-w-50px">Showed</th>
                            <th class="text-end min-w-70px">Actions</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="fw-bold text-gray-600">
                        @foreach ($parentMenus as $menu)
                            <tr>
                                <!--begin::Checkbox-->
                                <td>{{ $menu->id }}</td>
                                <!--end::Checkbox-->

                                <!--begin::Name=-->
                                <td>{{ strtoupper($menu->name) }}</td>
                                <!--end::Name=-->

                                <!--begin::icon=-->
                                <td><span class="menu-icon">{!! $menu->icon !!} :
                                        '{{ $menu->icon }}'</span>
                                </td>
                                <!--end::icon=-->
                                <!--begin::route=-->
                                <td>
                                    @if ($menu->route)
                                        @if (Str::contains($menu->route, '.edit'))
                                            {{ $menu->route }} <br>
                                            <a href="{{ route($menu->route) }}">{{ route($menu->route) }}</a>
                                        @else
                                            {{ $menu->route }} <br>
                                            <a
                                                href="{{ route($menu->route . '.index') }}">{{ route($menu->route . '.index') }}</a>
                                        @endif
                                    @endif
                                </td>
                                <!--end::route=-->
                                <!--begin::menu number=-->
                                <td>{{ $menu->no_menu }}</td>
                                <!--end::menu number=-->
                                <!--begin::Parent of=-->
                                <td>Parent of</td>
                                <!--end::Parent of=-->
                                <!--begin::showed=-->
                                <td>{{ $menu->showed ? 'Yes' : 'No' }}</td>
                                <!--end::showed=-->
                                <!--begin::Action=-->
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-active-light-primary"
                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                        <span class="svg-icon svg-icon-5 m-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                    fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon--></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                                        data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="{{ route('menus.show', $menu->id) }}"
                                                class="btn btn-light-primary btn-sm">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <button type="button" class="btn btn-light-warning btn-sm edit-menu-btn"
                                                data-menu="{{ $menu }}">Edit</button>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            @if (auth()->user()->role_id == 1)
                                                <button type="button" class="btn btn-light-danger btn-sm"
                                                    data-kt-menu-table-filter="delete_row">
                                                    Delete
                                                </button>
                                            @endif
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                                <!--end::Action=-->
                            </tr>
                        @endforeach

                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->

        <!--begin::Child Card-->
        <div class="card">
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_child_menus_table">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="">ID</th>
                            <th class="min-w-125px">Name</th>
                            <th class="min-w-125px">Icon</th>
                            <th class="min-w-125px">Route/Link</th>
                            <th class="min-w-50px">No. Menu</th>
                            <th class="min-w-125px">Child of</th>
                            <th class="min-w-50px">Showed</th>
                            <th class="text-end min-w-70px">Actions</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="fw-bold text-gray-600">
                        @foreach ($childMenus as $menu)
                            @php
                                $parentMenu = $parentMenus->where('id', $menu->parent_id)->first();
                            @endphp
                            <tr>
                                <!--begin::Checkbox-->
                                <td>{{ $menu->id }}</td>
                                <!--end::Checkbox-->
                                <!--begin::Name=-->
                                <td>{{ strtoupper($menu->name) }}</td>
                                <!--end::Name=-->
                                <!--begin::icon=-->
                                <td><span class="menu-icon">{!! $menu->icon !!} :
                                        '{{ $menu->icon }}'</span>
                                </td>
                                <!--end::icon=-->
                                <!--begin::route=-->
                                <td>
                                    @if ($menu->route)
                                        @if (Str::contains($menu->route, '.edit'))
                                            {{ $menu->route }} <br>
                                            <a href="{{ route($menu->route) }}">{{ route($menu->route) }}</a>
                                        @else
                                            {{ $menu->route }} <br>
                                            <a
                                                href="{{ route($menu->route . '.index') }}">{{ route($menu->route . '.index') }}</a>
                                        @endif
                                    @endif
                                </td>
                                <!--end::route=-->
                                <!--begin::menu number=-->
                                <td>{{ $menu->no_menu }}</td>
                                <!--end::menu number=-->
                                <!--begin::Parent of=-->
                                <td>{{ $parentMenu ? strtoupper($parentMenu->name) : 'N/A' }}</td>
                                <!--end::Parent of=-->
                                <!--begin::showed=-->
                                <td>{{ $menu->showed ? 'No' : 'Yes' }}</td>
                                <!--end::showed=-->
                                <!--begin::Action=-->
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-active-light-primary"
                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                        <span class="svg-icon svg-icon-5 m-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                    fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon--></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                                        data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="{{ route('menus.show', $menu->id) }}"
                                                class="btn btn-light-primary btn-sm">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <button type="button" class="btn btn-light-warning btn-sm edit-menu-btn"
                                                data-menu="{{ $menu }}" data-bs-toggle="modal"
                                                data-bs-target="#kt_modal_update_role">Edit</button>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            @if ($menu->role_id != 1)
                                                <button type="button" class="btn btn-light-danger btn-sm"
                                                    data-kt-menu-table-filter="delete_row">
                                                    Delete
                                                </button>
                                            @endif
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                                <!--end::Action=-->
                            </tr>
                        @endforeach

                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Row-->


    <!--begin::Modals-->
    <!-- Add Menu Modal -->
    <div class="modal fade" id="kt_modal_add_menu" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addMenuForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="addName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="addName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="addRoute" class="form-label">Route<i
                                            class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                            title="Route Resource cth: posts, menus"></i></label>
                                    <input type="text" class="form-control" id="addRoute" name="route">
                                </div>
                                <div class="col">
                                    <label for="addShow" class="form-label">Show</label>
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" name="show" value=""
                                            id="addShow" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="addIcon" class="form-label">Icon<i class="fas fa-exclamation-circle ms-2 fs-7"
                                    data-bs-toggle="tooltip"
                                    title="icon Font awesome cth: <i class='fas fa-file'></i>"></i></label>
                            <input type="text" class="form-control" id="addIcon" name="icon">
                        </div>
                        <div class="mb-3">
                            <label for="addNoMenu" class="form-label">Menu Order<i
                                    class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Urutan Menu saat Tampil"></i></label>
                            <input type="number" class="form-control" id="addNoMenu" name="no_menu">
                        </div>
                        <div class="mb-3">
                            <label for="addParentId" class="form-label">Parent Menu</label>
                            <select class="form-select" id="addParentId" name="parent_id">
                                <option value="">None</option>
                                @foreach ($parentMenus as $menu)
                                    <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Menu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Menu Modal -->
    <div class="modal fade" id="editMenuModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editMenuForm">
                    <div class="modal-body">
                        <input type="hidden" id="editMenuId" name="id">
                        <div class="mb-3">
                            <label for="editName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="editRoute" class="form-label">Route<i
                                            class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                            title="Route Resource cth: posts, menus"></i></label>
                                    <input type="text" class="form-control" id="editRoute" name="route">
                                </div>
                                <div class="col">
                                    <label for="editShow" class="form-label">Show</label>
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" name="showed" value=""
                                            id="editShow" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="editIcon" class="form-label">Icon</label>
                            <input type="text" class="form-control" id="editIcon" name="icon">
                        </div>
                        <div class="mb-3">
                            <label for="editNoMenu" class="form-label">Menu Order</label>
                            <input type="number" class="form-control" id="editNoMenu" name="no_menu">
                        </div>
                        <div class="mb-3">
                            <label for="editParentId" class="form-label">Parent Menu</label>
                            <select class="form-select" id="editParentId" name="parent_id">
                                <option value="">None</option>
                                @foreach ($parentMenus as $menu)
                                    <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Menu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Add Menu
            $("#addMenuForm").submit(function(e) {
                e.preventDefault();
                const formData = {};

                // Manually collect form data and convert it into a JSON object
                $("#addMenuForm").serializeArray().map(function(field) {
                    formData[field.name] = field.value;
                });

                $.ajax({
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    url: "/menus",
                    method: "POST",
                    data: JSON.stringify(formData),
                    success: function(response) {
                        $("#addMenuModal").modal("hide");
                        Swal.fire({
                            title: "Success",
                            text: "Menu Added successfully!",
                            icon: "success",
                            showConfirmButton: true,
                            timer: 1500, // Show alert for 5 seconds
                            timerProgressBar: true, // Enable progress bar
                            didClose: () => {
                                // Reload the page after the alert closes
                                location.reload();
                            },
                            customClass: {
                                confirmButton: "btn btn-success", // Customize the confirm button style
                            }
                        });
                    },
                    error: function(xhr) {
                        Swal.fire("Error", xhr.responseJSON.message, "error");
                    },
                });
            });

            // Edit Menu - Populate modal
            $(document).on("click", ".edit-menu-btn", function() {
                const menu = $(this).data("menu"); // Assuming you pass menu data
                console.log(menu);

                $("#editMenuId").val(menu.id);
                $("#editName").val(menu.name);
                $("#editRoute").val(menu.route);
                $("#editIcon").val(menu.icon);
                $("#editNoMenu").val(menu.no_menu);
                $("#editParentId").val(menu.parent_id);
                // Set checkbox value based on `menu.showed`
                if (menu.showed) {
                    $("#editShow").prop("checked", true);
                } else {
                    $("#editShow").prop("checked", false);
                }
                $("#editMenuModal").modal("show");
            });

            // Update Menu
            $("#editMenuForm").submit(function(e) {
                e.preventDefault();

                const menuId = $("#editMenuId").val();
                const formData = {};

                // Manually collect form data and convert it into a JSON object
                $("#editMenuForm").serializeArray().map(function(field) {
                    formData[field.name] = field.value;
                });
                console.log(formData);

                $.ajax({
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    url: `/menus/${menuId}`,
                    method: "PUT",
                    data: JSON.stringify(formData), // Send data as JSON
                    success: function(response) {
                        $("#editMenuModal").modal("hide");
                        Swal.fire({
                            title: "Success",
                            text: "Menu updated successfully!",
                            icon: "success",
                            showConfirmButton: true,
                            timer: 1500, // Show alert for 5 seconds
                            timerProgressBar: true, // Enable progress bar
                            didClose: () => {
                                // Reload the page after the alert closes
                                location.reload();
                            },
                            customClass: {
                                confirmButton: "btn btn-success", // Customize the confirm button style
                            }
                        });
                    },
                    error: function(xhr) {
                        Swal.fire("Error", xhr.responseJSON.message, "error");
                    },
                });
            });

        });
    </script>
    <!--end::Modals-->

    <script>
        function confirmDelete(roleId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Temukan dan submit formulir
                    document.getElementById('delete-form-' + roleId).submit();
                }
            });
        }
    </script>
@endsection
