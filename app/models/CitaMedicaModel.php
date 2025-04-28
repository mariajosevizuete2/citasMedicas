<?php

class CitaMedicaModel
{
    private $pdo;


    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }


    public function nuevaCita($paciente_id, $especialidad_id, $fecha)
    {
        try {
            $this->pdo->beginTransaction();

            $sql = "INSERT INTO cita_medica (paciente_id, especialidad_id, fecha) 
                    VALUES (:paciente_id, :especialidad_id, :fecha)";
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':paciente_id', $paciente_id, PDO::PARAM_INT);
            $stmt->bindParam(':especialidad_id', $especialidad_id, PDO::PARAM_INT);
            $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                $this->pdo->commit();
                return true;
            } else {
                throw new Exception('Error al guardar el paciente.');
            }
        } catch (Exception $e) {
            echo "Error al registrar una cita: " . $e->getMessage();
            return false;
        }
    }


    public function obtenerCitas()
    {
        // Obtener todas las citas
        try {
            $sql = "
                SELECT cita_medica.id, paciente.nombre AS paciente, especialidad.nombre AS especialidad, cita_medica.fecha
                FROM cita_medica
                INNER JOIN paciente ON cita_medica.paciente_id = paciente.id
                INNER JOIN especialidad ON cita_medica.especialidad_id = especialidad.id
                ORDER BY id
            ";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error al obtener citas: " . $e->getMessage();
            return [];
        }
    }


    public function eliminarCita($id)
    {
        //Eliminar una cita específica
        try {
            $sql = "DELETE FROM cita_medica WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            echo "Error al eliminar una cita: " . $e->getMessage();
        }
    }
}
