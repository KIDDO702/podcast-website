@extends('layout.auth')

@section('form')
    <form action="{{ route('confirmed') }}" method="POST">
        @csrf
        <div>
            <input type="password" name="password" placeholder="Password" class="w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded placeholder:text-slate-950 focus:outline focus:outline-gray-400 focus:outline-offset-2">
        </div>

        <button type="submit" class="w-full mt-7 px-4 py-2.5 bg-red-800 text-white font-semibold rounded focus:ring focus:ring-red-800 focus:ring-offset-2">
            Continue
        </button>
    </form>
@endsection
