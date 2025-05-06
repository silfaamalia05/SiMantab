<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('storage/simantab.png') }}" type="image/x-icon">

    <title>Login | Simantab</title>
</head>

<body>
    <div id="app">
        <main class="py-4">
            <div>
                <div class="row justify-content-center w-full">
                    <section class="bg-gray-50 dark:bg-gray-900">
                        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                            <div
                                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                                    <div class="flex items-center w-full justify-center">
                                        <img src="{{ asset('storage/simantab.png') }}" alt="SiMantab Logo"
                                            class="h-12 mr-3">
                                    </div>
                                    <div class="flex flex-col space-y-1" style="margin-top:7px">
                                        <a
                                            class="text-sm font-normal tracking-normal text-gray-600 text-center dark:text-white">
                                            Silahkan masuk menggunakan
                                        </a>
                                        <a
                                            class="mt-2 text-sm font-normal tracking-normal text-gray-600 text-center dark:text-white">Akun
                                            SiMantab</a>
                                    </div>
                                    <!-- Notifikasi -->
                                    @if (session('success'))
                                        <div id="alert-success"
                                            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                                            <span class="block sm:inline">{{ session('success') }}</span>
                                        </div>
                                    @endif
                                    @if (session('error'))
                                        <div id="alert-error"
                                            class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                                            <span class="block sm:inline">{{ session('error') }}</span>
                                        </div>
                                    @endif
                                    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div>
                                            <label for="email"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                                email</label>
                                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                                required autocomplete="email" autofocus
                                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('email') is-invalid @enderror">
                                            @error('email')
                                                <span class="text-sm text-red-500" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="password"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                            <input id="password" type="password" name="password" required
                                                autocomplete="current-password"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('password') is-invalid @enderror">
                                            @error('password')
                                                <span class="text-sm text-red-500" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-start">
                                                <div class="flex items-center h-5">
                                                    <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}
                                                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
                                                </div>
                                                <div class="ml-3 text-sm">
                                                    <label for="remember"
                                                        class="text-gray-500 dark:text-gray-300">Remember
                                                        me</label>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                                            Don't have an account?
                                            <a href="{{ route('register') }}"
                                                class="text-primary-600 hover:underline dark:text-primary-500">
                                                Register here
                                            </a>
                                        </p>
                                        <button type="submit" style="background-color: #053c8f"
                                            class="w-full text-white hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                            Sign in
                                        </button>
                                        <div class="w-full flex items-center justify-center">
                                            <a href="{{ route('home') }}"
                                                class="text-sm font-light text-center w-full text-gray-500 dark:text-gray-400"
                                                style="color: #053c8f">Kembali ke halaman awal</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </main>
    </div>

    <script>
        setTimeout(function () {
            document.querySelectorAll('[id^="alert-"]').forEach(alert => {
                alert.style.transition = "opacity 0.5s ease-out";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500);
            });
        }, 3000);
    </script>
</body>

</html>