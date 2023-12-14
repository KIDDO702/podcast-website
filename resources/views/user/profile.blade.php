@extends('layout.home')

@section('body')
	<section class="my-10">
		<div class="container px-5 md:px-3 lg:px-0">
			<div>
                <ul class="flex items-center text-white space-x-3">
                    <li>
                        <a href="/" class="underline underline-offset-4 text-yellow-600 text-sm font-semibold">Home</a>
                    </li>
                    <li>
                        <span>
                            .
                        </span>
                    </li>
                    <li>
                        <a class="underline underline-offset-4 text-yellow-600 text-sm font-semibold">Profile</a>
                    </li>
                    <li>
                        <span>
                            .
                        </span>
                    </li>
                    <li>
                        <span class="text-gray-300 text-sm">{{ $user->name }}</span>
                    </li>
                </ul>
            </div>
            <hr class="border-yellow-100 my-10">
            <div class="w-full mx-auto">
            	<form method="POST" action="{{ route('user.update', $user->id) }}" x-data="{ password: false }">
            		@csrf
            		<div class="w-full md:flex md:items-start md:space-x-10">
            			<div class="md:w-[60%] bg-slate-700 border-slate-600 rounded drop-shadow p-7">
            				<div class="w-full">
            					<label class="font-semibold text-gray-300">Name</label>
            					<input type="text" name="name" id="name" value="{{ $user->name }}" class="w-full bg-slate-950 mt-1.5 text-slate-300 px-2 py-1.5 rounded drop-shadow focus:outline focus:outline-slate-950 focus:outline-offset-2">
            					@error('name')
            						<small class="font-semibold text-red-400">{{ $message }}</small>
            					@enderror
            				</div>

            				<div class="mt-7 flex items-center space-x-7">
            					<div class="w-full">
            						<label class="font-semibold text-gray-300">Email</label>
            						<input type="email" name="email" id="email" value="{{ $user->email }}" class="w-full bg-slate-950 mt-1.5 text-slate-300 px-2 py-1.5 rounded drop-shadow focus:outline focus:outline-slate-950 focus:outline-offset-2">
            						@error('email')
            							<small class="font-semibold text-red-400">{{ $message }}</small>
            						@enderror
            					</div>
            					<div class="w-full">
            						<label class="font-semibold text-gray-300">Username</label>
            						<input type="text" name="username" id="username" value="{{ $user->username }}" class="w-full bg-slate-950 mt-1.5 text-slate-300 px-2 py-1.5 rounded drop-shadow focus:outline focus:outline-slate-950 focus:outline-offset-2">
            						@error('username')
            							<small class="font-semibold text-red-400">{{ $message }}</small>
            						@enderror
            					</div>
            				</div>

            				<div class="w-full mt-7">
            					<label class="font-semibold text-gray-300">Joined</label>
            					<input type="text" value="{{ $user->created_at->toFormattedDateString() }}" class="cursor-disabled w-full bg-slate-950 mt-1.5 text-slate-300 px-2 py-1.5 rounded drop-shadow focus:outline focus:outline-slate-950 focus:outline-offset-2" disabled>
            				</div>

            				<div class="mt-7">
            					<a class="cursor-pointer text-sm underline underline-offset-2 text-gray-200 font-semibold" @click="password = !password">
            						Change Password
            					</a>
            				</div>

            				<div class="w-full mt-7" x-show="password" x-cloak x-transition>
            					<div class="flex items-center justify-center space-x-5">
            						<div class="w-full">
            							<label class="font-semibold text-gray-300">Current Password</label>
            							<input type="password" name="current_password" class="w-full bg-slate-950 mt-1.5 text-slate-300 px-2 py-1.5 rounded drop-shadow focus:outline focus:outline-slate-950 focus:outline-offset-2">
            							@error('current_password')
            								<small class="font-semibold text-red-400">{{ $message }}</small>
            							@enderror
            						</div>
            						<div class="w-full">
            							<label class="font-semibold text-gray-300">New Password</label>
            							<input type="password" name="new_password" class="w-full bg-slate-950 mt-1.5 text-slate-300 px-2 py-1.5 rounded drop-shadow focus:outline focus:outline-slate-950 focus:outline-offset-2 placeholder:text-slate-300 placeholder:text-sm">
            							@error('new_password')
            								<small class="font-semibold text-red-400">{{ $message }}</small>
            							@enderror
            						</div>
            					</div>

            					<div class="w-full mt-7">
            						<label class="font-semibold text-gray-300">Confirm Password</label>
            						<input type="password" name="new_password_confirmation" class="w-full bg-slate-950 mt-1.5 text-slate-300 px-2 py-1.5 rounded drop-shadow focus:outline focus:outline-slate-950 focus:outline-offset-2">
            						@error('password_confirmation')
            							<small class="font-semibold text-red-400">{{ $message }}</small>
            						@enderror
            					</div>
            				</div>
            			</div>
            			<div class="mt-7 md:mt-0 md:w-[40%] bg-slate-700 rounded drop-shadow p-5" x-data="{ avatar: false }">
            				<div class="w-[25%] relative mx-auto rounded drop-shadow">
                    			@if (!$user->hasMedia('avatar'))
                        			<img src="{{ asset('avatar.png') }}" alt="{{ $user->username }}" class="w-full bg-slate-900 rounded mx-auto outline outline-slate-950 outline-offset-2">
                        			<div class="absolute bg-opacity-80 bg-slate-900 inset-0 rounded"></div>
                        			<div class="absolute bottom-2 w-full flex justify-end px-2">
                        				<a @click="avatar = !avatar" class="cursor-pointer bg-green-50 text-green-900 rounded-md border border-green-900 flex items-center p-0.5 bg-opacity-50 hover:bg-opacity-70">
                        					<span class="material-symbols-outlined">
												edit
											</span>
                        				</a>
                        			</div>
                    			@else
                        			<img src="{{ $user->getFirstMediaUrl('avatar') }}" alt="{{ $user->username }}" class="w-full rounded mx-auto outline outline-slate-950 outline-offset-2">
                        			<div class="absolute bg-opacity-40 bg-slate-900 inset-0 rounded"></div>
                        			<div class="absolute bottom-2 w-full flex justify-end px-2">
                        				<a @click="avatar = !avatar" class="cursor-pointer bg-green-50 text-green-900 rounded-md border border-green-900 flex items-center p-0.5 bg-opacity-50 hover:bg-opacity-70">
                        					<span class="material-symbols-outlined">
												edit
											</span>
                        				</a>
                        			</div>
                    			@endif
                			</div>
                			<div class="w-[90%] mx-auto mt-5" x-show="avatar" x-transition x-cloak>
	                			<label for="avatar" class="font-semibold text-gray-200">Avatar</label>
	                			<input type="file" id="avatar" name="avatar" class="mt-0.5 drop-shadow">
            				</div>
            			</div>
            		</div>

            		<div class="mt-10">
            			<button type="submit" class="bg-yellow-600 px-3 py-2 text-red-800 font-semibold rounded focus:outline focus:outline-yellow-600 focus:outline-offset-2">
            				Edit Account
            			</button>
            		</div>
            	</form>
            </div>
		</div>
	</section>
@endsection
