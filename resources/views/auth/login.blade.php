<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
    footer {
        text-align: center;
        padding: 3px;
        background-color: hsla(89, 43%, 51%, 0.3);
        ;
        color: white;
    }
    </style>
</head>

<body style="background-color:bg-info; background-image: url('{{ asset('image/NAA.jpg')}}'); background-size:cover;;">
    <!-- ------------------------------------ -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container" style="font-family:'Khmer OS Battambang';">
                    <div class="text-center">
                        <img class="mt-5" src="{{ asset('/image/naalogo.png') }}" alt="description of myimage"
                            width="150" , height="180">
                        <div>
                            <h3 style=' font-family: Khmer OS Muol Light; font-size:24px;color:white;'>
                                អាជ្ងាធរសវនកម្មជាតិ
                            </h3>
                            <h4 style='font-size:20px;color:white;'>
                                <b>ប្រព័ន្ធគ្រប់គ្រងការងារសវនកម្ម</b>
                            </h4>
                        </div>
                    </div>
                    <div class=" row justify-content-center">
                        <div class="col-md-12">
                            <div class="card" style="background-color:hsla(89, 43%, 51%, 0.3);">
                                <div class="card-header text-center" style="color:white;">
                                    {{ __('ចូលប្រើប្រាស់ប្រព័ន្ធ') }}
                                </div>
                                @if(session('failed'))
                                <p class="bg-danger text-white p-3 mb-3">{!! session('error') !!}</p>
                                @endif
                                <div class="card-body" style="color:white;">
                                    <form method="POST" action="{{ route('dologin') }}">
                                        @csrf

                                        <div class="row mb-3">
                                            <label for="email"
                                                class="col-md-4 col-form-label text-md-end">{{ __('ឈ្មោះគណនី') }}</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" required
                                                    autocomplete="email" autofocus>

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="password"
                                                class="col-md-4 col-form-label text-md-end">{{ __('លេខកូដសម្ងាត់') }}</label>

                                            <div class="col-md-6">
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" value="{{ old('password') }}" required
                                                    autocomplete="current-password">

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- <div class="row mb-3">
                                            <div class="col-md-6 offset-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember"
                                                        id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                    <label class="form-check-label" for="remember">
                                                        {{ __('Remember Me') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div> -->

                                        <div class="row mb-0">
                                            <div class="col-md-0 offset-md-6">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('ចូលប្រើប្រាស់') }}
                                                </button>
                                                <!-- 
                                                @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                                @endif -->
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <!-- SweetAlert2 -->
    <script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

    <!-- Toastr -->
    <script src="{{asset('assets/plugins/toastr/toastr.min.js')}}"></script>

    <!-- Select2 -->
    <script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>

</body>

</html>