<?php

use PHPUnit\Framework\TestCase;
use Users\User;
use Users\UserRepository;

class UserTest extends TestCase {
    public function testCrearUsuario() {
        $usuario = new User(1, 'NombreUsuario', 'correo@example.com', 'contrasena');

        $this->assertInstanceOf(User::class, $usuario);
    }

    // Agregar más pruebas para otros métodos de la clase User

    public function testGuardarUsuarioEnRepositorio() {
        $usuario = new User(1, 'NombreUsuario', 'correo@example.com', 'contrasena');
        $repositorio = new UserRepository();

        $repositorio->guardar($usuario);

        $this->assertEquals([$usuario], $repositorio->getUsuarios());
    }

    // Agregar más pruebas para otros métodos de la clase UserRepository
}
