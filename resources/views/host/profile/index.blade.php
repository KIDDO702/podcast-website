@extends('layout.host')

@section('body')
	<section class="my-10">
		<div class="container">
			@php
				$user = auth()->user();
			@endphp
			<div class="w-[85%] bg-slate-700 drop-shadow rounded p-7 mx-auto">
				<form action="#" method="POST">
					<div class="md:flex md:items-center md:space-x-5">
						<div class="w-full">
							<label for="name" class="text-gray-300 font-semibold">Name</label>
							<input type="text" name="name" value="{{ $user->name }}" class="w-full mt-1 bg-slate-900 text-gray-300 px-4 py-2 rounded placeholder:text-gray-200 focus:outline focus:outline-slate-950 focus:outline-offset-2">
						</div>
						<div class="w-full mt-7 md:mt-0">
							<label for="email" class="text-gray-300 font-semibold">Email</label>
							<input type="email" name="email" value="{{ $user->email }}" class="w-full mt-1 bg-slate-900 text-gray-300 px-4 py-2 rounded placeholder:text-gray-200 focus:outline focus:outline-slate-950 focus:outline-offset-2">
						</div>
					</div>

					<div class="w-full mt-7">
						<label for="username" class="text-gray-300 font-semibold">Username</label>
						<input type="text" name="username" value="{{ $user->username }}" class="w-full mt-1 bg-slate-900 text-gray-300 px-4 py-2 rounded placeholder:text-gray-200 focus:outline focus:outline-slate-950 focus:outline-offset-2">
					</div>

					<div class="md:flex md:items-center md:space-x-5 mt-7">
						<div class="w-full">
							<label for="name" class="text-gray-300 font-semibold">Name</label>
							<input type="text" name="name" value="{{ $user->name }}" class="w-full mt-1 bg-slate-900 text-gray-300 px-4 py-2 rounded placeholder:text-gray-200 focus:outline focus:outline-slate-950 focus:outline-offset-2">
						</div>
						<div class="w-full mt-7 md:mt-0">
							<label for="email" class="text-gray-300 font-semibold">Email</label>
							<input type="email" name="email" value="{{ $user->email }}" class="w-full mt-1 bg-slate-900 text-gray-300 px-4 py-2 rounded placeholder:text-gray-200 focus:outline focus:outline-slate-950 focus:outline-offset-2">
						</div>
					</div>

				</form>
			</div>
		</div>
	</section>
@endsection
