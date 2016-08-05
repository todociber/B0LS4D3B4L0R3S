<?php

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/login');

        $this->type('alexlaley10@gmail.com', 'email');
        $this->type('todociber', 'password');
        $this->check('remember');
        $this->press('Login');
        $this->visit('/SolicitudAfiliacion');
        $this->visit('/SolicitudAfiliacion/1/detalle');
        $this->visit('/SolicitudAfiliacion');

    }
}
