@extends('front.layouts.app')
@section('content')
<body class="font-poppins text-[#030303] bg-[#F6F5FA] pb-[100px] px-4 sm:px-0">

    <x-nav/>

    <section id="header" class="container max-w-[1130px] mx-auto flex flex-col sm:flex-row items-center justify-between gap-2 mt-[50px]">
        <h1 class="font-extrabold text-[40px] leading-[45px] text-center sm:text-left">Telusuri dan Jokiin Berbagai Tugas!</h1>
        <div class="flex flex-col sm:flex-row justify-end items-center gap-3 w-full sm:w-auto">
            <div class="p-2 pl-5 rounded-full bg-white flex items-center justify-between gap-2 w-full sm:w-[450px] focus-within:ring-2 focus-within:ring-[#5271FF] transition-all duration-300">
                <input type="text" class="appearance-none outline-none focus:outline-none font-semibold placeholder:font-normal placeholder:text-[#545768] w-full" placeholder="Cari tugas...">
                <button class="w-9 h-9 flex shrink-0">
                    <img src="{{asset('assets/icons/search.svg')}}" alt="icon">
                </button>
            </div>
        </div>
    </section>
  <section id="categories" class="container max-w-[1130px] mx-auto flex flex-col gap-4 mt-[50px]">
    <h2 class="font-bold text-xl">Lihat Berdasarkan Kategori</h2>
    <div class="grid grid-cols-1 sm:grid-cols-5 gap-5">

        @forelse($categories as $category)
        <a href="{{route('front.category', $category->slug)}}" class="card">
            <div class="p-5 rounded-[20px] bg-white flex flex-col gap-[30px] hover:ring-2 hover:ring-[#5271FF] transition-all duration-300">
                <div class="w-[70px] h-[70px] flex shrink-0">
                    <img src="{{Storage::url($category->icon)}}" alt="icon">
                </div>
                <div class="flex flex-col gap-[6px]">
                    <p href="" class="font-semibold text-lg">{{$category->name}}</p>
                    <p class="text-sm text-[#545768]">{{$category->projects->count()}} tugas tersedia</p>
                </div>
            </div>
        </a>
        @empty
        <p>Belum ada data kategori terbaru</p>
        @endforelse

    </div>
  </section>
  <section id="featured" class="container max-w-[1130px] mx-auto flex flex-col gap-4 mt-[50px]">
    <h2 class="font-bold text-xl">Tugas Unggulan</h2>
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-5">

        @forelse($projects as $project)
        <a href="{{route('front.details', $project)}}" class="card">
            <div class="p-5 rounded-[20px] bg-white flex flex-col gap-5 hover:ring-2 hover:ring-[#5271FF] transition-all duration-300">
                <div class="w-full h-[140px] rounded-[20px] overflow-hidden relative">

                    @if($project->has_finished)
                        <div class="font-bold text-xs leading-[18px] text-white bg-[#F3445C] p-[2px_10px] rounded-full w-fit absolute top-[10px] left-[10px]">SELESAI</div>
                    @else
                        @if($project->has_started)
                            <div class="font-bold text-xs leading-[18px] text-white bg-[#2E82FE] p-[2px_10px] rounded-full w-fit absolute top-[10px] left-[10px]">SEDANG DIKERJAKAN</div>
                        @else
                            <div class="font-bold text-xs leading-[18px] text-white bg-[#2E82FE] p-[2px_10px] rounded-full w-fit absolute top-[10px] left-[10px]">BUTUH JOKI</div>
                        @endif
                    @endif
                        
                    <img src="{{Storage::url($project->thumbnail)}}" class="w-full h-full object-cover" alt="thumbnail">
                </div>
                <div class="flex flex-col gap-[10px]">
                    <p class="title font-semibold text-lg min-h-[56px] line-clamp-2 hover:line-clamp-none">
                        {{$project->name}}
                    </p>
                    <div class="flex items-center gap-[6px]">
                        <div>
                            <img src="{{asset('assets/icons/dollar-circle.svg')}}" alt="icon">
                        </div>
                        <p class="font-semibold text-sm">Rp {{number_format($project->budget, 0, ',', '.')}}</p>
                    </div>
                    <div class="flex items-center gap-[6px]">
                        <div>
                            <img src="{{asset('assets/icons/level.svg')}}" alt="icon">
                        </div>
                        <p class="font-semibold text-sm">{{$project->skill_level}}</p>
                    </div>
                    <div class="flex items-center gap-[6px]">
                        <div>
                            <img src="{{asset('assets/icons/clock.svg')}}" alt="icon">
                        </div>
                        <p class="font-semibold text-sm">{{$project->deadline}}</p>
                    </div>
                </div>
            </div>
        </a>
        @empty
        <p>Belum ada data tugas terbaru</p>
        @endforelse


    </div>
  </section>
  <section id="newest" class="container max-w-[1130px] mx-auto flex flex-col sm:flex-row sm:flex-nowrap gap-5 mt-[50px]">
    <div class="flex flex-col gap-4 w-full">
        <h2 class="font-bold text-xl">Tugas Terbaru</h2>
        <div class="flex flex-col gap-5">

            @forelse($projects as $project)
                <div class="card hover:ring-2 hover:ring-[#5271FF] transition-all duration-300 bg-white p-5 rounded-[20px] flex flex-col sm:flex-row sm:items-center gap-[18px] w-full">
                    <a href="{{route('front.details', $project)}}" class="w-full sm:w-[200px] h-[150px] flex shrink-0 rounded-[20px] overflow-hidden bg-[#D9D9D9]">
                        <img src="{{Storage::url($project->thumbnail)}}" class="w-full h-full object-cover" alt="thumbnail">
                    </a>
                    <div class="flex flex-col gap-[10px]">

                        @if($project->has_finished)
                            <div class="font-bold text-xs leading-[18px] text-white bg-[#F3445C] p-[2px_10px] rounded-full w-fit">SELESAI</div>
                        @else
                            @if($project->has_started)
                                <div class="font-bold text-xs leading-[18px] text-white bg-[#2E82FE] p-[2px_10px] rounded-full w-fit">SEDANG DIKERJAKAN</div>
                            @else
                                <div class="font-bold text-xs leading-[18px] text-white bg-[#2E82FE] p-[2px_10px] rounded-full w-fit">BUTUH JOKI</div>
                            @endif
                        @endif

                        <a href="{{route('front.details', $project)}}" class="font-semibold text-lg leading-[27px]">
                            {{$project->name}}
                        </a>
                        <p class="text-sm leading-7 line-clamp-2">{{$project->about}}</p>
                        <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                            <div class="flex items-center gap-[6px]">
                                <div>
                                    <img src="{{asset('assets/icons/dollar-circle.svg')}}" alt="icon">
                                </div>
                                <p class="font-semibold text-sm">Rp {{number_format($project->budget, 0, ',', '.')}}</p>
                            </div>
                            <div class="flex items-center gap-[6px]">
                                <div>
                                    <img src="{{asset('assets/icons/level.svg')}}" alt="icon">
                                </div>
                                <p class="font-semibold text-sm">{{$project->skill_level}}</p>
                            </div>
                            <div class="flex items-center gap-[6px]">
                                <div>
                                    <img src="{{asset('assets/icons/clock.svg')}}" alt="icon">
                                </div>
                                <p class="font-semibold text-sm">{{$project->deadline}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p>Belum ada data tugas terbaru</p>
            @endforelse
        </div>
    </div>
    <div class="flex flex-col sm:w-[300px] h-fit shrink-0 bg-white rounded-[20px] p-5 gap-[30px] sm:mt-[45px]">
        @auth
            <div class="flex flex-col gap-3">
                <h3 class="font-semibold">Profil Kamu</h3>
                <div class="flex items-center gap-3">
                    <div class="w-[50px] h-[50px] rounded-full overflow-hidden flex shrink-0">
                        <img src="{{Storage::url(Auth::user()->avatar)}}" class="w-full h-full object-cover" alt="photo">
                    </div>
                    <div class="flex flex-col gap-[2px]">
                        <p class="font-semibold">{{Auth::user()->name}}</p>
                        <p class="text-sm leading-[21px] text-[#545768]">{{Auth::user()->occupation}}</p>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-[10px] rounded-[20px] p-[10px_14px] bg-[#030303]">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 flex shrink-0">
                        <img src="{{asset('assets/icons/story.svg')}}" alt="">
                    </div>
                    <p class="text-sm text-white">Kamu punya <span class="font-bold">
                        {{Auth::user()->connect}}</span> Pensil tersedia untuk jokiin tugas</p>
                </div>
                <a href="" class="font-semibold text-white text-sm hover:underline text-center">Top Up Pensil</a>
            </div>
            <hr>
        @endauth
    </div>
  </section>
</body>
@endsection