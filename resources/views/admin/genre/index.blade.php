@extends('layout.admin')


@section('body')
    <div class="bg-white rounded drop-shadow-sm flex justify-between items-center py-2 px-4">
        <h3 class="font-bold text-slate-900 text-2xl">Genre</h3>


        <ul class="flex items-center space-x-3">
            <li>
                <a href="{{ route('admin.index') }}" class="text-red-800 underline underline-offset-1">
                    <small class="font-semibold">Dashboard</small>
                </a>
            </li>
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 flex items-center justify-center">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>

            </li>
            <li>
                <small class="text-gray-600 font-semibold">Genre</small>
            </li>
        </ul>
    </div>

    @can('create genre')
    <div class="mt-10">
        <div class="bg-white p-7 drop-shadow-sm rounded">
            <livewire:admin.genre-create />
        </div>
    </div>
    @endcan

    @can('manage genre')
    <div class="mt-10">
        <div class="bg-white drop-shadow-sm px-7 py-6 rounded">
            <livewire:admin.genre-table />
        </div>
    </div>
    @endcan
@endsection
