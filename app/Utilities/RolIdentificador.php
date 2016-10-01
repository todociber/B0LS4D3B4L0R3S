<?php


namespace App\Utilities;


class RolIdentificador
{


    public function Autorizador($usuario)
    {
        $Autorizador = false;
        $roles = $usuario->UsuarioRoles;
        foreach ($roles as $rol) {
            if ($rol->idRol == 3) {
                $Autorizador = true;
            }
        }
        return $Autorizador;

    }

    public function Administrador($usuario)
    {
        $Administrador = false;
        $roles = $usuario->UsuarioRoles;
        foreach ($roles as $rol) {
            if ($rol->idRol == 2) {
                $Administrador = true;
            }
        }
        return $Administrador;
    }

    public function AgenteCorredor($usuario)
    {
        $AgenteCorredor = false;
        $roles = $usuario->UsuarioRoles;
        foreach ($roles as $rol) {
            if ($rol->idRol == 4) {
                $AgenteCorredor = true;
            }
        }
        return $AgenteCorredor;
    }


}

?>