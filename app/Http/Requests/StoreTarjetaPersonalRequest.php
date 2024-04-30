<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTarjetaPersonalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Cambiar a true para permitir el acceso, o agregar lógica de autorización
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'correo_electronico' => 'required|email|max:255|unique:tarjeta_personal,correo_electronico',
            'telefono' => 'required|string|max:15',
            'genero' => 'required|in:Hombre,Mujer,No binario,Privado',
            'fecha_nacimiento' => 'required|date',
        ];
    }
}
