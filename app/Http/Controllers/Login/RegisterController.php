<?php
namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    // Muestra el formulario de registro
    public function showRegistrationForm()
    {
        return view('login.register');  
    }

    // Maneja el registro de usuario
    public function register(Request $request)
    {
        // Validación de los datos de entrada
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8', 
        ]);

        // Si la validación falla, redirige de vuelta con los errores
        if ($validator->fails()) {
            return redirect()->route('register')->withErrors($validator)->withInput();
        }

        // Crear el usuario en la base de datos
        $user = User::create([
            'nombre' => $request->name,
            'email' => $request->email,
            'contraseña' => Hash::make($request->password), 
        ]);

        // Autenticamos al usuario después de registrarlo
        auth()->login($user);

        // Redirigir a una página de éxito(aun por crear)
        return redirect()->route('login'); 
    }
}

