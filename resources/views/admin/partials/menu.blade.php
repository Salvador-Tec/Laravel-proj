 <aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu flex-grow-0">
              <div class="container-xxl d-flex h-100">
                <ul class="menu-inner">
                  <!-- Dashboards -->
                  <li class="menu-item active">
                    <a href="{{ route('adminDashboard') }}" class="menu-link ">
                      <i class="menu-icon icon-base ti tabler-smart-home"></i>
                      <div data-i18n="Tableau de bord">Tableau de bord</div>
                    </a>
                  
                  </li>

                  <!-- Layouts -->
                  <li class="menu-item">
                    <a href="{{ route('users') }}" class="menu-link ">
                      <i class="menu-icon icon-base">
                         <svg style="fill: gray; width: 16px; height: 16px;" viewBox="0 0 20 20">
        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
      </svg>

                      </i>
                      <div data-i18n=" Clients">Clients </div>
                    </a>

                  
                  </li>

                  <!-- Apps -->
                  <li class="menu-item">
                    <a href="{{ route('cars.index') }}" class="menu-link ">
                      <i  class="menu-icon icon-base">
                         <svg style="fill: gray; width: 16px; height: 16px;" viewBox="0 0 24 24">
            <path d="M3 13v-2l1-3 2-3h12l2 3 1 3v2h-1a2 2 0 01-4 0H8a2 2 0 01-4 0H3zm16.92 2c.36 0 .64.28.64.64v2.72c0 .36-.28.64-.64.64h-.92c-.36 0-.64-.28-.64-.64v-2.72c0-.36.28-.64.64-.64h.92zM5 15c.36 0 .64.28.64.64v2.72c0 .36-.28.64-.64.64h-.92a.64.64 0 01-.64-.64v-2.72c0-.36.28-.64.64-.64H5z"/>
        </svg>

                      </i>
                      <div data-i18n="Voitures">Voitures</div>
                    </a>
                    
                  </li>

                  <!-- Pages -->
                           <li class="menu-item">
                          <a href="{{ route('admin.active_departures') }}" class="menu-link">
                          <i class="menu-icon icon-base">
                             <svg style="fill: gray; width: 16px; height: 16px;" viewBox="0 0 24 24">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10
                     10-4.48 10-10S17.52 2 12 2zm0 15h-1v-6h2v6h-1zm0-8h-1V7h2v2h-1z"/>
        </svg>

                          </i>
                          <div data-i18n="Informations voitures">Informations voitures</div>
                         </a>
</li>


                  <!-- Components -->
                   <li class="menu-item relative">
    <!-- Départs menu item -->
    <a href="javascript:void(0);" class="menu-link  flex items-center" onclick="toggleCalendar()">
        <i class="menu-icon icon-base">
            <!-- Icône Départ (camion/avion style) en SVG gris, 16x16px -->
            <svg style="fill: gray; width: 16px; height: 16px;" viewBox="0 0 640 512">
                <path d="M544 192h-16L456.5 56.3C447.1 42.1 431 32 413.1 32H226.9c-17.9 0-34 10.1-43.4 24.3L112 192H96c-53 
                         0-96 43-96 96v48c0 8.8 7.2 16 16 16h32c0 35.3 28.7 64 64 64s64-28.7 
                         64-64h256c0 35.3 28.7 64 64 64s64-28.7 64-64h32c8.8 
                         0 16-7.2 16-16v-48c0-53-43-96-96-96zM194.7 83.1c3-4.6 
                         8.1-7.1 13.3-7.1h186c5.2 0 10.3 2.5 13.3 7.1L453.3 192H186.7l8-12.8 
                         48-96zM112 400c-17.7 0-32-14.3-32-32s14.3-32 
                         32-32 32 14.3 32 32-14.3 32-32 32zm384 
                         0c-17.7 0-32-14.3-32-32s14.3-32 
                         32-32 32 14.3 32 32-14.3 32-32 32z"/>
            </svg>
        </i>

        <!-- Texte Départs visible au début -->
        <div id="depart-text" class="ml-2">Départs</div>

        <!-- Input date caché au début, même emplacement que texte -->
        <input 
            type="date" 
            id="departure-date" 
            class="ml-2 border border-gray-300 rounded p-1 hidden" 
             style="display:none;" 
            onchange="showSearchButton()" />
    </a>

    <!-- Bouton de recherche, caché au début -->
    <button
        id="search-button"
        onclick="filterDeparturesByDate()"
        style="display:none;"
        class="hidden ml-2 p-2 bg-pr-400 rounded-full text-white hover:bg-pr-500 flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" fill="currentColor">
            <path d="M505 442.7L405.3 343c28.4-35.3 45.7-80.3 45.7-129 
                     0-114.9-93.1-208-208-208S35 99.1 35 214s93.1 
                     208 208 208c48.7 0 93.7-17.3 
                     129-45.7l99.7 99.7c9.4 9.4 
                     24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 
                     9.4-24.6 0-33.9zM81 214c0-73.4 
                     59.6-133 133-133s133 59.6 
                     133 133-59.6 133-133 133-133-59.6-133-133z"/>
        </svg>
    </button>
