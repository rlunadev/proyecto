<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Inventario</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    TOKEN SERVICE
                </div>
            </div>
        </div>
    </body>
    <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script>
    //Redirect 
    getAll();
    function getAll(){
        $.ajax({
            type: 'GET',
            url:{!!json_encode(url('/'))!!}+"/api/RedirectToServer",
            success: function(result) {
                debugger;
                sessionStorage.setItem('servidor_logueo',result[0].servidor_logueo);
                sessionStorage.setItem('ruta_inicial',result[0].ruta_inicial);
                if(localStorage.getItem('token')!=undefined && sessionStorage.getItem('ruta_inicial')!=undefined)
                window.location.href =  sessionStorage.getItem('ruta_inicial')+'?token='+localStorage.getItem('token');
                if(sessionStorage.getItem('token')==undefined)
                window.location.href =  sessionStorage.getItem('servidor_logueo');
            },
            error: function(e) {}
        });
    }
    </script>
</html>
