<nav class="container max-w-[1130px] mx-auto flex items-center flex-wrap justify-between p-4 rounded-[20px] bg-white mt-[30px] gap-y-3 sm:gap-y-0">
    <a href="{{route('front.index')}}">
        <img src="{{asset('assets/logos/logo.svg')}}" alt="logo">
    </a>
    <ul class="flex items-center flex-wrap gap-x-[30px]">
        <li>
            <a href="{{route('front.index')}}" class="hover:font-semibold hover:text-[#5271FF] transition-all duration-300 {{ request()->routeIs('front.index') ? 'text-[#5271FF] font-semibold' : ''}}">Beranda</a>
        </li>
        @can('apply job')
        <li>
            <a href="{{route('dashboard.proposals')}}" class="hover:font-semibold hover:text-[#5271FF] transition-all duration-300">Pengajuan</a>
        </li>
        @endcan
        @can('withdraw wallet')
        <li>
            <a href="{{route('dashboard.wallet')}}" class="hover:font-semibold hover:text-[#5271FF] transition-all duration-300">Saldo</a>
        </li>
        @endcan
    </ul>
    @auth
    <a href="{{route('dashboard')}}">
        <div class="flex items-center gap-3">
            <p class="font-semibold">Halo, {{Auth::user()->name}}</p>
            <div class="w-[50px] h-[50px] rounded-full overflow-hidden flex shrink-0">
                <img src="{{Storage::url(Auth::user()->avatar)}}" class="w-full h-full object-cover" alt="photo">
            </div>
        </div>
    </a>
    @endauth
    @guest
    <div class="flex items-center gap-3">
        <a href="{{route('login')}}" class="bg-[#030303] p-[14px_20px] rounded-full font-semibold text-white text-center w-fit text-nowrap">Masuk</a>
        <a href="{{route('register')}}" class="bg-[#5271FF] p-[14px_20px] rounded-full font-semibold text-white text-center w-fit text-nowrap">Daftar</a>
    </div>
    @endguest
  </nav>