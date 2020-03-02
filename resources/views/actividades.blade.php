<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

        <link href="{{ asset('datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet">
        <script src="{{ asset('datepicker/js/bootstrap-datepicker.js') }}"></script>
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
            .redButton {
              padding: 10px;
              color: white;
              background: #f14b4b;
              border: none;
              font-size: 13px;
            }
            .menuLeft a,.menuLeft a:hover, .menuLeft a:focus, .menuLeft a:active {
                color: white;
                text-decoration: none;
              }
              .imgPreview {
                width: 100px;
              }

        </style>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#fechainputt').datepicker({
              format: "dd-mm-yyyy",
              startDate: "today",
              maxViewMode: 0,
              language: "es",
              orientation: "bottom auto"
            });
            $('#timepickerr').datetimepicker({

              format: 'HH:mm'

          });



          });


        </script>
    </head>
    <body>

      <div class="row" style="background: #9c9c9c;">
              <div class="col-lg-2 menuLeft" >
                <ul>
                  <li><a href="{{ url('/') }}">Eventos</a></li>
                  <li><a href="{{ url('/sesiones') }}">Sesiones</a></li>
                  <li><a href="{{ url('/actividades') }}">Actividades academicas</a></li>
                  <li><a href="{{url('/biblioteca')}}">Biblioteca</a></li>
                  <li><a href="{{ url('/home') }}">Cerrar Sesión</a></li>
                </ul>
              </div>
              <div class="col-lg-10" style="background: white;">

                <div class="row">
                  <div class="col-lg-12">
                      <label class="tituloSecc">Actividades academicas</label>
                  </div>
                </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="subtitle">Crear una actividad academica</div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-12">
                <table border="1">
                  <tr>
                    <th>Titulo</th>
                    <th>Detalle</th>
                    <th>Lugar</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Imagen</th>
                  </tr>
                  <tr>
                    <form action="{{ url('/api/actividades') }}" method="post" enctype="multipart/form-data">
                      <td><input type="text" name="titulo" value=""></td>
                      <td><textarea name="detalle" rows="4" cols="20"></textarea> </td>
                      <td><textarea name="link" rows="4" cols="20"></textarea></td>
                      <td><input type="text" name="fechalimite"  id="fechainputt" autocomplete="off"></td>
                      <td><input type="text" name="hora"  id="timepickerr" ></td>
                      <td><input name="imagen" type="file" id="imagen"></td>
                      <td><input type="submit" name="" value="Crear" class="greenButton"></td>
                    </form>
                  </tr>
                </table>
              </div>
            </div>


                <br>
                <br>
                <div class="subtitle">Actividades academicas actuales</div>

                <table border="1" class="resultados">
                  <tr>
                    <th>Título</th>
                    <th>Detalle</th>
                    <th>Lugar</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Imagen</th>

                  </tr>
                  @foreach($activ as $sesion)
                  <tr style="height:70px;">

                      <td>{{$sesion->titulo}}</td>
                      <td>{{$sesion->detalle}}</td>
                      <td>{{$sesion->link}}</td>
                      <td>{{ date('d-m-Y', strtotime($sesion->fechalimite))}}</td>
                      <td>{{$sesion->hora}}</td>
                      <td style="text-align: center;"><img src="{{url('/.$sesion->imagen')}}" alt="" class="imgPreview"> </td>
                      <td style="text-align: center;"> <a href="{{ url('/api/deleactiv/$sesion->id') }}" class="redButton">Eliminar</a> </td>

                  </tr>
                  @endforeach
                </table>

              </div>
      </div>
    </body>
</html>
