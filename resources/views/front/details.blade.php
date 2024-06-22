@extends('front.layouts.app')
@section('content')
<body class="font-poppins text-[#030303] bg-[#F6F5FA] pb-[100px] px-4 sm:px-0">

    <x-nav/>

    <section id="breadcrumb" class="container max-w-[1130px] mx-auto mt-[30px]">
        <div class="flex gap-[30px] items-center">
            <a href="{{route('front.index')}}" class="last-of-type:font-semibold active:font-semibold transition-all duration-300">Telusuri</a>
            <span>/</span>
            <a href="{{route('front.index')}}" class="last-of-type:font-semibold active:font-semibold transition-all duration-300">Tugas</a>
            <span>/</span>
            <a href="#" class="last-of-type:font-semibold active:font-semibold transition-all duration-300">Detail</a>
        </div>
    </section>
    <section id="details" class="container max-w-[1130px] mx-auto flex flex-col sm:flex-row sm:flex-nowrap gap-5 mt-[30px]">
        <div class="bg-white flex flex-col gap-5 p-5 rounded-[20px]">
            <div class="flex flex-col gap-1">
            
                    @if($project->has_finished)
                         <div class="font-bold text-xs leading-[18px] text-white bg-[#F3445C] p-[2px_10px] rounded-full w-fit">SELESAI</div>
                    @else
                        @if($project->has_started)
                            <div class="font-bold text-xs leading-[18px] text-white bg-[#2E82FE] p-[2px_10px] rounded-full w-fit">SEDANG DIKERJAKAN</div>
                        @else
                            <div class="font-bold text-xs leading-[18px] text-white bg-[#2E82FE] p-[2px_10px] rounded-full w-fit">BUTUH JOKI</div>
                        @endif
                    @endif

                <h1 class="font-extrabold text-[30px] leading-[45px]">
                    {{$project->name}}
                </h1>
                <p class="text-sm text-[#545768]">Diunggah pada {{$project->created_at->format('M d, Y')}}</p>
            </div>
            <div class="flex flex-col gap-[6px] w-full">
                <h3 class="font-semibold">Deskripsi Tugas</h3>
                <p class="text-sm leading-[28px]">
                    {{$project->about}}
                </p>
            </div>
            <div class="flex flex-col gap-[6px] w-full">
                <h3 class="font-semibold">Detail</h3>
                <div class="grid sm:grid-cols-3 gap-5">
                    <div class="flex items-center gap-[10px] p-5 border border-[#F1F1F1] rounded-[20px] bg-white">
                        <div class="w-[38px] h-[38px] flex shrink-0">
                            <img src="{{asset('assets/icons/dollar-circle.svg')}}" class="w-full h-full object-contain" alt="icon">
                        </div>
                        <div class="flex flex-col justify-center gap-[2px]">
                            <p class="text-sm text-[#545768]">Budget</p>
                            <p class="font-bold">Rp {{number_format($project->budget, 0, ',', '.')}}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-[10px] p-5 border border-[#F1F1F1] rounded-[20px] bg-white">
                        <div class="w-[38px] h-[38px] flex shrink-0">
                            <img src="{{asset('assets/icons/level.svg')}}" class="w-full h-full object-contain" alt="icon">
                        </div>
                        <div class="flex flex-col justify-center gap-[2px]">
                            <p class="text-sm text-[#545768]">Level</p>
                            <p class="font-bold">{{$project->skill_level}}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-[10px] p-5 border border-[#F1F1F1] rounded-[20px] bg-white">
                        <div class="w-[38px] h-[38px] flex shrink-0">
                            <img src="{{asset('assets/icons/clock.svg')}}" class="w-full h-full object-contain" alt="icon">
                        </div>
                        <div class="flex flex-col justify-center gap-[2px]">
                            <p class="text-sm text-[#545768]">Deadline</p>
                            <p class="font-bold">{{$project->deadline}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-[6px] w-full">
                <h3 class="font-semibold">Tools</h3>
                <div class="grid sm:grid-cols-4 gap-5">

                    @forelse($project->tools as $tool)
                        <div class="flex items-center gap-[10px] p-5 border border-[#F1F1F1] rounded-[20px] bg-white">
                            <div class="w-[38px] h-[38px] flex shrink-0">
                                <img src="{{Storage::url($tool->icon)}}" class="w-full h-full object-contain" alt="icon">
                            </div>
                            <div class="flex flex-col justify-center gap-[2px]">
                                <p class="font-bold">{{$tool->name}}</p>
                                <p class="text-sm text-[#545768]">Wajib</p>
                            </div>
                        </div>
                    @empty
                        <p>Belum ditentukan</p>
                    @endforelse


                </div>
            </div>
        </div>
        <div class="flex flex-col sm:w-[300px] h-fit shrink-0 bg-white rounded-[20px] p-5 gap-[30px]">
            <div class="w-full h-[170px] flex shrink-0 rounded-[20px] overflow-hidden">
                <img src="{{Storage::url($project->thumbnail)}}" class="w-full h-full object-cover" alt="thumbnail">
            </div>
            <div class="flex flex-col gap-3">

                @auth
                @if(Auth::user()->hasAppliedToProject($project->id))
                    <a href="{{route('dashboard.proposals')}}" style="background-color: black;" class="p-[14px_20px] rounded-full font-semibold text-white text-center">Lihat Pengajuan</a>
                @else
                    @if(!$project->has_finished)
                    <a href="{{route('front.apply_job', $project->slug)}}" style="background-color: black;" class="p-[14px_20px] rounded-full font-semibold text-white text-center">Ajukan Joki</a>
                    @endif
                @endif
                @endauth

                @guest
                @if(!$project->has_started)
                    <a href="{{route('front.apply_job', $project->slug)}}" style="background-color: black;" class="p-[14px_20px] rounded-full font-semibold text-white text-center">Ajukan Joki</a>
                @endif
                @endguest
                
            </div>
            <div class="flex flex-col gap-3">
                <h3 class="font-semibold">Tentang Klien</h3>
                <div class="flex items-center gap-3">
                    <div class="w-[50px] h-[50px] rounded-full overflow-hidden flex shrink-0">
                        <img src="{{Storage::url($project->owner->avatar)}}" class="w-full h-full object-cover" alt="photo">
                    </div>
                    <div class="flex flex-col gap-[2px]">
                        <p class="font-semibold">{{$project->owner->name}}</p>
                        <p class="text-sm leading-[21px] text-[#545768]">
                            {{$project->owner->projects->count()}} Tugas
                        </p>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </section>
    <section id="other" class="container max-w-[1130px] mx-auto flex flex-col gap-4 mt-[50px]">
        <h2 class="font-bold text-xl">Tugas Lainnya</h2>
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-5">
            
            @forelse($projects as $project)
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
    </section>
</body>
@endsection