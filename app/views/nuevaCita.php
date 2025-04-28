<?php include('header.php'); ?>

<h1 class="text-center my-4">Registro De Citas Médicas</h1>

<form method="POST" action="index.php?action=nuevaCita" class="mt-4">
    <div class="mb-3">
        <label for="paciente_id" class="form-label">Paciente:</label>
        <select name="paciente_id" class="form-control" required>
            <option value="">Seleccione un paciente</option>
            <?php foreach ($pacientes as $paciente): ?>
                <option value="<?php echo $paciente['id']; ?>">
                    <?php echo $paciente['nombre']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="especialidad_id" class="form-label">Especialidad:</label>
        <select name="especialidad_id" class="form-control" required>
            <option value="">Seleccione una especialidad</option>
            <?php foreach ($especialidades as $especialidad): ?>
                <option value="<?php echo $especialidad['id']; ?>">
                    <?php echo $especialidad['nombre']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="fecha" class="form-label">Fecha:</label>
        <input type="datetime-local" name="fecha" id="fecha" class="form-control" required>
    </div>


    <!-- validar que no se pueda elegir una fecha anterior a la actual -->
    <script>
        const now = new Date();
        const formattedDate = now.toISOString().slice(0, 16);

        const fechaInput = document.getElementById('fecha');
        fechaInput.min = formattedDate;

        // Verificar si la fecha seleccionada es el mismo día
        fechaInput.addEventListener('input', function() {
            const selectedDate = new Date(fechaInput.value);

            // Si es el mismo día, no permitir una hora anterior a la hora actual
            if (selectedDate.toDateString() === now.toDateString()) {
                if (selectedDate.getHours() < now.getHours() || (selectedDate.getHours() === now.getHours() && selectedDate.getMinutes() < now.getMinutes())) {
                    fechaInput.setCustomValidity("La hora no puede ser menor a la hora actual.");
                } else {
                    fechaInput.setCustomValidity("");
                }
            }
        });
    </script>

    <div class="text-center">
        <button class="btn btn-success btn-lg mt-5" type="submit">Guardar</button>
    </div>
</form>

<?php include('footer.php'); ?>