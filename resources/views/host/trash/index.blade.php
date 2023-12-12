@extends('layout.host')

@section('body')
	<section class="w-full my-16">
		<div class="container">
			<div>
				<h3 class="text-3xl font-extrabold uppercase text-yellow-600">Deleted Shows</h3>
				<livewire:host.trash.deleted-shows />
			</div>
			<div class="mt-7">
				<h3 class="text-3xl font-extrabold uppercase text-yellow-600">Deleted Episodes</h3>
				<livewire:host.trash.deleted-episodes />
			</div>
		</div>
	</section>
@endsection