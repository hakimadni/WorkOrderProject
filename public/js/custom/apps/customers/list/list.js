"use strict";
var KTMenusList = (function () {
    var tables = []; // Array to hold DataTables instances
    var tableElements = []; // Array to hold table elements

    // Handle delete row functionality
    var handleDeleteRows = (tableElement, tableInstance) => {
        tableElement
            .querySelectorAll('[data-kt-menu-table-filter="delete_row"]')
            .forEach((deleteButton) => {
                deleteButton.addEventListener("click", function (e) {
                    e.preventDefault();
                    const row = e.target.closest("tr"),
                        menuId = row.querySelector("td").innerText, // Assuming the first column is the ID
                        menuName = row.querySelectorAll("td")[1].innerText;

                    Swal.fire({
                        text:
                            "Are you sure you want to delete " + menuName + "?",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Yes, delete!",
                        cancelButtonText: "No, cancel",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton:
                                "btn fw-bold btn-active-light-primary",
                        },
                    }).then(function (result) {
                        if (result.value) {
                            // Perform the deletion via AJAX
                            fetch(`/menus/${menuId}`, {
                                method: "DELETE",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": document.querySelector(
                                        'meta[name="csrf-token"]'
                                    ).content,
                                },
                            })
                                .then((response) => {
                                    if (response.ok) {
                                        Swal.fire({
                                            text:
                                                "You have deleted " +
                                                menuName +
                                                "!",
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton:
                                                    "btn fw-bold btn-primary",
                                            },
                                        }).then(function () {
                                            // Remove row from DataTable
                                            tableInstance
                                                .row($(row))
                                                .remove()
                                                .draw();
                                        });
                                    } else {
                                        Swal.fire({
                                            text:
                                                "Failed to delete " +
                                                menuName +
                                                ". Please try again.",
                                            icon: "error",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton:
                                                    "btn fw-bold btn-primary",
                                            },
                                        });
                                    }
                                })
                                .catch(() => {
                                    Swal.fire({
                                        text:
                                            "An error occurred while deleting " +
                                            menuName +
                                            ".",
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton:
                                                "btn fw-bold btn-primary",
                                        },
                                    });
                                });
                        } else if (result.dismiss === "cancel") {
                            Swal.fire({
                                text: menuName + " was not deleted.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                },
                            });
                        }
                    });
                });
            });
    };

    // Initialize DataTable
    var initDataTable = (tableElement) => {
        const tableInstance = $(tableElement).DataTable({
            info: false,
            order: [],
            columnDefs: [
                { orderable: false, targets: [0, 7] }, // Disable ordering for specific columns
            ],
        });

        // Store the table instance and element for later use
        tables.push(tableInstance);
        tableElements.push(tableElement);

        // Handle delete rows functionality
        handleDeleteRows(tableElement, tableInstance);

        return tableInstance;
    };

    // Handle combined search for both tables
    var handleSearch = (searchInput) => {
        searchInput.addEventListener("keyup", function (e) {
            const searchTerm = e.target.value;
            tables.forEach((table) => {
                table.search(searchTerm).draw();
            });
        });
    };

    return {
        init: function () {
            const searchInput = document.querySelector(
                '[data-kt-menu-table-filter="search"]'
            );
            const table1 = document.querySelector("#kt_menus_table");
            const table2 = document.querySelector("#kt_child_menus_table");

            if (table1) {
                initDataTable(table1);
            }

            if (table2) {
                initDataTable(table2);
            }

            // Handle global search for both tables
            if (searchInput) {
                handleSearch(searchInput);
            }
        },
    };
})();

var KTRolesList = (function () {
    var tables = []; // Array to hold DataTables instances
    var tableElements = []; // Array to hold table elements

    // Handle delete row functionality
    var handleDeleteRows = (tableElement, tableInstance) => {
        tableElement
            .querySelectorAll('[data-kt-role-table-filter="delete_row"]')
            .forEach((deleteButton) => {
                deleteButton.addEventListener("click", function (e) {
                    e.preventDefault();
                    const row = e.target.closest("tr"),
                        roleId = row.querySelector("td").innerText, // Assuming the first column is the ID
                        roleName = row.querySelectorAll("td")[1].innerText;

                    Swal.fire({
                        text:
                            "Are you sure you want to delete the role " +
                            roleName +
                            "?",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Yes, delete!",
                        cancelButtonText: "No, cancel",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton:
                                "btn fw-bold btn-active-light-primary",
                        },
                    }).then(function (result) {
                        if (result.value) {
                            // Perform the deletion via AJAX
                            fetch(`/roles/${roleId}`, {
                                method: "DELETE",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": document.querySelector(
                                        'meta[name="csrf-token"]'
                                    ).content,
                                },
                            })
                                .then((response) => {
                                    if (response.ok) {
                                        Swal.fire({
                                            text:
                                                "You have deleted the role " +
                                                roleName +
                                                "!",
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton:
                                                    "btn fw-bold btn-primary",
                                            },
                                        }).then(function () {
                                            // Remove row from DataTable
                                            tableInstance
                                                .row($(row))
                                                .remove()
                                                .draw();
                                        });
                                    } else {
                                        Swal.fire({
                                            text:
                                                "Failed to delete the role " +
                                                roleName +
                                                ". Please try again.",
                                            icon: "error",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton:
                                                    "btn fw-bold btn-primary",
                                            },
                                        });
                                    }
                                })
                                .catch(() => {
                                    Swal.fire({
                                        text:
                                            "An error occurred while deleting the role " +
                                            roleName +
                                            ".",
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton:
                                                "btn fw-bold btn-primary",
                                        },
                                    });
                                });
                        } else if (result.dismiss === "cancel") {
                            Swal.fire({
                                text: roleName + " was not deleted.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                },
                            });
                        }
                    });
                });
            });
    };

    // Initialize DataTable for roles
    var initDataTable = (tableElement) => {
        const tableInstance = $(tableElement).DataTable({
            info: false,
            order: [],
            columnDefs: [
                { orderable: false, targets: [0, 4] }, // Disable ordering for specific columns
            ],
        });

        // Store the table instance and element for later use
        tables.push(tableInstance);
        tableElements.push(tableElement);

        // Handle delete rows functionality
        handleDeleteRows(tableElement, tableInstance);

        return tableInstance;
    };

    // Handle combined search for both tables
    var handleSearch = (searchInput) => {
        searchInput.addEventListener("keyup", function (e) {
            const searchTerm = e.target.value;
            tables.forEach((table) => {
                table.search(searchTerm).draw();
            });
        });
    };

    return {
        init: function () {
            const searchInput = document.querySelector(
                '[data-kt-role-table-filter="search"]'
            );
            const table1 = document.querySelector("#kt_roles_table");

            if (table1) {
                initDataTable(table1);
            }

            // Handle global search for roles table
            if (searchInput) {
                handleSearch(searchInput);
            }
        },
    };
})();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTMenusList.init();
    KTRolesList.init();
});
