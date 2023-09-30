<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Verifikasi Email</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Verifikasi Email</div>
                    <div class="card-body">
                        <p>Silakan klik tombol di bawah untuk memverifikasi alamat email Anda.</p>
                        <a href="{{ $verificationUrl }}" class="btn btn-primary">Verifikasi Alamat Email</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
