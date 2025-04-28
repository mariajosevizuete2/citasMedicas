<?php

class PacienteController
{
    private $model;


    public function __construct($pdo)
    {
        $this->model = new PacienteModel($pdo);
    }


    public function formPacientes()
    {
        //Vista para crear pacientes
        require '../app/views/nuevoPaciente.php';
    }


    public function nuevoPaciente()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
            $edad = filter_input(INPUT_POST, 'edad', FILTER_VALIDATE_INT);
            $genero = filter_input(INPUT_POST, 'genero', FILTER_SANITIZE_STRING);

            // Validar que los campos requeridos estén presentes
            if ($nombre && $edad && $genero) {
                try {
                    // Llamar al modelo para guardar el paciente
                    $this->model->nuevoPaciente($nombre, $edad, $genero);
                    header("Location: index.php?action=listPacientes");
                    exit();
                } catch (Exception $e) {
                    echo "Error al agregar paciente: " . $e->getMessage();
                }
            } else {
                echo "Datos inválidos. Por favor, verifique los datos ingresados.";
            }
        }
    }
}
