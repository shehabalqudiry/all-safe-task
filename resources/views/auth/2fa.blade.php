<x-guest-layout>


    <div class="container text-white">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Two Factor Authentication') }}</div>

                    <div class="card-body">
                        <p>{{ __('Please enter your one-time password to complete your login.') }}</p>

                        <form method="POST" action="{{ route('2fa.verify') }}">
                            @csrf

                            <div class="form-group row mb-2">
                                <label for="one_time_password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('One Time Password') }}</label>

                                <div class="col-md-12">
                                    <input id="one_time_password" type="text"
                                        class="block mt-1 w-full text-black @error('one_time_password') is-invalid @enderror"
                                        name="one_time_password" required autofocus>

                                    @error('one_time_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-center mt-4 mb-4">
                                <x-primary-button class="mt-4 ">
                                    {{ __('Verify') }}
                                </x-primary-button>
                            </div>

                        </form>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
