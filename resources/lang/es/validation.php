<?php

return [
    'required' => 'El campo :attribute es obligatorio.',
    'min' => [
        'numeric' => 'El campo :attribute debe ser al menos :min.',
        'file' => 'El archivo :attribute debe pesar al menos :min kilobytes.',
        'string' => 'El campo :attribute debe contener al menos :min caracteres.',
        'array' => 'El campo :attribute debe tener al menos :min elementos.',
    ],
    'max' => [
        'numeric' => 'El campo :attribute no debe ser mayor a :max.',
        'file' => 'El archivo :attribute no debe pesar más de :max kilobytes.',
        'string' => 'El campo :attribute no debe contener más de :max caracteres.',
        'array' => 'El campo :attribute no debe tener más de :max elementos.',
    ],
    'unique' => 'El campo :attribute ya ha sido registrado.',
    'email' => 'El campo :attribute debe ser una dirección de correo válida.',
    'confirmed' => 'El campo :attribute no coincide.',
    'password' => 'La contraseña es incorrecta.',
    'password_confirmation' => 'La confirmación de la contraseña es incorrecta.',
    'dni' => 'El campo :attribute no es válido.',
    'regex' => 'El campo :attribute no es válido.',
    'attributes' => [
        'dni' => 'DNI',
        'name' => 'nombre',
        'email' => 'correo electrónico',
        'password' => 'contraseña',
        'password_confirmation' => 'confirmación de la contraseña',
    ],
];