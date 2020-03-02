<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            input, textarea {
              font-size: 13px;
            }


            .menuLeft{

              color: white;
              font-weight: bold;

            }

            .menuLeft ul{
              margin: 0px;
            }
            .menuLeft ul li{
              margin-top: 40px;
              list-style: none;
              cursor: pointer;
            }

            .RightSpace {

              box-sizing: border-box;
            }


            textarea {
              resize: none;
            }

            .tituloSecc {
              font-weight: bold;
              color: #2a5263;
              font-size: 30px;
              border-bottom: 1px solid #2a5263;
            }

            .subtitle {
              font-weight: bold;
              font-size: 15px;
              margin-bottom: 10px;
            }

            table {
              border-collapse: collapse;
            }
            table th, .resultados td {
              padding: 0px 10px;
              width: 150px;
            }
            .greenButton {
              width: 80px;
              height: 35px;
              color: white;
              background: #209057;
              border: none;
              font-size: 13px;
            }
            .menuLeft a,.menuLeft a:hover, .menuLeft a:focus, .menuLeft a:active {
                color: white;
                text-decoration: none;
              }
              .redButton {
                padding: 10px;
                color: white;
                background: #f14b4b;
                border: none;
                font-size: 13px;
                margin-bottom: 5px;
              }

              .yellowButton {
                padding: 10px;
                color: white;
                background: #5a5a5a;
                border: none;
                font-size: 13px;
              }

        </style>
    </head>
    <body>


      <div class="row" style="background: #9c9c9c; ">
              <div class="col-lg-2 menuLeft" >
                <ul>
                  <li><a href="{{ url('/') }}">Eventos</a></li>
                  <li><a href="{{ url('/sesiones') }}">Sesiones</a></li>
                  <li><a href="{{ url('/actividades') }}">Actividades academicas</a></li>
                  <li><a href="{{ url('/biblioteca') }}">Biblioteca</a></li>
                  <li><a href="{{ url('/home') }}">Cerrar Sesión</a></li>
                </ul>
              </div>
              <div class="col-lg-10" style="background: white;">

                <div class="row">
                  <div class="col-lg-12">
                      <label class="tituloSecc">Sesiones</label>
                  </div>
                </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="subtitle">Crear una sesión</div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-12">
                <table border="1">
                  <tr>
                    <th>Mes</th>
                    <th>Titulo</th>
                    <th>Ponente</th>
                    <th>Video</th>
                    <th>PDF</th>
                  </tr>
                  <tr>
                    <form action="{{ url('/api/sesiones') }}" method="post">
                      <td><input type="text" name="mes" value=""></td>
                      <td><textarea name="titulo" rows="4" cols="20"></textarea> </td>
                      <td><textarea name="ponente" rows="4" cols="20"></textarea></td>
                      <td><input type="text" name="video" value=""></td>
                      <td><input type="text" name="pdf" value=""></td>
                      <td><input type="submit" name="" value="Crear" class="greenButton"></td>
                    </form>
                  </tr>
                </table>
              </div>
            </div>


                <br>
                <br>
                <div class="subtitle">Sesiones actuales</div>

                <table border="1" class="resultados">
                  <tr>
                    <th>Mes</th>
                    <th>Título</th>
                    <th>Ponente</th>
                    <th style="width:100px;">Video</th>
                    <th>PDF</th>


                  </tr>
                  @foreach($sesions as $sesion)
                  <tr style="height:90px;">

                      <td>{{$sesion->mes}}</td>
                      <td>{{$sesion->titulo}}</td>
                      <td>{{$sesion->ponente}}</td>
                      <td><a href="{{$sesion->video}}" target="_blank">{{$sesion->video}}</a></td>
                      <td><a href="{{$sesion->pdf}}" target="_blank">{{$sesion->pdf}}</a></td>
                      <td > <ul style="padding: 0; text-align: center; margin: 0px;"><a href="{{ url('/api/deleteSesion/'.$sesion->id) }}"><li class="redButton">Eliminar</li></a><a href="{{ url('/editarsesion/'.$sesion->id) }}"><li class="yellowButton">Editar</li></a></ul> </td>

                  </tr>
                  @endforeach
                </table>



              </div>
      </div>



    </body>
</html>
