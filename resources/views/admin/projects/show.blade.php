<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Tugas') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="px-5 py-3 w-full rounded-3xl bg-red-500 text-white">
                            {{$error}}
                        </div>
                    @endforeach
                @endif

                <div class="item-card flex flex-row gap-y-10 justify-between md:items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{Storage::url($project->thumbnail)}}" alt="" class="rounded-2xl object-cover w-[120px] h-[90px]">
                        <div class="flex flex-col">
                            <h3 class="text-indigo-950 text-xl font-bold">{{$project->name}}</h3>
                            <p class="text-slate-500 text-sm">{{$project->category->name}}</p>
                        </div>
                    </div>
                    <div class="flex flex-row items-center gap-x-3">
                        <a href="{{route('front.details', $project->slug)}}" class="font-bold py-4 px-6 bg-yellow-500 text-white rounded-full">
                            Pratinjau
                        </a>
                        <a href="{{route('admin.projects.tools', $project)}}" class="font-bold py-4 px-6 bg-blue-500 text-white rounded-full">
                            Tambah Tool
                        </a>
                    </div>

                    
                </div>

                <hr class="my-5">

                <h3 class="text-indigo-950 text-xl font-bold">Penjoki</h3>

                @forelse($project->applicants as $applicant)
                    <div class="flex flex-row justify-between items-center">
                        <div class="flex flex-row items-center gap-x-3">
                            <img src="{{Storage::url($applicant->penjoki->avatar)}}" alt="" class="rounded-full object-cover w-[70px] h-[70px]">
                            <div class="flex flex-col">
                                <h3 class="text-indigo-950 text-xl font-bold">{{$applicant->penjoki->name}}</h3>
                                <p class="text-slate-500 text-sm">{{$applicant->penjoki->occupation}}</p>
                            </div>
                        </div>

                        @if($applicant->status == 'Diterima')
                            <span class="w-fit text-sm font-bold py-2 px-3 rounded-full bg-green-500 text-white">
                                DITERIMA
                            </span>
                        @elseif($applicant->status == 'Menunggu')
                            <span class="w-fit text-sm font-bold py-2 px-3 rounded-full bg-yellow-500 text-white">
                                MENUNGGU KONFIRMASI
                            </span> 
                        @elseif($applicant->status == 'Ditolak')
                            <span class="w-fit text-sm font-bold py-2 px-3 rounded-full bg-red-500 text-white">
                                DITOLAK
                            </span>
                        @endif

                        <div class="flex flex-row items-center gap-x-3">
                            <a href="{{route('admin.project_applicants.show', $applicant)}}" class="font-bold py-4 px-6 bg-blue-500 text-white rounded-full">
                                Detail
                            </a>
                        </div>
                    </div>
                @empty
                    <p>
                        Belum ada yang tertarik untuk menjoki tugas ini
                    </p>
                @endforelse
                
            </div>
        </div>
    </div>
</x-app-layout>
