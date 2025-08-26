
<!doctype html>

<html
  lang="en"
  class="layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="ltr"
  data-skin="default"
  data-assets-path="../../full-version/assets/"
  data-template="horizontal-menu-template"
  data-bs-theme="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />



    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="../../full-version/assets/vendor/fonts/iconify-icons.css" />

    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->

    <link rel="stylesheet" href="../../full-version/assets/vendor/libs/node-waves/node-waves.css" />

    <link rel="stylesheet" href="../../full-version/assets/vendor/libs/pickr/pickr-themes.css" />

    <link rel="stylesheet" href="../../full-version/assets/vendor/css/core.css" />
    <link rel="stylesheet" href="../../full-version/assets/css/demo.css" />

    <!-- Vendors CSS -->

    <link rel="stylesheet" href="../../full-version/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- endbuild -->

    <link rel="stylesheet" href="../../full-version/assets/vendor/libs/fullcalendar/fullcalendar.css" />
    <link rel="stylesheet" href="../../full-version/assets/vendor/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="../../full-version/assets/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="../../full-version/assets/vendor/libs/quill/editor.css" />
    <link rel="stylesheet" href="../../full-version/assets/vendor/libs/@form-validation/form-validation.css" />

    <!-- Page CSS -->

    <link rel="stylesheet" href="../../full-version/assets/vendor/css/pages/app-calendar.css" />

    <!-- Helpers -->
    <script src="../../full-version/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="../../full-version/assets/vendor/js/template-customizer.js"></script>

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script src="../../full-version/assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
      <div class="layout-container">
        <!-- Navbar -->

        
        <!-- Layout container -->
        <div class="layout-page">
          <!-- Content wrapper -->
          <div class="content-wrapper">
          

          <!-- Content -->
          
@php
    // Supposons que la voiture a une relation "reservations" et que tu veux récupérer la réservation active
    $activeReservation = $car->reservations->where('status', 'active')->first();
