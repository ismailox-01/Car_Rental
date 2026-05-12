<x-mail::message>
# New Contact Inquiry

You have received a new message from the contact form.

**From:** {{ $name }} ({{ $email }})  
**Inquiry Type:** {{ $inquiry_type ?? 'General Inquiry' }}

<x-mail::panel>
{{ $message }}
</x-mail::panel>

<x-mail::button :url="route('admin.contacts.index')">
View in Dashboard
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
