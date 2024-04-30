<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTarjetaPersonalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Cambiar a true para permitir el acceso, o añadir lógica para verificar si el usuario puede actualizar este recurso
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
            // La regla unique se ignora si el correo electrónico no ha cambiado
            'correo_electronico' => [
                'required',
                'email',
                'max:255',
                Rule::unique('tarjeta_personal')->ignore($this->tarjeta_personal)
            ],
            'telefono' => 'required|string|max:15',
            'genero' => 'required|in:Hombre,Mujer,No binario,Privado',
            'fecha_nacimiento' => 'required|date',
        ];
    }
}
