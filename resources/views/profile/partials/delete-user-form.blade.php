<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
        data-bs-target="#kt_account_deactivate" aria-expanded="true" aria-controls="kt_account_deactivate">
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">Delete Account</h3>
        </div>
    </div>
    <!--end::Card header-->
    <!--begin::Content-->
    <div id="kt_account_deactivate" class="collapse show">
        <!--begin::Form-->
        <form id="kt_account_deactivate_form" method="post" action="{{ route('profile.destroy') }}" class="form">
            @csrf
            @method('delete')

            <!--begin::Card body-->
            <div class="card-body border-top p-9">
                <!--begin::Notice-->
                <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                    <!--begin::Icon-->
                    <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10"
                                fill="black" />
                            <rect x="11" y="14" width="7" height="2" rx="1"
                                transform="rotate(-90 11 14)" fill="black" />
                            <rect x="11" y="17" width="2" height="2" rx="1"
                                transform="rotate(-90 11 17)" fill="black" />
                        </svg>
                    </span>
                    <!--end::Icon-->

                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack flex-grow-1">
                        <!--begin::Content-->
                        <div class="fw-bold">
                            <h4 class="text-gray-900 fw-bolder">You Are Deleting Your Account</h4>
                            <p class="mt-1 text-gray-600 fs-6">Once your account is deleted, all of its resources and
                                data will be permanently deleted. Please enter your password to confirm you would like
                                to permanently delete your account.</p>
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Notice-->

                <!--begin::Form input row-->
                <!--begin::Row-->
                <div class="row mb-1">
                    <!--begin::Col-->
                    <div class="col-lg-4">
                        <div class="fv-row mb-0">
                            <label for="update_password_current_password" class="form-label fs-6 fw-bolder mb-3">Enter
                                Password</label>
                            <input type="password"
                                class="form-control form-control-lg form-control-solid mt-1 block w-3/4 mb-3"
                                name="password" id="password" placeholder="Password" />
                            @if ($errors->userDeletion->has('password'))
                                <div class="form-text text-danger mt-2">{{ $errors->userDeletion->first('password') }}
                                </div>
                            @endif
                        </div>
                        <!--begin::Form input row-->
                        <div class="fv-row mb-0">
                            <div class="form-check form-check-solid fv-row">
                                <input name="deactivate" class="form-check-input" type="checkbox" value=""
                                    id="deactivate" />
                                <label class="form-check-label fw-bold ps-2 fs-6" for="deactivate">I confirm my account
                                    delete</label>
                            </div>
                        </div>
                        <!--end::Form input row-->
                    </div>
                    <!--begin::Col-->
                    <div class="col-lg-4 mt-13">
                    </div>
                </div>
                <!--end::Form input row-->
            </div>
            <!--end::Card body-->

            <!--begin::Card footer-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button id="kt_account_deactivate_account_submit" type="submit"
                    class="btn btn-danger fw-bold me-2">Delete Account</button>
                <button type="button" class="btn btn-secondary" x-on:click="$dispatch('close')">Cancel</button>
            </div>
            <!--end::Card footer-->
        </form>

        <!--end::Form-->
    </div>
    <!--end::Content-->
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkbox = document.getElementById('deactivate');
        const submitButton = document.getElementById('kt_account_deactivate_account_submit');
        const submitPassword = document.getElementById('password');

        // Disable the button by default
        submitButton.disabled = true;
        submitPassword.disabled = true;

        // Add event listener to the checkbox
        checkbox.addEventListener('change', function() {
            if (checkbox.checked) {
                submitButton.disabled = false; // Enable the button
                submitPassword.disabled = false; // Enable the button
            } else {
                submitButton.disabled = true; // Disable the button
                submitPassword.disabled = true; // Disable the button
            }
        });
    });
</script>

{{-- <section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section> --}}
