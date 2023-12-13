@extends('layout.admin')

@section('body')
	<div class="w-full">
		<h3 class="text-3xl font-bold text-gray-700">Dashboard</h3>
		<h6 class="text-xl mt-1.5 text-gray-600 font-semibold">Welcome <span class="text-yellow-600">{{ auth()->user()->name }}</span></h6>
	</div>

    <hr class="border-gray-300 my-10">

	<div class="">
		<div>
			<h3 class="text-gray-700 text-sm font-semibold underline underline-offset-2">Podcast</h3>
			<div class="mt-3 grid md:grid-cols-3 gap-4">
				<div class="bg-white rounded drop-shadow flex items-center justify-between p-5">
					<div>
						<a href="{{ route('admin.genre') }}" class="bg-red-50 text-red-900 p-3 flex items-center rounded-md border border-red-400">
							<span class="material-symbols-outlined text-3xl">
                            	category
                        	</span>
						</a>
					</div>
					<div>
						<h3 class="font-semibold text-slate-800 text-xl">Genres</h3>
						<span class="font-semibold text-lg">{{ str_pad(count($genres), 3, '0', STR_PAD_LEFT) }}</span>
					</div>
				</div>
				<div class="bg-white rounded drop-shadow flex items-center justify-between p-5">
					<div>
						<a href="{{ route('admin.show') }}" class="bg-yellow-50 text-yellow-900 p-3 flex items-center rounded-md border border-yellow-400">
							<span class="material-symbols-outlined text-3xl">
                            	featured_play_list
                        	</span>
						</a>
					</div>
					<div>
						<h3 class="font-semibold text-slate-800 text-xl">Shows</h3>
						<span class="font-semibold text-lg">{{ str_pad(count($shows), 3, '0', STR_PAD_LEFT) }}</span>
					</div>
				</div>
				<div class="bg-white rounded drop-shadow flex items-center justify-between p-5">
					<div>
						<a href="{{ route('admin.genre') }}" class="bg-green-50 text-green-900 p-3 flex items-center rounded-md border border-green-400">
							<span class="material-symbols-outlined text-3xl">
                            	music_video
                        	</span>
						</a>
					</div>
					<div>
						<h3 class="font-semibold text-slate-800 text-xl">Episodes</h3>
						<span class="font-semibold text-lg">{{ str_pad(count($episodes), 3, '0', STR_PAD_LEFT) }}</span>
					</div>
				</div>
			</div>
		</div>
		<div class="mt-5">
			<h3 class="text-gray-700 text-sm font-semibold underline underline-offset-2">Users (Roles)</h3>
			<div class="mt-3 grid md:grid-cols-3 gap-4">
				<div class="bg-white rounded drop-shadow flex items-center justify-between p-5">
					<div>
						<a href="{{ route('admin.user') }}" class="bg-red-50 text-red-900 p-3 flex items-center rounded-md border border-red-400">
							<span class="material-symbols-outlined text-3xl">
                            	group
                        	</span>
						</a>
					</div>
					<div>
						<h3 class="font-semibold text-slate-800 text-xl">Users</h3>
						<span class="font-semibold text-lg">{{ str_pad(count($users), 3, '0', STR_PAD_LEFT) }}</span>
					</div>
				</div>
				<div class="bg-white rounded drop-shadow flex items-center justify-between p-5">
					<div>
						<a href="{{ route('admin.user') }}" class="bg-yellow-50 text-yellow-900 p-3 flex items-center rounded-md border border-yellow-400">
							<span class="material-symbols-outlined text-3xl">
                            	supervised_user_circle
                        	</span>
						</a>
					</div>
					<div>
						<h3 class="font-semibold text-slate-800 text-xl">Hosts</h3>
						<span class="font-semibold text-lg">{{ str_pad($hosts, 3, '0', STR_PAD_LEFT) }}</span>
					</div>
				</div>
				<div class="bg-white rounded drop-shadow flex items-center justify-between p-5">
					<div>
						<a href="{{ route('admin.user') }}" class="bg-green-50 text-green-900 p-3 flex items-center rounded-md border border-green-400">
							<span class="material-symbols-outlined text-3xl">
                            	shield_person
                        	</span>
						</a>
					</div>
					<div>
						<h3 class="font-semibold text-slate-800 text-xl">Admins</h3>
						<span class="font-semibold text-lg">{{ str_pad($admins, 3, '0', STR_PAD_LEFT) }}</span>
					</div>
				</div>
			</div>
		</div>
	</div>

    <div class="mt-10">
        <div class="grid lg:grid-cols-2 gap-6">
            <div class="bg-white drop-shadow rounded p-5">
                <h3 class="font-semibold text-slate-900 text-2xl">Latest Shows</h3>
                <hr class="border-gray-200 my-2">
                <livewire:admin.latest-shows />
            </div>

            <div class="bg-white drop-shadow rounded p-5">
                <h3 class="font-semibold text-slate-900 text-2xl">Latest Episodes</h3>
                <hr class="border-gray-200 my-2">
                <livewire:admin.latest-episodes />
            </div>
        </div>
    </div>
@endsection