@endphp

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Bouton Date avec DatePicker -->
    <div class="relative mb-4" style="max-width: 250px;">
        <input 
            type="date" 
            id="datepicker-{{ $car->id }}" 
            class="datepicker opacity-0 absolute left-0 top-0 w-full h-full"
            placeholder="Sélectionner une date"
        />
        <div onclick="openDatepicker()" 
             class="cursor-pointer p-3 bg-pr-400 rounded-full text-white hover:bg-pr-500 inline-flex items-center justify-center"
             style="width: 2.5rem; height: 2.5rem;">
            <svg xmlns="http://www.w3.org/2000/svg" 
                 class="h-5 w-5" 
                 fill="currentColor" 
                 viewBox="0 0 448 512">
                <path d="M152 64V32c0-17.7-14.3-32-32-32s-32 14.3-32 32V64H64C28.7 64 0 92.7 0 128V448c0 35.3 
                28.7 64 64 64H384c35.3 0 64-28.7 64-64V128c0-35.3-28.7-64-64-64H360V32c0-17.7-14.3-32-32-32s-32 
                14.3-32 32V64H152zM64 160H384V448H64V160z"/>
            </svg>
        </div>
    </div>
    

    <div class="card app-calendar-wrapper">
        <div class="row g-0">
            <!-- Calendar Sidebar -->
            <div class="col app-calendar-sidebar border-end" id="app-calendar-sidebar">
                <div class="border-bottom p-6 my-sm-0 mb-4">
                    <button
                        class="btn btn-primary btn-toggle-sidebar w-100"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#addEventSidebar"
                        aria-controls="addEventSidebar">
                        <i class="icon-base ti tabler-plus icon-16px me-2"></i>
                        <span class="align-middle">Add Event</span>
                    </button>
                </div>
                <div class="px-3 pt-2">
                    <!-- inline calendar (flatpicker) -->
                    <div class="px-3 pt-2">
    @php
        // Récupérer la réservation active
        $activeReservation = $car->reservations->where('status', 'active')->first();
    @endphp

    <div class="relative" style="max-width: 250px;">
        <!-- Input date caché pour flatpickr -->
        <input 
            type="text" 
            id="datepicker-{{ $car->id }}" 
            class="datepicker form-control"
            placeholder="Sélectionner une date"
                placeholder="Réservé du {{ $activeReservation?->start_date }} à {{ $activeReservation?->end_date }}"

            readonly
        />
       

        <!-- Icône calendrier cliquable stylisée -->
        <div onclick="openDatepicker()" 
             class="cursor-pointer p-3 bg-pr-400 rounded-full text-white hover:bg-pr-500 inline-flex items-center justify-center"
             style="width: 2.5rem; height: 2.5rem;">
            <svg xmlns="http://www.w3.org/2000/svg" 
                 class="h-5 w-5" 
                 fill="currentColor" 
                 viewBox="0 0 448 512">
                <path d="M152 64V32c0-17.7-14.3-32-32-32s-32 14.3-32 32V64H64C28.7 64 0 92.7 0 128V448c0 35.3 
                28.7 64 64 64H384c35.3 0 64-28.7 64-64V128c0-35.3-28.7-64-64-64H360V32c0-17.7-14.3-32-32-32s-32 
                14.3-32 32V64H152zM64 160H384V448H64V160z"/>
            </svg>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    flatpickr("#datepicker-{{ $car->id }}", {
        dateFormat: "d/m/Y",
        disable: [
            {
                from: "{{ $activeReservation?->start_date }}",
                to: "{{ $activeReservation?->end_date }}"
            }
        ],
        onDayCreate: function(dObj, dStr, fp, dayElem) {
            const startDateStr = "{{ $activeReservation?->start_date }}";
            const endDateStr = "{{ $activeReservation?->end_date }}";

            if (!startDateStr || !endDateStr) return;

            const startDate = new Date(startDateStr);
            const endDate = new Date(endDateStr);
            const date = new Date(dayElem.dateObj);

            if (date >= startDate && date <= endDate) {
                dayElem.style.backgroundColor = '#f87171'; // rouge clair
                dayElem.style.color = 'white';
                dayElem.style.borderRadius = '50%';
                dayElem.style.cursor = 'not-allowed';
                dayElem.setAttribute('title', `Réservé du ${startDateStr} au ${endDateStr}`);
            }
        }
    });
});
</script>
<style>
.form-control {
    padding: 0.5rem 0.75rem;
    font-size: 1rem;
    border-radius: 0.375rem;
    border: 1px solid #ccc;
    width: 100%;
    max-width: 250px;
}
</style>


                </div>
                <hr class="mb-6 mx-n4 mt-3" />
                <div class="px-6 pb-2">
                    <!-- Filter -->
                    <div>
                        <h5>Event Filters</h5>
                    </div>

                    <div class="form-check form-check-secondary mb-5 ms-2">
                        <input
                            class="form-check-input select-all"
                            type="checkbox"
                            id="selectAll"
                            data-value="all"
                            checked />
                        <label class="form-check-label" for="selectAll">View All</label>
                    </div>

                    <div class="app-calendar-events-filter text-heading">
                        <div class="form-check form-check-danger mb-5 ms-2">
                            <input
                                class="form-check-input input-filter"
                                type="checkbox"
                                id="select-personal"
                                data-value="personal"
                                checked />
                            <label class="form-check-label" for="select-personal">Personal</label>
                        </div>
                        <div class="form-check mb-5 ms-2">
                            <input
                                class="form-check-input input-filter"
                                type="checkbox"
                                id="select-business"
                                data-value="business"
                                checked />
                            <label class="form-check-label" for="select-business">Business</label>
                        </div>
                        <div class="form-check form-check-warning mb-5 ms-2">
                            <input
                                class="form-check-input input-filter"
                                type="checkbox"
                                id="select-family"
                                data-value="family"
                                checked />
                            <label class="form-check-label" for="select-family">Family</label>
                        </div>
                        <div class="form-check form-check-success mb-5 ms-2">
                            <input
                                class="form-check-input input-filter"
                                type="checkbox"
                                id="select-holiday"
                                data-value="holiday"
                                checked />
                            <label class="form-check-label" for="select-holiday">Holiday</label>
                        </div>
                        <div class="form-check form-check-info ms-2">
                            <input
                                class="form-check-input input-filter"
                                type="checkbox"
                                id="select-etc"
                                data-value="etc"
                                checked />
                            <label class="form-check-label" for="select-etc">ETC</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Calendar Sidebar -->
