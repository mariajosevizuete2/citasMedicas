<?php

class EspecialidadModel
{

    private $pdo;


    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function obtenerEspecialidades()
    {
        //Obtener todas las especialidades
        try {
            $sql = "SELECT * FROM especialidad";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return [];
            }
        } catch (Exception $e) {
            echo "Error al obtener especialidades: " . $e->getMessage();
            return [];
        }
    }
}
