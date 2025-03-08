@extends('layouts.app')

@section('title', 'Account Settings')

@section('content')
    <!--begin::Basic info-->
    @include('profile.partials.update-profile-information-form')
    <!--end::Basic info-->
    <!--begin::Sign-in Method-->
    @include('profile.partials.update-password-form')
    <!--end::Sign-in Method-->
    <!--begin::Deactivate Account-->
    @include('profile.partials.delete-user-form')
    <!--end::Deactivate Account-->

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div> --}}
@endsection
