@extends('layouts.app')

@section('title', 'Progress Master Details')
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
                        {{ $media->name }} Progress Master Details
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="row">
                        <!-- First Column -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Progress Master Name:</label>
                                <input type="text" id="name" class="form-control" value="{{ $media->name }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description:</label>
                                <input type="text" id="description" class="form-control"
                                    value="{{ $media->description }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="report_title" class="form-label">Report Titles:</label>
                                <input type="text" id="report_title" class="form-control"
                                    value="{{ $media->report_title }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="status_id" class="form-label">Status:</label>
                                <input type="text" id="status_id" class="form-control"
                                    value="{{ $media->status_id == 1 ? 'Active' : 'Inactive' }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="report_periode" class="form-label">Report Period:</label>
                                <input type="text" id="report_periode" class="form-control"
                                    value="{{ ucfirst($media->report_periode) }}" readonly>
                            </div>
                        </div>

                        <!-- Second Column -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="report_visibility" class="form-label">Report Visibility:</label>
                                <input type="text" id="report_visibility" class="form-control"
                                    value="{{ ucfirst($media->report_visibility) }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="budget" class="form-label">Budget:</label>
                                <input type="text" id="budget" class="form-control"
                                    value="{{ $media->budget ? number_format($media->budget, 2) : '-' }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="bank_account_id" class="form-label">Bank Account:</label>
                                <input type="text" id="bank_account_id" class="form-control"
                                    value="{{ $media->bankAccount ? $media->bankAccount->name : '--None Bank Account--' }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label for="treasury_id" class="form-label">Treasury:</label>
                                <input type="text" id="treasury_id" class="form-control"
                                    value="{{ $media->treasury ? $media->treasury->name : 'Admin Only' }}" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Back Button -->
                    <div>
                        <a href="{{ route('medias.index') }}" class="btn btn-secondary">Back</a>
                        <a href="{{ route('medias.edit', $media) }}" class="btn btn-primary">Edit</a>
                    </div>
                </div>
                <!--end::Card body-->


            </div>
            <!--end::Card-->
        </div>
    </div>
    <!--end::Row-->
@endsection
