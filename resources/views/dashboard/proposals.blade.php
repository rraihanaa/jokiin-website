<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Pengajuan Joki') }}
            </h2>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">

                @forelse(Auth::user()->proposals as $proposal)
                <div class="item-card flex flex-col md:flex-row gap-y-10 justify-between md:items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{Storage::url($proposal->project->thumbnail)}}" alt="" class="rounded-2xl object-cover w-[120px] h-[90px]">
                        <div class="flex flex-col">
                            <h3 class="text-indigo-950 text-xl font-bold">
                                {{$proposal->project->name}}
                            </h3>
                            <p class="text-slate-500 text-sm">
                                {{$proposal->project->category->name}}
                            </p>
                        </div>
                    </div>

                    <div class="hidden md:flex flex-col">
                        <p class="text-slate-500 text-sm">Budget</p>
                        <h3 class="text-indigo-950 text-xl font-bold">
                            Rp {{number_format($proposal->project->budget, 0, ',', '.')}}
                        </h3>
                    </div>

                    <div class="hidden md:flex flex-col">
                        <p class="text-slate-500 text-sm">Diajukan pada</p>
                        <h3 class="text-indigo-950 text-xl font-bold">{{$proposal->created_at->format('M d, Y')}}</h3>
                    </div>
                    
                    <div class="hidden md:flex flex-row items-center gap-x-3">
                        <a href="{{route('dashboard.proposal_details', [
                            $proposal->project, $proposal->id
                        ])}}" class="font-bold py-4 px-6 bg-blue-500 text-white rounded-full">
                            Detail
                        </a>
                    </div>
                </div>
                @empty
                <p>Belum ada data pengajuan joki terbaru</p>
                @endforelse

                
            </div>
        </div>
    </div>
</x-app-layout>
