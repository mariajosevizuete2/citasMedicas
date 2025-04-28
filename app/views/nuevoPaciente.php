<?php include('header.php'); ?>
<h1 class="text-center my-4">Registrar un nuevo paciente</h1>

<form method="POST" action="index.php?action=agregarPaciente" class="mt-4">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" class="form-control" name="nombre" placeholder="Ingrese el nombre del paciente" required pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,25}" 
        maxlength="28"
        title="Solo letras y máximo 28 caracteres">
    </div>

    <div class="mb-3">
        <label for="edad" class="form-label">Edad:</label>
        <input type="text" class="form-control" name="edad" placeholder="Ingrese la edad del paciente" required pattern="\d+"
        maxlength="2"
        title="Ingrese una edad válida">
    </div>


    <div class="mb-3">
        <label for="genero" class="form-label">Género:</label>
        <select name="genero" class="form-control" id="genero" required>
            <option value="">Seleccione un género</option>
            <option value="F">Femenino</option>
            <option value="M">Masculino</option>
        </select>

    </div>


    <div class="text-center">
        <button class="btn btn-success btn-lg mt-5" type="submit">Guardar</button>
    </div>
</form>
<?php include('footer.php'); ?>