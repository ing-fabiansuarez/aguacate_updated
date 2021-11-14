<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{

    public function __construct()
    {
        $this->rulesvalidation = \Config\Services::validation();
        $this->mdlUser = new UserModel();
    }

    //--------------------------------------------------------------------
    public function login()
    {
        if (!session()->is_logged) {
            return view('auth/login_admin');
        } else {
            return redirect()->route('admin_page_home');
        }
    }

    public function signin()
    {
        //se validan los datos que se estan recibiendo mediante post
        if (!($this->validate(
            $this->rulesvalidation->getRuleGroup('loginForm')
        ))) {
            return redirect()->back()->with('errorValidation', $this->validator->getErrors())->withInput();
        }
        //CON TRIM QUITAMOS LOS ESPACIOS QUE ALLA EN EL INICIO O EN EL FINAL
        $inputUser = trim($this->request->getPost('usuario'));
        $inputPassword = trim($this->request->getPost('clave'));

        //verificacion si existe el usuario
        if (!$user = $this->mdlUser->find($inputUser)) {
            return redirect()->back()->with('msg', ['body' => 'Este usuario no se encuentra registrado en el sistema'])->withInput();
        }

        //verificacion si la contraseñas coinciden
        if (!password_verify($inputPassword, $user->password_user)) {
            return redirect()->back()->with('msg', ['body' => 'Contraseña incorrecta'])->withInput();
        }

        //verificacion si esta activo
        if (!$user->active_user) {
            return redirect()->back()->with('msg', ['body' => 'El usuario no esta activo'])->withInput();
        }

        //verificacion si tiene permisos para iniciar sesion
        if (!$this->mdlPermission->hasPermission(1, $user->id_user)) {
            return redirect()->back()->with('msg', ['body' => 'No tienes permiso para iniciar sesion'])->withInput();
        }
        session()->set([
            'cedula_user' => $user->id_user,
            'name_user' => $user->name_user,
            'image_user' => $user->photo_user,
            'is_logged' => true,
        ]);
        return redirect()->route('admin_page_home');
    }
   
    public function logout()
    {
        session()->destroy();
        return redirect()->route('login_admin');
    } 
}
