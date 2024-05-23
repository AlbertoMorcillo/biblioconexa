@component('mail::message')
# {{ __('¡Hola, :name!', ['name' => $user->name]) }}

{{ __('Estás recibiendo este correo porque recibimos una solicitud de restablecimiento de contraseña para tu cuenta.') }}

@component('mail::button', ['url' => $url])
{{ __('Restablecer Contraseña') }}
@endcomponent

{{ __('Este enlace de restablecimiento de contraseña caducará en :count minutos.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]) }}

{{ __('Si no solicitaste un restablecimiento de contraseña, no se requiere ninguna acción adicional.') }}

{{ __('Saludos,') }}<br>
{{ config('app.name') }}
@endcomponent
