<div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
        data-bs-target="#kt_account_signin_method">
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">Reset Password</h3>
        </div>
    </div>
    <!--end::Card header-->
    <!--begin::Content-->
    <div id="kt_account_signin_method" class="collapse show">
        <!--begin::Card body-->
        <div class="card-body border-top p-9">
            <!--begin::Password-->
            <div class="d-flex flex-wrap align-items-center mb-10">
                <!--begin::Edit-->
                <div id="kt_signin_password_edit" class="flex-row-fluid">
                    <!--begin::Form-->
                    <form id="kt_signin_change_password" method="post" action="{{ route('password.update') }}"
                        class="form" novalidate="novalidate">
                        @csrf
                        @method('put')

                        <!--begin::Row-->
                        <div class="row mb-1">
                            <!--begin::Col-->
                            <div class="col-lg-4">
                                <div class="fv-row mb-0">
                                    <label for="update_password_current_password"
                                        class="form-label fs-6 fw-bolder mb-3">Current Password</label>
                                    <input type="password" class="form-control form-control-lg form-control-solid"
                                        name="current_password" id="update_password_current_password"
                                        autocomplete="current-password" />
                                    @if ($errors->updatePassword->has('current_password'))
                                        <div class="form-text text-danger">
                                            {{ $errors->updatePassword->first('current_password') }}</div>
                                    @endif
                                </div>
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-4">
                                <div class="fv-row mb-0">
                                    <label for="update_password_password" class="form-label fs-6 fw-bolder mb-3">New
                                        Password</label>
                                    <input type="password" class="form-control form-control-lg form-control-solid"
                                        name="password" id="update_password_password" autocomplete="new-password" />
                                    @if ($errors->updatePassword->has('password'))
                                        <div class="form-text text-danger">
                                            {{ $errors->updatePassword->first('password') }}</div>
                                    @endif
                                </div>
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-4">
                                <div class="fv-row mb-0">
                                    <label for="update_password_password_confirmation"
                                        class="form-label fs-6 fw-bolder mb-3">Confirm New Password</label>
                                    <input type="password" class="form-control form-control-lg form-control-solid"
                                        name="password_confirmation" id="update_password_password_confirmation"
                                        autocomplete="new-password" />
                                    @if ($errors->updatePassword->has('password_confirmation'))
                                        <div class="form-text text-danger">
                                            {{ $errors->updatePassword->first('password_confirmation') }}</div>
                                    @endif
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->

                        <div class="form-text mb-5">Password must be at least 8 characters and contain symbols.</div>

                        <!--begin::Actions-->
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary me-2 px-6" id="kt_password_submit">Update
                                Password</button>
                            <button type="button" class="btn btn-color-gray-400 btn-active-light-primary px-6"
                                id="kt_password_cancel">Cancel</button>
                        </div>
                        <!--end::Actions-->
                        @if (session('status') === 'password-updated')
                            <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Password Updated',
                                    text: 'New password has been applied to your Account.',
                                    showConfirmButton: true,
                                    timer: 1500,
                                    timerProgressBar: true,
                                });
                            </script>
                        @endif
                    </form>

                    <!--end::Form-->
                </div>
                <!--end::Edit-->
            </div>
            <!--end::Password-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Content-->
</div>

{{-- <section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section> --}}
