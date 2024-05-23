<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name') }}</title>
</head>
<body>
    <h1>{{ __('¡Hola, :name!', ['name' => $user->name]) }}</h1>

    <p>{{ __('Estás recibiendo este correo porque recibimos una solicitud de restablecimiento de contraseña para tu cuenta.') }}</p>

    <a href="{{ $url }}" style="display: inline-block; padding: 10px 20px; color: white; background-color: #1a73e8; text-decoration: none; border-radius: 5px;">{{ __('Restablecer Contraseña') }}</a>

    <p>{{ __('Este enlace de restablecimiento de contraseña caducará en :count minutos.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]) }}</p>

    <p>{{ __('Si no solicitaste un restablecimiento de contraseña, no se requiere ninguna acción adicional.') }}</p>

    <p>{{ __('Saludos,') }}<br>{{ config('app.name') }}</p>
</body>
</html>
