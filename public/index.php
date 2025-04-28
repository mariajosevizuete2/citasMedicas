<?php
require_once '../core/autoload.php';
require_once '../app/config/config.php';
require_once '../core/Database.php';

try {
    $database = new Database();
    $pdo = $database->getConnection();
} catch (PDOException $e) {
    die('Error al conectar a la base de datos: ' . $e->getMessage());
}

$citaController = new CitaMedicaController($pdo);
$pacienteController = new PacienteController($pdo);

$action = $_GET['action'] ?? 'citaForm';

// Enrutamiento de acciones
switch ($action) {
    case 'nuevaCita':
        $citaController->nuevaCita();
        break;

    case 'listCitas':
        $citaController->mostrarCitas();
        break;

    case 'eliminarCita':
        $id = $_GET['id'] ?? null;
        if ($id !== null) {
            $citaController->eliminarCita((int) $id);
        } else {
            echo 'ID de cita no proporcionado.';
        }
        break;

    case 'nuevoPaciente':
        $pacienteController->formPacientes();
        break;

    case 'agregarPaciente':
        $pacienteController->nuevoPaciente();
        break;

    default:
        $citaController->formCita();
        break;
}
