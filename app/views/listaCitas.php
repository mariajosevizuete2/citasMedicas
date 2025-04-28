<?php include('header.php'); ?>

<h1 class="text-center my-4">Listado De Citas Médicas</h1>

<table class="table mt-4">
    <tr>
        <th>Id</th>
        <th>Paciente</th>
        <th>Especialidad</th>
        <th>Fecha</th>
        <th>Acción</th>
    </tr>
    <?php foreach ($citas as $cita): ?>
        <tr>
            <td><?php echo $cita['id']; ?> </td>
            <td><?php echo $cita['paciente']; ?> </td>
            <td><?php echo $cita['especialidad']; ?> </td>
            <td><?php echo $cita['fecha']; ?> </td>
            <td>
                <a class="btn btn-danger" href="index.php?action=eliminarCita&id=<?php echo $cita['id']; ?>" onclick="return confirm('¿Está seguro de eliminar esta cita?');">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php include('footer.php'); ?>