</li>
<script>
  function toggleCalendar() {
    const inputDate = document.getElementById('departure-date');
    const departText = document.getElementById('depart-text');
    const searchBtn = document.getElementById('search-button');

    if (inputDate.style.display === 'none' || inputDate.style.display === '') {
        inputDate.style.display = 'inline-block';
        departText.style.display = 'none';
        searchBtn.style.display = 'none';
        inputDate.focus();
    } else {
        inputDate.style.display = 'none';
        departText.style.display = 'block';
        searchBtn.style.display = 'none';
        inputDate.value = '';
    }
}

function showSearchButton() {
    const button = document.getElementById('search-button');
    button.classList.remove('hidden');
    button.style.display = 'flex';
}

function filterDeparturesByDate() {
    const selectedDate = document.getElementById('departure-date').value;
    const rows = document.querySelectorAll('.reservation-row');

    rows.forEach(row => {
        const rowDate = row.getAttribute('data-start-date');
        row.style.display = rowDate === selectedDate ? '' : 'none';
    });
}

// -------------------------
// Version identique pour l'Arrivée :
function toggleArrivalCalendar() {
    const inputDate = document.getElementById('arrival-date');
    const arriveText = document.getElementById('arrive-text');
    const searchBtn = document.getElementById('arrival-search-button');

    if (inputDate.style.display === 'none' || inputDate.style.display === '') {
        inputDate.style.display = 'inline-block';
        arriveText.style.display = 'none';
        searchBtn.style.display = 'none';
        inputDate.focus();
    } else {
        inputDate.style.display = 'none';
        arriveText.style.display = 'block';
        searchBtn.style.display = 'none';
        inputDate.value = '';
    }
}

function showArrivalSearchButton() {
    const button = document.getElementById('arrival-search-button');
    button.classList.remove('hidden');
    button.style.display = 'flex';
}

function filterArrivalsByDate() {
    const selectedDate = document.getElementById('arrival-date').value;
    const rows = document.querySelectorAll('.reservation-row');

    rows.forEach(row => {
        const rowDate = row.getAttribute('data-end-date');
        row.style.display = rowDate === selectedDate ? '' : 'none';
    });
}

