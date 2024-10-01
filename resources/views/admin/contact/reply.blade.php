<!DOCTYPE html>
<html>
<head>
    <title>Balasan Pesan Anda</title>
</head>
<body>
    <h1>Halo, {{ $contact->name }}</h1>
    <p>Terima kasih atas pesan Anda. Berikut adalah balasan dari kami:</p>
    <p>{{ $replyMessage }}</p>
    <p>Salam,</p>
    <p>{{ config('mail.from.name') }}</p>
</body>
</html>
