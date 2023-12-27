
<?php
require_once './config/config.php'; 


class UserRepository
{
    private $users = array();  // Almacena temporalmente los usuarios en memoria

    public function guardarUsuario(User $user)
    {
        // Método para guardar un nuevo usuario en el repositorio
        // Puedes implementar la lógica de almacenamiento real aquí (por ejemplo, en una base de datos)
        $this->users[] = $user;
    }

    public function obtenerUsuarioPorId($id)
    {
        // Método para obtener un usuario por su identificador
        // Puedes implementar la lógica de búsqueda real aquí
        foreach ($this->users as $user) {
            if ($user->getId() == $id) {
                return $user;
            }
        }
        return null;  // Devuelve null si no se encuentra el usuario
    }

    public function actualizarUsuario(User $user)
    {
        // Método para actualizar la información de un usuario en el repositorio
        // Puedes implementar la lógica de actualización real aquí
        // (por ejemplo, actualizar el registro en una base de datos)
        // Nota: Este método asume que el usuario ya existe en el repositorio
    }

    public function eliminarUsuario(User $user)
    {
        // Método para eliminar un usuario del repositorio
        // Puedes implementar la lógica de eliminación real aquí
        // (por ejemplo, eliminar el registro de una base de datos)
        // Nota: Este método asume que el usuario ya existe en el repositorio
    }
}
