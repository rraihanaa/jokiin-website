@extends('front.layouts.app')
@section('content')
<body class="font-poppins text-[#030303] bg-[#F6F5FA] pb-[100px] px-4 sm:px-0">

    <x-nav/>

    <section id="header" class="container max-w-[1130px] mx-auto flex flex-col sm:flex-row items-center justify-between gap-2 mt-[50px]">
    <div class="flex flex-col gap-5">
        <div class="flex gap-[30px] items-center">
            <a href="{{route('front.index')}}" class="last-of-type:font-semibold active:font-semibold transition-all duration-300">Telusuri</a>
            <span>/</span>
            <a href="#" class="last-of-type:font-semibold active:font-semibold transition-all duration-300">Kategori</a>
            <span>/</span>
            <a href="#" class="last-of-type:font-semibold active:font-semibold transition-all duration-300">{{$category->name}}</a>
        </div>
        <h1 class="font-extrabold text-[40px] leading-[45px] text-center sm:text-left">
            {{$category->name}}
        </h1>
    </div>
    <div class="flex flex-col sm:flex-row justify-end items-center gap-3 w-full sm:w-auto">
        <div class="p-2 pl-5 rounded-full bg-white flex items-center justify-between gap-2 w-full sm:w-[500px] focus-within:ring-2 focus-within:ring-[#545768] transition-all duration-300">
            <input type="text" class="appearance-none outline-none focus:outline-none font-semibold placeholder:font-normal placeholder:text-[#545768] w-full" placeholder="Cari tugas...">
            <button class="w-9 h-9 flex shrink-0">
                <img src="{{asset('assets/icons/search.svg')}}" alt="icon">
            </button>
        </div>
    </div>
    </section>
    <section id="card-container" class="container max-w-[1130px] mx-auto flex flex-col sm:flex-row sm:flex-nowrap gap-5 mt-[50px]">
        <div class="flex flex-col gap-4 w-full">
            <div class="grid sm:grid-cols-4 gap-5">

                @forelse($category->projects as $project)
                    <a href="{{route('front.details', $project)}}" class="card">
                        <div class="p-5 rounded-[20px] bg-white flex flex-col gap-5 hover:ring-2 hover:ring-[#545768] transition-all duration-300">
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
        </div>
    </section>
</body>
@endsection