<x-mail::message>

# New Appointment Notification

You have a new appointment with **{{ $appointmentData['patient_name'] }}** on **{{ $appointmentData['appointment_date'] }}** at **{{ $appointmentData['appointment_time'] }}**.

<x-mail::button :url="'#'">
View Appointment Details
</x-mail::button>

Thank you,<br>
{{ config('app.name') }}

</x-mail::message>