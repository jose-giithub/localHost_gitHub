<!DOCTYPE html>
<html>

<head>
    <title>Calendario de Eventos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/calendar.js'])
</head>

<body>
    <div id='top'>
        Locales:
        <select id='locale-selector'></select>
    </div>
    </div>

    <!-- Botón de redirección usando un enlace -->
   
    <a href="{{ route('dashboard') }}" class="btn btn-success">{{ __('Dashboard') }}</a>

    <div id="calendar-container">
        <div id="calendar"></div>
    </div>
    <!-- Modal Crear Evento -->
    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Evento</h5>
                    <button type="button" class="close" aria-label="Close" id="btnCerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('event.store') }}" method="POST" name="form" id="form">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Escribe el título">
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Color:</label><br>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn" style="background-color: #00FF00;">
                                    <input type="radio" name="color" value="#00FF00"> Personal
                                </label>
                                <label class="btn btn-warning">
                                    <input type="radio" name="color" value="#FFFF00"> Trabajo
                                </label>
                                <label class="btn btn-danger">
                                    <input type="radio" name="color" value="#FF0000"> Eventos
                                </label>
                                <label class="btn btn-primary">
                                    <input type="radio" name="color" value="#0000FF"> Recados
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="start">Fecha Inicio:</label>
                            <input type="datetime-local" class="form-control" name="start" id="start" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="end">Fecha final:</label>
                            <input type="datetime-local" class="form-control" name="end" id="end" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Crear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Editar y eliminar evento -->
    <div class="modal fade" id="editEventModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Evento</h5>
                    <button type="button" class="close" aria-label="Close" id="btnClose">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('event.update', ['id' => '__id__']) }}" method="POST" name="editForm" id="editForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="event_id">
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" class="form-control" name="name" id="nameEdit" aria-describedby="helpId" placeholder="Escribe el titulo">
                        </div>

                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea class="form-control" name="description" id="descriptionEdit" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Color:</label><br>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn" style="background-color: #00FF00;">
                                    <input type="radio" name="color" value="#00FF00"> Personal
                                </label>
                                <label class="btn btn-warning">
                                    <input type="radio" name="color" value="#FFFF00"> Trabajo
                                </label>
                                <label class="btn btn-danger">
                                    <input type="radio" name="color" value="#FF0000"> Eventos
                                </label>
                                <label class="btn btn-primary">
                                    <input type="radio" name="color" value="#0000FF"> Recados
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="start">Fecha Inicio:</label>
                                <input type="datetime-local" class="form-control" name="start" id="startEdit" aria-describedby="helpId" placeholder="">
                            </div>

                            <div class="form-group">
                                <label for="end">Fecha final:</label>
                                <input type="datetime-local" class="form-control" name="end" id="endEdit" aria-describedby="helpId" placeholder="">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Editar</button>
                            </div>
                    </form>
                    <form action="{{ route('event.destroy', ['id' => '__id__']) }}" method="POST" name="deleteForm" id="deleteForm">
                        @csrf
                        @method('DELETE')

                        <!-- Campo oculto para almacenar el ID del evento -->
                        <input type="hidden" name="event_id" id="event_id" value="">

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var events = @json($events); // Convertir los eventos a JSON
    </script>
</body>

</html>