@php
    $reservations = $car->reservations->where('status', 'active')->map(function($reservation) {
        return [
            'title' => "Réservé du {$reservation->start_date} au {$reservation->end_date}",
            'start' => $reservation->start_date,
            'end' => date('Y-m-d', strtotime($reservation->end_date . ' +1 day')),
            'color' => '#f87171', // rouge clair
            'allDay' => true,
            'description' => "Réservé du {$reservation->start_date} au {$reservation->end_date}"
        ];
    });
@endphp

<script>
 document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    locale: 'fr',
    events: {!! $reservations->toJson() !!},
    eventColor: '#f87171',
    eventDisplay: 'block', // affichage bloc coloré
    eventDidMount: function(info) {
      // Ajoute un tooltip avec la description
      if (info.event.extendedProps.description) {
        info.el.setAttribute('title', info.event.extendedProps.description);
      }
    }
  });

  calendar.render();
});

</script>

            <!-- Calendar & Modal -->
            <div class="col app-calendar-content">
                <div class="card shadow-none border-0">
                    <div class="card-body pb-0">
                        <!-- FullCalendar -->
                        <div id="calendar"></div>
                    </div>
                </div>
                <div class="app-overlay"></div>
                <!-- FullCalendar Offcanvas -->
                <div
                    class="offcanvas offcanvas-end event-sidebar"
                    tabindex="-1"
                    id="addEventSidebar"
                    aria-labelledby="addEventSidebarLabel">
                    <div class="offcanvas-header border-bottom">
                        <h5 class="offcanvas-title" id="addEventSidebarLabel">Add Event</h5>
                        <button
                            type="button"
                            class="btn-close text-reset"
                            data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <form class="event-form pt-0" id="eventForm" onsubmit="return false">
                            <div class="mb-5 form-control-validation">
                                <label class="form-label" for="eventTitle">Title</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="eventTitle"
                                    name="eventTitle"
                                    placeholder="Event Title" />
                            </div>
                            <div class="mb-5">
                                <label class="form-label" for="eventLabel">Label</label>
                                <select class="select2 select-event-label form-select" id="eventLabel" name="eventLabel">
                                    <option data-label="primary" value="Business" selected>Business</option>
                                    <option data-label="danger" value="Personal">Personal</option>
                                    <option data-label="warning" value="Family">Family</option>
                                    <option data-label="success" value="Holiday">Holiday</option>
                                    <option data-label="info" value="ETC">ETC</option>
                                </select>
                            </div>
                            <div class="mb-5 form-control-validation">
                                <label class="form-label" for="eventStartDate">Start Date</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="eventStartDate"
                                    name="eventStartDate"
                                    placeholder="Start Date" />
                            </div>
                            <div class="mb-5 form-control-validation">
                                <label class="form-label" for="eventEndDate">End Date</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="eventEndDate"
                                    name="eventEndDate"
                                    placeholder="End Date" />
                            </div>
                            <div class="mb-5">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input allDay-switch" id="allDaySwitch" />
                                    <label class="form-check-label" for="allDaySwitch">All Day</label>
                                </div>
                            </div>
                            <div class="mb-5">
                                <label class="form-label" for="eventURL">Event URL</label>
                                <input
                                    type="url"
                                    class="form-control"
                                    id="eventURL"
                                    name="eventURL"
                                    placeholder="https://www.google.com" />
                            </div>
                            <div class="mb-4 select2-primary">
                                <label class="form-label" for="eventGuests">Add Guests</label>
                                <select
                                    class="select2 select-event-guests form-select"
                                    id="eventGuests"
                                    name="eventGuests"
                                    multiple>
                                    <option data-avatar="1.png" value="Jane Foster">Jane Foster</option>
                                    <option data-avatar="3.png" value="Donna Frank">Donna Frank</option>
                                    <option data-avatar="5.png" value="Gabrielle Robertson">Gabrielle Robertson</option>
                                    <option data-avatar="7.png" value="Lori Spears">Lori Spears</option>
                                    <option data-avatar="9.png" value="Sandy Vega">Sandy Vega</option>
                                    <option data-avatar="11.png" value="Cheryl May">Cheryl May</option>
                                </select>
                            </div>
                            <div class="mb-5">
                                <label class="form-label" for="eventLocation">Location</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="eventLocation"
                                    name="eventLocation"
                                    placeholder="Enter Location" />
                            </div>
                            <div class="mb-5">
                                <label class="form-label" for="eventDescription">Description</label>
                                <textarea class="form-control" name="eventDescription" id="eventDescription"></textarea>
                            </div>
                            <div class="d-flex justify-content-sm-between justify-content-start mt-6 gap-2">
                                <div class="d-flex">
                                    <button type="submit" id="addEventBtn" class="btn btn-primary btn-add-event me-4">
                                        Add
                                    </button>
                                    <button
                                        type="reset"
                                        class="btn btn-label-secondary btn-cancel me-sm-0 me-1"
                                        data-bs-dismiss="offcanvas">
                                        Cancel
                                    </button>
                                </div>
                                <button class="btn btn-label-danger btn-delete-event d-none">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Calendar & Modal -->
        </div>
    </div>
