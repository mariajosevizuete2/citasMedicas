<?php

class PacienteModel
{
    private $pdo;


    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }



    public function nuevoPaciente($nombre, $edad, $genero)
    {
        try {
            $sql = "INSERT INTO paciente (nombre, edad, genero) VALUES (:nombre, :edad, :genero)";
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':edad', $edad, PDO::PARAM_INT);
            $stmt->bindParam(':genero', $genero, PDO::PARAM_STR);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception('Error al guardar el paciente.');
            }
        } catch (Exception $e) {
            echo "Error al registrar un paciente: " . $e->getMessage();
            return false;
        }
    }


    public function obtenerPacientes()
    {
        // Obtener todos los pacientes
        try {
            $sql = "SELECT * FROM paciente";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error al obtener paciententes: " . $e->getMessage();
            return [];
        }
    }
}
