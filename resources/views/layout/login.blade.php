<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link rel="icon" type="../../image/png" href="../../logo/i.png">
    <title>Gestion de parc</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <main>
        <div class="container">

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-sm-5 d-flex flex-column align-items-center justify-content-center">
                            <div class="text-center"><img src="{{ asset('logo/i.png') }}" style="width: 170px;"
                                    alt="_logo"></div>
                            <div class="card mb-3">

                                <div class="card-body">
                                    @if (session('status'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <span class="font-medium">{{ session('msg') }}</span>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <div class="">
                                        <h5 class="card-title p-0 m-0 text-center fs-4">Connexion</h5>
                                        <p class="text-center">Bienvenue sur G-Parc </p>
                                    </div>
                                    <hr>
                                    @if (\Session::has('message'))
                                        <div class="alert alert-info">{{ \Session::get('message') }}</div>
                                    @endif
                                    <form class="row g-3 needs-validation" action="{{ url('loginusers') }}"
                                        method="post">
                                        @csrf
                                        <div class="col-12">
                                            <label for="email" class="form-label">Entrer votre mail</label>
                                            <input type="email" class="form-control" name="email" id="email" required>
                                        </div>

                                        <div class="col-12">
                                            <label for="password" class="form-label">Entrer votre mot de passe</label>
                                            <input type="password" class="form-control" name="password" id="password"
                                                required>
                                        </div>

                                        <div class="col-12 text-end">
                                            <button class="btn btn-primary" type="submit">Se connecter</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main>
    <script src="../../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/vendor/chart.js/chart.min.js"></script>
    <script src="../../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../../assets/vendor/quill/quill.min.js"></script>
    <script src="../../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../../assets/vendor/php-email-form/validate.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <!-- Template Main JS File -->
    <script src="../../assets/js/main.js"></script>
</body>

</html>