</div>
<!--/ Content -->

{{-- Flatpickr CSS et JS --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    flatpickr("#datepicker-{{ $car->id }}", {
        disable: [
            {
                from: "{{ $activeReservation?->start_date }}",
                to: "{{ $activeReservation?->end_date }}"
            }
        ],
        onDayCreate: function(dObj, dStr, fp, dayElem) {
            const startDateStr = "{{ $activeReservation?->start_date }}";
            const endDateStr = "{{ $activeReservation?->end_date }}";

            if (!startDateStr || !endDateStr) return;

            const startDate = new Date(startDateStr);
            const endDate = new Date(endDateStr);
            const date = new Date(dayElem.dateObj);

            if (date >= startDate && date <= endDate) {
                dayElem.style.backgroundColor = '#f87171'; // rouge clair
                dayElem.style.color = 'white';
                dayElem.style.borderRadius = '50%';
                dayElem.style.cursor = 'not-allowed';
                dayElem.setAttribute('title', `Réservé du ${startDateStr} au ${endDateStr}`);
            }
        }
    });
});

function openDatepicker() {
    const input = document.querySelector('#datepicker-{{ $car->id }}');
    if (input && input._flatpickr) {
        input._flatpickr.open();
    }
}
</script>


            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl">
                <div
                  class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                  <div class="text-body">
                    ©
                    <script>
                      document.write(new Date().getFullYear());
                    </script>
                    , made with ❤️ by <a href="https://pixinvent.com" target="_blank" class="footer-link">Pixinvent</a>
                  </div>
                  <div class="d-none d-lg-inline-block">
                    <a href="https://themeforest.net/licenses/standard" class="footer-link me-4" target="_blank"
                      >License</a
                    >
                    <a href="https://themeforest.net/user/pixinvent/portfolio" target="_blank" class="footer-link me-4"
                      >More Themes</a
                    >

                    <a
                      href="https://demos.pixinvent.com/vuexy-html-admin-template/documentation/"
                      target="_blank"
                      class="footer-link me-4"
                      >Documentation</a
                    >

                    <a href="https://pixinvent.ticksy.com/" target="_blank" class="footer-link d-none d-sm-inline-block"
                      >Support</a
                    >
                  </div>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!--/ Content wrapper -->
        </div>

        <!--/ Layout container -->
      </div>
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>

    <!--/ Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/theme.js -->

    <script src="../../full-version/assets/vendor/libs/jquery/jquery.js"></script>

    <script src="../../full-version/assets/vendor/libs/popper/popper.js"></script>
    <script src="../../full-version/assets/vendor/js/bootstrap.js"></script>
    <script src="../../full-version/assets/vendor/libs/node-waves/node-waves.js"></script>

    <script src="../../full-version/assets/vendor/libs/@algolia/autocomplete-js.js"></script>

    <script src="../../full-version/assets/vendor/libs/pickr/pickr.js"></script>

    <script src="../../full-version/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../../full-version/assets/vendor/libs/hammer/hammer.js"></script>

    <script src="../../full-version/assets/vendor/libs/i18n/i18n.js"></script>

    <script src="../../full-version/assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../../full-version/assets/vendor/libs/fullcalendar/fullcalendar.js"></script>
    <script src="../../full-version/assets/vendor/libs/@form-validation/popular.js"></script>
    <script src="../../full-version/assets/vendor/libs/@form-validation/bootstrap5.js"></script>
    <script src="../../full-version/assets/vendor/libs/@form-validation/auto-focus.js"></script>
    <script src="../../full-version/assets/vendor/libs/select2/select2.js"></script>
    <script src="../../full-version/assets/vendor/libs/moment/moment.js"></script>
    <script src="../../full-version/assets/vendor/libs/flatpickr/flatpickr.js"></script>

    <!-- Main JS -->

    <script src="../../full-version/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../../full-version/assets/js/app-calendar-events.js"></script>
    <script src="../../full-version/assets/js/app-calendar.js"></script>
  </body>
