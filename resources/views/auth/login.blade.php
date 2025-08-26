@extends('layouts.myapp')
@section('login')
<div style="color: white;">fhhhhh <br>kegkeke <br>555 <br>aaaa</div>
    <div class="grid place-items-center h-screen">
        <div class="p-5 bg-sec-100 -mt-48 mx-auto" style="width:500px;">
            <form method="POST" action="{{ route('cin.login', ['car_id' => $car_id ?? '']) }}">
                <input type="hidden" name="car_id" value="{{ $car_id }}">
                @csrf
                <div class="mb-6">
                <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                    <input type="time" name="delivery_time" value="{{ request('delivery_time') }}"  style="display: none;">
                    <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                    <input type="time" name="return_time" value="{{ request('return_time') }}" style="display: none;">
                    <label for="identity_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your CIN</label>
                    <input type="text" id="identity_number" name="identity_number" value="{{ old('identity_number') }}"
                        class="bg-pr-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pr-500 focus:border-pr-500 block w-full p-2.5"
                        placeholder="Enter your CIN">
                    @error('identity_number')
                        <span>
                            <strong class="text-red-500">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="flex items-start mb-6">
                    <div class="flex items-center h-5">
                        <input id="remember" type="checkbox" value=""
                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-pr-300"
                            name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    </div>
                    <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember
                        me</label>
                </div>

                <button type="submit"
                    class="text-white bg-pr-400 hover:bg-pr-600 focus:ring-4 focus:outline-none focus:ring-pr-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-pr-600 dark:hover:bg-pr-700 dark:focus:ring-pr-800">
                    Login
                </button>

                @if (Route::has('password.request'))
                    <a class="m-2 text-gray-600 hover:text-blue-600 hover:cursor-pointer" href="{{ route('password.request') }}">
                        {{ __('Forgot Your CIN?') }}
                    </a>
                @endif

                
            </form>
        </div>
    </div>
@endsection