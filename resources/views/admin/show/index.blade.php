@extends('layout.admin')


@section('body')
    <div class="bg-white rounded drop-shadow flex justify-between items-center py-2 px-4">
        <h3 class="font-bold text-slate-900 text-2xl">Shows</h3>


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
                <small class="text-gray-600 font-semibold">Shows</small>
            </li>
        </ul>
    </div>

    <div class="mt-10 bg-white drop-shadow rounded px-7 py-6">
        <div class="flex justify-between items-center">
            <div>
                <h3>All shows</h3>
            </div>

            @can('create show')
            <div>
                <a href="{{ route('admin.show.create') }}" class="bg-red-800 px-4 py-1.5 rounded text-white">
                    Create New
                </a>
            </div>
            @endcan
        </div>

        <hr class="border-gray-200 my-7">

        <div class="mt-5">
            <livewire:admin.show-table />
        </div>
    </div>
@endsection
