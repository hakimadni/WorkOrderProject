@extends('layouts.app')

@section('title', 'Create Progress Master')
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
                        Add Progress Master
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <form action="{{ route('workorderprogressmaster.store') }}" method="POST">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name') }}" required>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description:</label>
                            <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Progress Master</button>
                    </form>



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
                <!--end::Card body-->
            </div>

            <!--end::Card-->
        </div>
    </div>
    <!--end::Row-->
@endsection
