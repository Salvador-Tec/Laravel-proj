@extends('layouts.myapp')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
 
@section('list_car')
@if (session('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Aucune voiture disponible .',
                text: '{{ session('error') }}',
                showConfirmButton: false, 
                timer: 3000
            });
        </script>
    @endif
    <div style="color: white;">fhhhhh <br>kegkeke <br>555 <br>aaaa <br>2222</div>

    <div class="bg-gray-200 mx-auto max-w-screen-xl mt-40  p-3 rounded-md shadow-xl">
        <form action="{{ route('cars.available') }}" method="GET">
            <div class="flex justify-center md:flex-row flex-col md:gap-28 gap-4">
                <div class="flex justify-evenly md:flex-row flex-col md:gap-16 gap-2">
                    <input type="text" placeholder="Marque" name="brand"
                    class="block  rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6"
                >
                <input type="text" placeholder="Modèle" name="model"
                    class="block  rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6"
                >
                <input type="number" placeholder=" Prix minimum" name="min_price"
                    class="block  rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6"
                >
                <input type="number" placeholder=" Prix maximum " name="max_price"
                    class="block  rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6"
                >
                    <input type="date" name="start_date" value="{{ request('start_date') }}" style="display: none;">
                    <input type="time" name="delivery_time" value="{{ request('delivery_time') }}"  style="display: none;">
                    <input type="date" name="end_date" value="{{ request('end_date') }}" style="display: none;">
                    <input type="time" name="return_time" value="{{ request('return_time') }}" style="display: none;">
                </div>
                <button class="bg-pr-400 rounded-md text-white p-2 w-25 font-medium hover:bg-pr-500" type="submit" placeholder="brand" > Rechercher</button>
            </div>
        </form>
    </div>

    <div >
    <div style="
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: flex-start;
    gap: 16px;
  ">
        @foreach ($availableCars as $car)
            <div style="margin: 16px; max-width: 320px; flex: 1 1 auto; display: flex; flex-direction: column; height: 500px; background: white;">
                <a class="relative mx-3 mt-3 flex h-60 overflow-hidden rounded-xl" href="{{ route('cin', ['car_id' => $car->id]) }}"
                style="
    display: block;
    width: 300px;     /* même valeur que height */
    height: 300px;
    overflow: hidden;
    position: relative;
    border-radius: 0.5rem;
  "
>
                
                    <img loading="lazy" class="car-image" src="{{ asset('storage/' . $car->image) }}" style="
      width: 100%;
      height: 100%;
      object-fit: cover;
    "alt="product image" />
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
      white-space: nowrap; ">
    {{ $car->reduce }} % de réduction
  </span>
  @endif    
                </a>
                <div class="mt-4 px-5 pb-5" style="display: flex; flex-direction: column; flex: 1;">
                    <div style="flex: 1;">
                        <h5 class="font-bold text-xl tracking-tight text-slate-900">
                            {{ $car->brand }} {{ $car->model }} {{ $car->engine }}
                        </h5>
                        <!-- Ajout du type de boîte -->
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
                        
                            <button type="submit"
                                style="width: 100%; display: flex; align-items: center; justify-content: center; padding: 1rem 0;"
                                class="rounded-md bg-slate-900 hover:bg-pr-400 text-sm font-medium text-white focus:outline-none focus:ring-4 focus:ring-blue-300">
                                <i class="fa-solid fa-calendar-check mr-1" style="margin-right: 0.5rem;"></i>
                                Réserver
                            </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection