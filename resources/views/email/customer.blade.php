<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style>
        html,
        body {
            padding: 0;
            margin: 0;
        }

        .full-height {
            height: 100vh;
            background-color: #f0f0f0;
        }

        .center {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            padding: 10px;
            background-color: white;
        }
    </style>

    <title>Laravel Email to Customer</title>
</head>

<body>
    <div class="full-height">
        <div class="center">
            <p style="padding: 0; margin: 0;">Kepada Yth,</p>
            <p style="padding: 0; margin: 0;">Pelanggan A.n <b>{{ $CustNamePIC }}</b></p>
            <p>
                Terima kasih anda telah berhasil registrasi. Data anda telah kami terima dan akan diproses dalam kurun
                waktu 1 x 24 jam. Silahkan hubungi Account Manager
                @if (isset($SalesNamePIC))
                    <b>{{ $SalesNamePIC }}</b>
                @else
                    anda
                @endif
                untuk info lebih lanjut.
            </p>
            <p>Regards,</p>
            <p>Nusanet</p>
        </div>
    </div>
</body>

</html>
