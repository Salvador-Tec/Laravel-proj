// Initialisation du datepicker Bootstrap
$(document).ready(function() {
    // Configuration du datepicker pour le champ de départ
    $('#datepicker-depart').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true,
        startDate: 'today',
        language: 'fr',
        orientation: 'bottom auto',
        templates: {
            leftArrow: '<i class="fa fa-chevron-left"></i>',
            rightArrow: '<i class="fa fa-chevron-right"></i>'
        }
    });
    
    // Configuration du datepicker pour le champ de retour
    $('#datepicker-retour').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true,
        startDate: 'today',
        language: 'fr',
        orientation: 'bottom auto',
        templates: {
            leftArrow: '<i class="fa fa-chevron-left"></i>',
            rightArrow: '<i class="fa fa-chevron-right"></i>'
        }
    });
    
    // Synchronisation des dates (date de retour après date de départ)
    $('#datepicker-depart').on('changeDate', function(e) {
        var startDate = new Date(e.date);
        $('#datepicker-retour').datepicker('setStartDate', startDate);
        
        // Si la date de retour est antérieure à la date de départ, la réinitialiser
        var returnDate = $('#datepicker-retour input').val();
        if (returnDate) {
            var returnDateObj = new Date(returnDate.split('-').reverse().join('-'));
            if (returnDateObj < startDate) {
                $('#datepicker-retour input').val('');
            }
        }
    });
    
    // Validation des dates
    $('#datepicker-retour').on('changeDate', function(e) {
        var returnDate = new Date(e.date);
        var startDate = $('#datepicker-depart input').val();
        
        if (startDate) {
            var startDateObj = new Date(startDate.split('-').reverse().join('-'));
            if (returnDate < startDateObj) {
                alert('La date de retour doit être postérieure à la date de départ');
                $('#datepicker-retour input').val('');
                return false;
            }
        }
    });
    
    // Amélioration de l'interface utilisateur
    $('.datepicker').addClass('custom-datepicker');
    
    // Animation lors de l'ouverture du datepicker
    $('.date-input').on('focus', function() {
        $(this).parent().addClass('datepicker-open');
    });
    
    $('.date-input').on('blur', function() {
        setTimeout(function() {
            $('.group-select').removeClass('datepicker-open');
        }, 200);
    });
    
    // Style personnalisé pour le datepicker
    $('<style>')
        .prop('type', 'text/css')
        .html(`
            .custom-datepicker {
                border-radius: 12px !important;
                border: 2px solid #007bff !important;
                box-shadow: 0 8px 25px rgba(0, 123, 255, 0.15) !important;
                padding: 15px !important;
                background: white !important;
            }
            
            .custom-datepicker .datepicker-days th,
            .custom-datepicker .datepicker-days td {
                border-radius: 8px !important;
                transition: all 0.3s ease !important;
            }
            
            .custom-datepicker .datepicker-days td:hover {
                background-color: #007bff !important;
                color: white !important;
                transform: scale(1.1) !important;
            }
            
            .custom-datepicker .datepicker-days td.active {
                background: linear-gradient(135deg, #007bff 0%, #0056b3 100%) !important;
                border: none !important;
                box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3) !important;
            }
            
            .custom-datepicker .datepicker-days td.today {
                background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%) !important;
                color: white !important;
                font-weight: bold !important;
            }
            
            .custom-datepicker .datepicker-header {
                background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%) !important;
                border-radius: 8px 8px 0 0 !important;
                padding: 10px !important;
            }
            
            .custom-datepicker .datepicker-title {
                font-weight: 600 !important;
                color: #495057 !important;
            }
            
            .custom-datepicker .datepicker-prev,
            .custom-datepicker .datepicker-next {
                background: linear-gradient(135deg, #007bff 0%, #0056b3 100%) !important;
                border: none !important;
                border-radius: 50% !important;
                width: 30px !important;
                height: 30px !important;
                color: white !important;
                transition: all 0.3s ease !important;
            }
            
            .custom-datepicker .datepicker-prev:hover,
            .custom-datepicker .datepicker-next:hover {
                transform: scale(1.1) !important;
                box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3) !important;
            }
            
            .group-select.datepicker-open .input-group {
                box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.3) !important;
                transform: translateY(-2px) !important;
            }
        `)
        .appendTo('head');
});