</script>
 <li class="menu-item relative">
    <!-- Lien pour afficher/cacher le calendrier d'arrivée -->
    <a href="javascript:void(0);" class="menu-link  flex items-center" onclick="toggleArrivalCalendar()">
        <i class="menu-icon icon-base">
            <!-- Icône SVG -->
            <svg style="fill: gray; width: 16px; height: 16px;" viewBox="0 0 576 512">
                <path d="M544 192H416L362.7 56.3C354.4 39.1 337.1 28.1 318.1 28.1H161.9c-19 0-36.3 11-44.6 28.2L96 192H32c-17.7 0-32 14.3-32 32v64c0 8.8 7.2 16 16 16h16c0 35.3 28.7 64 64 64s64-28.7 64-64h256c0 35.3 28.7 64 64 64s64-28.7 64-64h16c8.8 0 16-7.2 16-16v-64c0-17.7-14.3-32-32-32zM161.9 80h156.3l39.1 80H122.7l39.2-80zM112 320c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm352 0c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32z"/>
                <!-- Finish flag -->
                <g transform="translate(480,20) scale(0.5)">
                    <path d="M0 0v180c0 5.5 4.5 10 10 10h10V0H0z" fill="#000"/>
                    <path d="M20 0v20h20V0H20zM60 0v20h20V0H60zM40 20v20h20V20H40zM0 20v20h20V20H0zM80 20v20h20V20H80zM20 40v20h20V40H20zM60 40v20h20V40H60zM40 60v20h20V60H40zM0 60v20h20V60H0zM80 60v20h20V60H80z" fill="#000"/>
                </g>
            </svg>
        </i>
        <!-- Texte affiché si input caché -->
        <div id="arrive-text" class="ml-2">Arrivés</div>
    </a>

    <!-- Input date : caché ou affiché via JS -->
    <input 
        type="date" 
        id="arrival-date" 
        class="ml-2 border border-gray-300 rounded p-1" 
        style="display:none;" 
        onchange="showArrivalSearchButton()" />

    <!-- Bouton recherche : caché ou affiché via JS -->
    <button
        id="arrival-search-button"
        onclick="filterArrivalsByDate()"
        style="display:none;"
        class="ml-2 p-2 bg-pr-400 rounded-full text-white hover:bg-pr-500 flex items-center justify-center">
        <!-- Loupe SVG -->
        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" fill="currentColor">
            <path d="M505 442.7L405.3 343c28.4-35.3 45.7-80.3 45.7-129 
                     0-114.9-93.1-208-208-208S35 99.1 35 214s93.1 
                     208 208 208c48.7 0 93.7-17.3 
                     129-45.7l99.7 99.7c9.4 9.4 
                     24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 
                     9.4-24.6 0-33.9zM81 214c0-73.4 
                     59.6-133 133-133s133 59.6 
                     133 133-59.6 133-133 133-133-59.6-133-133z"/>
        </svg>
    </button>
</li>

<li class="menu-item">
    <a href="{{ route('reservations.actives') }}" class="menu-link  flex items-center">
        <i class="menu-icon icon-base">
            <!-- Icône de réservation (calendrier) SVG -->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="gray" viewBox="0 0 24 24">
                <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.1 
                         0-2 .9-2 2v14c0 1.1.9 
                         2 2 2h14c1.1 0 2-.9 
                         2-2V6c0-1.1-.9-2-2-2zm0 
                         16H5V9h14v11zm0-13H5V6h14v1z"/>
            </svg>
        </i>
        <div class="ml-2" data-i18n="Réservations Actives">Réservations Actives</div>
    </a>
</li>

                   
                  <!-- Charts & Maps -->
                 <li class="menu-item">
    <a href="javascript:void(0)" class="menu-link  flex items-center">
        <i class="menu-icon icon-base">
            <!-- Icône paiement (carte bancaire) SVG -->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="gray" viewBox="0 0 24 24">
                <path d="M20 4H4c-1.1 0-2 .9-2 
                         2v12c0 1.1.9 2 2 
                         2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 
                         14H4V8h16v10zm0-12H4V6h16v2zM6 
                         12h4v2H6v-2z"/>
            </svg>
        </i>
        <div class="ml-2" data-i18n="Réservations Non Payés">Réservations Non Payés</div>
    </a>
</li>


                 
                  
                      <!-- Extended components -->
                      

                  <!-- Forms -->
                 

                 

                 
                  <!-- Multi Level Menu -->
                  
                </ul>
              </div>
            </aside>