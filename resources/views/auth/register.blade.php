<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('storage/simantab.png') }}" type="image/x-icon">
    <title>Register | Simantab</title>
</head>

<body>
    <div id="app">
        <main class="py-4">
            <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">
                <div
                    class="w-full bg-white rounded-lg shadow dark:border sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <div class="flex items-center w-full justify-center">
                            <img src="{{ asset('storage/simantab.png') }}" alt="SiMantab Logo" class="h-12 mr-3">
                        </div>
                        <a style="margin-top:7px" class="flex w-full justify-center text-sm font-normal tracking-normal text-gray-600 dark:text-white">
                            Silahkan buat akun baru
                        </a>
                        <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('register-user') }}">
                            @csrf
                            @method('POST')
                            <div>
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                    Lengkap</label>
                                <input id="name" type="text" name="name" required autocomplete="false" readonly onfocus="this.removeAttribute('readonly')"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            </div>
                            <div>
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input id="email" type="email" name="email" required readonly onfocus="this.removeAttribute('readonly')"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            </div>
                            <div>
                                <label for="password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                <input id="password" type="password" name="password" required
                                    autocomplete="new-password"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            </div>
                            <div>
                                <label for="password-confirm"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Konfirmasi
                                    Password</label>
                                <input id="password-confirm" type="password" name="password_confirmation" required
                                    autocomplete="new-password"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            </div>
                            <div>
                                <label for="role"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Role') }}</label>
                                <select id="role" required name="role"
                                    class="form-select bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                                    <option value="INTERNALBWS">{{ __('Internal BWS') }}</option>
                                    <option value="SATGAS">{{ __('Satgas') }}</option>
                                    <option value="STAKEHOLDER">{{ __('Stakeholder') }}</option>
                                </select>
                            </div>
                            <button type="submit" style="background-color: #053c8f"
                                class="w-full text-white hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                Daftar
                            </button>
                            <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                                Sudah punya akun?
                                <a href="{{ route('login') }}"
                                    class="text-primary-600 hover:underline dark:text-primary-500">
                                    Masuk di sini
                                </a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>