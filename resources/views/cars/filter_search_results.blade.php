@extends('layouts.myapp')

@section('filter_car')

@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Aucune voiture disponible pour la période sélectionnée.',
            text: '{{ session('error')}}',
            showConfirmButton: false, 
            timer: 5000
        });
    </script>
@endif
<div style="color: white;">fhhhhh <br>kegkeke <br>555 <br>aaaa</div>  
<!-- Affichage des voitures filtrées -->
<div class="bg-gray-200 mx-auto max-w-screen-xl mt-10 p-3 rounded-md shadow-xl">
    <div class="mt-6 mb-2 grid md:grid-cols-3 justify-center items-center mx-auto max-w-screen-xl">
        @foreach ($cars as $car)
            <div class="relative md:m-10 m-4 w-full max-w-xs flex-col overflow-hidden rounded-lg border border-gray-100 bg-white shadow-md">
                <a class="relative mx-3 mt-3 flex h-60 overflow-hidden rounded-xl" href="{{ route('cin', ['car_id' => $car->id]) }}"
                style="position: relative; overflow: hidden;">
                    <img loading="lazy" class="car-image" src="{{ asset('storage/' . $car->image) }}" alt="product image" />
                    @if($car->reduce > 0)
                    <span style="
                        display: inline-block;
                        position: absolute;
                        top: 8px;
                        left: 8px;
                        z-index: 9999;
                        background-color: rgba(229, 62, 62, 0.85);
                        color: #ffffff;
                        padding: 4px 8px;
                        border-radius: 12px;
                        font-size: 0.875rem;
                        font-weight: 500;
                        white-space: nowrap;">
                        {{ $car->reduce }} % de réduction
                    </span>
                    @endif
                </a>
                <div class="mt-4 px-5 pb-5">
                    <div>
                        <h5 class="font-bold text-xl tracking-tight text-slate-900">
                            {{ $car->brand }} {{ $car->model }} {{ $car->engine }}
                        </h5>
                        <p class="text-sm text-gray-700 mt-1">
                            Type de boîte : <span class="font-semibold">{{ $car->gearbox_type }}</span>
                        </p>
                    </div>
                    <div class="mt-2 mb-5 flex items-center justify-between">
                        <p>
                            <span class="text-3xl font-bold text-slate-900">{{ $car->price_per_day }} DT/jour</span>
                            <span class="text-sm text-slate-900 line-through">
                                {{ intval(($car->price_per_day * 100) / (100 - $car->reduce)) }} DT
                            </span>
                        </p>
                        <div class="flex items-center">
                            @for ($i = 0; $i < $car->stars; $i++)
                                <svg aria-hidden="true" class="h-5 w-5 text-pr-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @endfor
                            <span class="mr-2 ml-3 rounded bg-pr-300 px-2.5 py-0.5 text-xs font-semibold">{{ $car->stars }}.0</span>
                        </div>
                    </div>
                    <form id="reservationForm" action="{{ route('cin', ['car_id' => $car->id]) }}" method="GET">
                        @csrf
                        <input type="hidden" name="start_date" value="{{ request('start_date') }}" style="display: none;">
                        <input type="hidden" name="delivery_time" value="{{ request('delivery_time') }}" style="display: none;">
                        <input type="hidden" name="end_date" value="{{ request('end_date') }}" style="display: none;">
                        <input type="hidden" name="return_time" value="{{ request('return_time') }}" style="display: none;">
                        <button type="submit" style="width: auto; display: inline-flex; padding: 1rem 2.75rem;"
                                class="flex items-center justify-center rounded-md bg-slate-900 hover:bg-pr-400 px-20 py-2.5 text-center text-sm font-medium text-white focus:outline-none focus:ring-4 focus:ring-blue-300">
                            <i class="fa-solid fa-calendar-check mr-1" style="margin-right: 0.5rem;"></i>
                            Réserver
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Pagination des résultats -->
<div class="flex justify-center mb-12 w-full">
    {{ $cars->links('pagination::tailwind') }}
</div>

@endsection
