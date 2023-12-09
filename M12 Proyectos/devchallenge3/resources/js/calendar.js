import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import multiMonthPlugin from '@fullcalendar/multimonth';
import timeGridPlugin from '@fullcalendar/timegrid';
import allLocales from '@fullcalendar/core/locales-all';
import { Modal } from 'bootstrap';
import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';


document.addEventListener('DOMContentLoaded', function () {
    var initialLocaleCode = 'es';
    var localeSelectorEl = document.getElementById('locale-selector');
    var calendarEl = document.getElementById('calendar');
    var eventModal = new Modal(document.getElementById('eventModal'));
    var editEventModal = new Modal(document.getElementById('editEventModal'));

    var calendar = new Calendar(calendarEl, {
        locales: allLocales,
        locale: 'es',
        plugins: [dayGridPlugin, interactionPlugin, multiMonthPlugin, timeGridPlugin],
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next,today',
            center: 'title',
            right: 'timeGridWeek,timeGridDay,dayGridMonth,multiMonthYear',
        },
        dateClick: function (info) {
            // Verificar la vista actual
            if (calendar.view.type !== 'timeGridDay') {
                // Si no estamos en la vista del día, cambiamos a ella
                calendar.changeView('timeGridDay', info.dateStr);
            } else {
                // Si ya estamos en la vista del día, mostramos el popup
                openEventModal(info.date);
            }
        },
        eventClick: function (info) {
            openEditEventModal(info);
        },
        events: events.map(event => ({
            id: event.id,
            title: event.name,
            description: event.description,
            backgroundColor: event.color,
            start: event.start,
            end: event.end,
        })),
    });

    calendar.render();

    // build the locale selector's options
    calendar.getAvailableLocaleCodes().forEach(function (localeCode) {
        var optionEl = document.createElement('option');
        optionEl.value = localeCode;
        optionEl.selected = localeCode == initialLocaleCode;
        optionEl.innerText = localeCode;
        localeSelectorEl.appendChild(optionEl);
    });

    // when the selected option changes, dynamically change the calendar option
    localeSelectorEl.addEventListener('change', function () {
        if (this.value) {
            calendar.setOption('locale', this.value);
        }
    });

    function openEventModal(date) {
        // Restablecer formulario
        document.getElementById('form').reset();

        // Ajustar la hora local antes de formatearla
        var localDate = new Date(date.getTime() - (date.getTimezoneOffset() * 60000));

        // Formatear la fecha y hora en el formato 'YYYY-MM-DDTHH:mm'
        var formattedDate = localDate.toISOString().slice(0, 16);
        // Establecer la fecha y hora en el formulario
        document.getElementById('start').value = formattedDate;
        document.getElementById('end').value = formattedDate;

        // Mostrar el modal
        eventModal.show();
    }
    // Manejar el cierre del modal
    document.getElementById('btnCerrar').addEventListener('click', function () {
        var eventModalElement = document.getElementById('eventModal');
        var eventModal = Modal.getInstance(eventModalElement);
        if (eventModal) {
            eventModal.hide();
        }
    });
    function openEditEventModal(info) {
        // Obtener el evento del objeto proporcionado
        var event = info.event;

        // Llenar el formulario con los datos del evento
        document.querySelector('#event_id').value = event.id;
        document.querySelector('#editForm').action = document.querySelector('#editForm').action.replace('__id__', event.id);
        document.querySelector('#nameEdit').value = event.title;
        document.querySelector('#descriptionEdit').value = event.extendedProps.description;

        // Obtener el color del evento
        var eventColor = event.backgroundColor;

        // Desmarcar todos los botones de radio
        var colorRadios = document.querySelectorAll('input[name="color"]');
        colorRadios.forEach(function (radio) {
            radio.checked = false;
        });

        // Marcar el botón de radio correspondiente al color del evento
        var selectedRadio = document.querySelector('input[name="color"][value="' + eventColor + '"]');
        if (selectedRadio) {
            selectedRadio.checked = true;
        }

        // Obtener el desplazamiento de la zona horaria del evento
        var timezoneOffset = event.start.getTimezoneOffset();

        // Ajustar las fechas originales según el desplazamiento de la zona horaria
        var originalStart = new Date(event.start.getTime() - timezoneOffset * 60000).toISOString().slice(0, 16);
        var originalEnd = new Date(event.end.getTime() - timezoneOffset * 60000).toISOString().slice(0, 16);

        document.querySelector('#startEdit').value = originalStart;
        document.querySelector('#endEdit').value = originalEnd;

        // Configura la URL de eliminación en el formulario
        document.querySelector('#deleteForm').action = '/event/destroy/' + event.id;


        // Mostrar el modal de edición
        editEventModal.show();
    }

    // Manejar el cierre del modal
    document.getElementById('btnClose').addEventListener('click', function () {
        var eventModalElement = document.getElementById('editEventModal');
        var eventModal = Modal.getInstance(eventModalElement);
        if (eventModal) {
            eventModal.hide();
        }
    });
});
