<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>STOCK</title>

        <!-- Fonts -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> -->

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
                    Stock
                </div>
            </div>
        </div>
    </body>
    <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script>
    //Redirect      
    debugger;
    getAll();

    function getAll(){
        debugger;
        $.ajax({
            type: 'GET',
            url:{!!json_encode(url('/'))!!}+"/api/RedirectToServer",
            success: function(result) {
                sessionStorage.setItem('ruta_inicial', result[0].ruta_inicial);
                sessionStorage.setItem('servidor_logueo',result[0].servidor_logueo+'?ruta=stock');

                var ruta_inicial = sessionStorage.getItem('ruta_inicial');
                var servidor_logueo = sessionStorage.getItem('servidor_logueo');
                var token = localStorage.getItem('token');
                if(token!=undefined && ruta_inicial!=undefined) {
                    window.location.href = ruta_inicial+'home?token=' + token;
                }
                if(localStorage.getItem('token')==undefined) {
                    window.location.href = servidor_logueo;
                }
            },
            error: function(e) {
                console.log("error");
            }
        });
    }   
    </script>
</html>