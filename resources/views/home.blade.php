<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>UNBAJA Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .bg-unbaja {
            background-color: #6777ef;
        }

        .btn-unbaja {
            background-color: #6777ef;
            color: white;
            font-weight: 600;
        }

        .btn-unbaja:hover {
            background-color: #6777ef;
            color: white;
        }

        main {
            flex: 1;
        }
    </style>
</head>

<body class="bg-white">

    <!-- Header -->
    <div class="w-100 bg-unbaja d-flex px-3 py-3 ">
        <img src="{{ asset('assets/img/logo-unbaja.png') }}" alt="UNBAJA logo" width="80" height="80"
            class="object-fit-contain container">
    </div>

    <!-- Main Content -->
    <main class="container py-5">
        <div class="row align-items-center justify-content-center gx-5">
            <div class="col-md-5 text-center mb-4 mb-md-0">
                <img src="https://storage.googleapis.com/a1aa/image/118abe40-2a5b-4212-f16d-a24be0abe2ab.jpg"
                    alt="Illustration" class="img-fluid" style="max-width: 320px;">
            </div>
            <div class="col-md-6  text-md-start">
                <h3 class="fw-semibold text-black mb-4 text-center">
                    SELAMAT DATANG
                    DI PEMINJAMAN BARANG DAN TEMPAT
                    UNIVERSITAS BANTEN JAYA
                </h3>
                <div class="d-flex justify-content-center  gap-3">
                    <a href="{{ route('login') }}"><button
                            class="btn btn-unbaja rounded-pill px-4 py-2">Login</button></a>
                    <a href="{{ route('register') }}"><button
                            class="btn btn-unbaja rounded-pill px-4 py-2">Register</button></a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer (Sticky at bottom) -->
    <div class="w-100 bg-unbaja" style="height: 48px;"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
