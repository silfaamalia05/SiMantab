<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('storage/simantab.png') }}" type="image/x-icon">
    <title>Simantab</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="text-center font-sans m-0 p-0">
    <header class="flex justify-between items-center p-5 bg-white">
        <div class="flex items-center">
            <img src="{{ asset('storage/simantab.png') }}" alt="SiMantab Logo" class="h-12 mr-3">
        </div>
        @guest
            <a href="{{ route('login') }}" class="bg-blue-900 text-white px-6 py-2 rounded-full no-underline">Masuk</a>
        @else
            <div class="flex items-center space-x-6 px-4" style="color:#053c8f">
                <a href="{{ url('/dashboard') }}" class="hover:underline">Dashboard</a>
                @if (in_array(auth()->user()->role, ['INTERNALBWS', 'ADMIN', 'SATGAS']))
                    <a href="{{ url('/reports') }}" class="hover:underline">Laporan</a>
                @endif
                @if (in_array(auth()->user()->role, ['ADMIN', 'STAKEHOLDER']))
                    <a href="{{ url('/actions') }}" class="hover:underline">Aksi</a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="hover:underline">Logout</button>
                </form>
            </div>
        @endguest
    </header>
    <main class="p-5 flex justify-between items-center" style="color:#053c8f">
        <div class="text-left p-5 pr-8 w-2/3">
            <a class="font-bold text-6xl">Selamat Datang di SiMantab</a>
            <p class="max-w-full text-2xl text-justify mt-6">
                Sistem Informasi Manajemen Terpadu Banjir merupakan sistem informasi yang
                mengintegrasikan kegiatan pemantauan, analisis, dan pengelolaan risiko banjir
                secara efektif dengan fitur peta interaktif, pelaporan kejadian banjir, dan
                sistem pendukung pengambilan keputusan.
            </p>
        </div>
        <div class="mt-8 flex justify-center align-center w-1/3">
            <img src="{{ asset('storage/illustration.png') }}" alt="Illustration" class="max-w-full h-auto">
        </div>
    </main>
</body>

</html>