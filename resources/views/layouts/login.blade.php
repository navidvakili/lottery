<!doctype html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ env('APP_NAME') }}</title>
    <link href="/assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="/assets/vendor/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="/assets/vendor/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/master.css" rel="stylesheet">
    <style>
        #radius-shape-1 {
            height: 220px;
            width: 220px;
            top: -60px;
            left: -130px;
            background: radial-gradient(#44006b, #ad1fff);
            overflow: hidden;
        }

        #radius-shape-2 {
            border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
            bottom: -60px;
            right: -110px;
            width: 300px;
            height: 300px;
            background: radial-gradient(#44006b, #ad1fff);
            overflow: hidden;
        }

        .bg-glass {
            background-color: hsla(0, 0%, 100%, 0.9) !important;
            backdrop-filter: saturate(200%) blur(25px);
        }

        input {
            text-align: left;
        }
    </style>
</head>

<body class="background-radial-gradient overflow-hidden">
    <div class="wrapper">
        <div id="body" class="active">
            <!-- Section: Design Block -->
            <section>
                <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
                    <div class="row gx-lg-5 align-items-center mb-5">

                        <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10; direction: rtl; text-align: right;">
                            <div style="text-align: center"><img src="/assets/img/logo_maskan1.png" alt="اداره راه و شهرسازی یزد"><br>&nbsp;</div>
                            <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                                سامانه قرعه کشی <br />
                                <span style="color: hsl(218, 81%, 75%)">اداره راه و شهرسازی استان یزد</span>
                            </h1>
                            <p class="mb-4 opacity-0" style="color: hsl(218, 81%, 85%)">
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                Temporibus, expedita iusto veniam atque, magni tempora mollitia
                                dolorum consequatur nulla, neque debitis eos reprehenderit quasi
                                ab ipsum nisi dolorem modi. Quos?
                            </p>
                        </div>

                        <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                            <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                            <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

                            <div class="card bg-glass">
                                <div class="card-body px-4 py-5 px-md-5">
                                    <h4 class="my-5 display-7 fw-bold ls-tight" style="text-align: center;">ورود به سامانه قرعه کشی </h4>
                                    <form>
                                        <!-- Username input -->
                                        <div class="form-outline mb-4">
                                            <input type="text" id="username" class="form-control" autocomplete="off" />
                                            <label class="form-label" for="form3Example3">نام کاربری</label>
                                        </div>

                                        <!-- Password input -->
                                        <div class="form-outline mb-4">
                                            <input type="password" id="form3Example4" class="form-control" />
                                            <label class="form-label" for="form3Example4">گذرواژه</label>
                                        </div>

                                        <!-- Submit button -->
                                        <button type="submit" class="btn btn-primary btn-block mb-4">
                                            ورود به سامانه
                                        </button>

                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <!-- Section: Design Block -->
        </div>
    </div>
    <script src="/assets/vendor/jquery/jquery.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/script.js"></script>
</body>

</html>