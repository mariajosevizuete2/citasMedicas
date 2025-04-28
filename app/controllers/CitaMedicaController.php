<?php

class CitaMedicaController
{
    private $model;
    private $especialidadModel;
    private $pacienteModel;


    public function __construct($pdo)
    {
        $this->model = new CitaMedicaModel($pdo);
        $this->especialidadModel = new EspecialidadModel($pdo);
        $this->pacienteModel = new PacienteModel($pdo);
    }


    public function formCita()
    {
        //Vista para crear citas
        $especialidades = $this->especialidadModel->obtenerEspecialidades();
        $pacientes = $this->pacienteModel->obtenerPacientes();
        require '../app/views/nuevaCita.php';
    }


    public function nuevaCita()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $paciente_id = filter_input(INPUT_POST, 'paciente_id', FILTER_SANITIZE_NUMBER_INT);
            $especialidad_id = filter_input(INPUT_POST, 'especialidad_id', FILTER_SANITIZE_NUMBER_INT);
            $fecha = filter_input(INPUT_POST, 'fecha', FILTER_SANITIZE_STRING);

            // Validar que los campos requeridos estén presentes
            if (!$paciente_id || !$especialidad_id || !$fecha) {
                echo "Todos los campos son obligatorios.";
                return;
            }

            // Validar fecha (no puede ser en el pasado)
            $fecha_input = DateTime::createFromFormat('Y-m-d\TH:i', $fecha);
            if (!$fecha_input || $fecha_input < new DateTime()) {
                echo "La fecha no puede ser en el pasado o el formato es incorrecto.";
                return;
            }

            // Llamar al modelo para guardar la cita
            try {
                $this->model->nuevaCita($paciente_id, $especialidad_id, $fecha_input->format('Y-m-d H:i:s'));
                header("Location: index.php?action=listCitas");
                exit();
            } catch (Exception $e) {
                echo "Error al guardar la cita: " . $e->getMessage();
            }
        }
    }


    public function mostrarCitas()
    {
        $citas = $this->model->obtenerCitas();
        require '../app/views/listaCitas.php';
    }


    public function eliminarCita($id)
    {
        // Validar que el ID sea numérico antes de eliminar
        if (filter_var($id, FILTER_VALIDATE_INT)) {
            try {
                $this->model->eliminarCita($id);
                header("Location: index.php?action=listCitas");
                exit();
            } catch (Exception $e) {
                echo "Error al eliminar la cita: " . $e->getMessage();
            }
        } else {
            echo "ID de cita inválido.";
        }
    }
}