</html>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      events: [
        @foreach($car->reservations as $reservation)
          {
            title: 'Réservé',
            start: '{{ $reservation->start_date }}',
            end: '{{ $reservation->end_date }}',
            color: '#f87171'
          },
        @endforeach
      ]
    });
    calendar.render();
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<!-- CSS Flatpickr -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- JS Flatpickr -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    flatpickr("#datepicker-{{ $car->id }}", {
        disable: [
            {
                from: "{{ $activeReservation?->start_date }}",
                to: "{{ $activeReservation?->end_date }}"
            }
        ],
        onDayCreate: function(dObj, dStr, fp, dayElem) {
            const startDateStr = "{{ $activeReservation?->start_date }}";
            const endDateStr = "{{ $activeReservation?->end_date }}";

            if (!startDateStr || !endDateStr) return;

            const startDate = new Date(startDateStr);
            const endDate = new Date(endDateStr);
            const date = new Date(dayElem.dateObj);

            if (date >= startDate && date <= endDate) {
                dayElem.style.backgroundColor = '#f87171'; // rouge clair
                dayElem.style.color = 'white';
                dayElem.style.borderRadius = '50%';
                dayElem.style.cursor = 'not-allowed';
                dayElem.setAttribute('title', `Réservé du ${startDateStr} au ${endDateStr}`);
            }
        }
    });
});
</script>
<script>
function openDatepicker() {
    // Ouvre le flatpickr sur ton input
    const input = document.querySelector('#datepicker-{{ $car->id }}');
    if(input) {
        input._flatpickr.open();
    }
}
</script>
 <script>
    document.addEventListener('DOMContentLoaded', function () {
        flatpickr("#datepicker-{{ $car->id }}", {
            disable: [
                {
                    from: "{{ $activeReservation?->start_date }}",
                    to: "{{ $activeReservation?->end_date }}"
                }
            ],
            onDayCreate: function(dObj, dStr, fp, dayElem) {
                const startDateStr = "{{ $activeReservation?->start_date }}";
                const endDateStr = "{{ $activeReservation?->end_date }}";

                if (!startDateStr || !endDateStr) return;

                const startDate = new Date(startDateStr);
                const endDate = new Date(endDateStr);
                const date = new Date(dayElem.dateObj);

                if (date >= startDate && date <= endDate) {
                    dayElem.style.backgroundColor = '#f87171'; // rouge clair
                    dayElem.style.color = 'white';
                    dayElem.style.borderRadius = '50%';
                    dayElem.style.cursor = 'not-allowed';
                    dayElem.setAttribute('title', `Réservé du ${startDateStr} au ${endDateStr}`);
                }
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        flatpickr("#datepicker-{{ $car->id }}", {
            disable: [
                {
                    from: "{{ $car->reservations->where('status', 'active')->first()?->start_date }}",
                    to: "{{ $car->reservations->where('status', 'active')->first()?->end_date }}"
                }
            ],
            onDayCreate: function(dObj, dStr, fp, dayElem) {
                const startDateStr = "{{ $car->reservations->where('status', 'active')->first()?->start_date }}";
                const endDateStr = "{{ $car->reservations->where('status', 'active')->first()?->end_date }}";

                if (!startDateStr || !endDateStr) return;

                const startDate = new Date(startDateStr);
                const endDate = new Date(endDateStr);
                const date = new Date(dayElem.dateObj);

                if (date >= startDate && date <= endDate) {
                    dayElem.style.backgroundColor = '#f87171';
                    dayElem.style.color = 'white';
                    dayElem.style.borderRadius = '50%';
                    dayElem.style.cursor = 'not-allowed';
                    dayElem.setAttribute('title', `Réservé du ${startDateStr} au ${endDateStr}`);
                }
            }
        });
    });

    function toggleDatepicker(id) {
        const datepicker = document.getElementById(`datepicker-${id}`);
        datepicker.classList.toggle('hidden');
    }

    document.addEventListener('click', function(event) {
        const datepicker = document.getElementById('datepicker-{{ $car->id }}');
        const trigger = datepicker.previousElementSibling;

        if (!datepicker.contains(event.target) && !trigger.contains(event.target)) {
            datepicker.classList.add('hidden');
        }
    });
</script>



        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const highlightedRow = document.querySelector('tr.bg-yellow-100');
                if (highlightedRow) {
                    highlightedRow.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            });
        </script>
        <script>
  function toggleActionsMenu(id) {
    const menu = document.getElementById(`actionsMenu-${id}`);
    const btn = document.getElementById(`actionMenuBtn-${id}`);
    const isHidden = menu.classList.contains('hidden');

    if (isHidden) {
      menu.classList.remove('hidden');
      btn.setAttribute('aria-expanded', 'true');
    } else {
      menu.classList.add('hidden');
      btn.setAttribute('aria-expanded', 'false');
    }
  }

  // Fermer le menu si clic en dehors
  document.addEventListener('click', function(event) {
    document.querySelectorAll('[id^="actionsMenu-"]').forEach(menu => {
      const btnId = menu.id.replace('actionsMenu', 'actionMenuBtn');
      const btn = document.getElementById(btnId);
      if (!menu.contains(event.target) && !btn.contains(event.target)) {
        menu.classList.add('hidden');
        btn.setAttribute('aria-expanded', 'false');
      }
    });
  });
</script>

        <style>
            .bg-yellow-100 {
                background-color: #fefcbf; /* Couleur jaune pâle */
            }
        </style>

        <!-- Affichage du message de succès avec SweetAlert -->
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: '{{ session('error') }}',
                    showConfirmButton: false,
                    timer: 3500
                });
            </script>
        @endif
    </div>
    

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


