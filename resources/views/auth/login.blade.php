<x-guest-layout>
    <div class="wrap-login100">

        <form class="login100-form validate-form" action="{{ route('login') }}" method="POST">
            @csrf
            <span class="login100-form-logo">
                <img src="masuk/images/logo.jpg">
            </span>

            <span class="login100-form-title p-b-10 p-t-27">
                Sistem Absensi Berbasis Face Print
            </span>
            <span class="login100-form-subtitle p-b-34 ">
                Jenderal Software
            </span>

            <!-- Session Status -->
            <x-auth-session-status class="alert alert-danger mb-4" :status="session('status')" />
            <!-- Validation Errors -->
            <x-auth-validation-errors class="alert alert-danger mb-4" :errors="$errors" />

            <div class="wrap-input100 validate-input" data-validate="Enter username">
                <input class="input100" type="text" name="email" placeholder="Email">
                <span class="focus-input100" data-placeholder="&#xf207;"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate="Enter password">
                <input class="input100" type="password" name="password" placeholder="Password">
                <span class="focus-input100" data-placeholder="&#xf191;"></span>
            </div>

            {{-- <div class="contact100-form-checkbox">
                <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember">
                <label class="label-checkbox100" for="ckb1">
                    Remember me
                </label>
            </div> --}}

            <div class="container-login100-form-btn">
                <button class="login100-form-btn" name="submit" type="submit">
                    Login
                </button>
            </div>
            {{-- <div class="text-center p-t-20">
                <a class="txt1" href="#">
                    Forgot Password?
                </a>
            </div> --}}
        </form>
    </div>
</x-guest-layout>
