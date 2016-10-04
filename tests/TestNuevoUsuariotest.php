<?php

class TestNuevoUsuariotest extends TestCase
{

    /**
     * My test implementation
     */
    public function testLoginAutorizador()
    {
        $this->assertTrue(true);
        $this->visit('/');
        $this->press('Toggle Navigation');
        $this->seePageIs('/login');
        $this->type('alexlaley10@gmail.com', 'email');
        $this->type('todociber', 'password');
        $this->check('remember');
        $this->press('Login');
        $this->seePageIs('/UsuarioCasaCorredora');
        $this->visit('/UsuarioCasaCorredora/crear');
        $this->type('Carlos Eduardo', 'nombre');
        $this->type('Perez', 'apellido');
        $this->type('todociber100@hotmail.com', 'email');
        $this->check('rolUsuario[]');
        $this->check('rolUsuario[]');
        $this->check('rolUsuario[]');
        $this->press('');
        $this->seePageIs('/UsuarioCasaCorredora');
        $this->visit('/UsuarioCasaCorredora/3/editar');
        $this->uncheck('rolUsuario[]');
        $this->press('');
        $this->seePageIs('/UsuarioCasaCorredora');
        $this->press('');
        $this->seePageIs('/UsuarioCasaCorredora');
        $this->visit('/UsuarioCasaCorredora');
    }
}
