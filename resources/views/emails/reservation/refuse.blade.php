@component('mail::message')
# Réservation refusée !

Votre réservation a été refusée par le propriétaire de l'hébergement.

Voici un récapitulatif de votre réservation :

@component('mail::panel')

@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
