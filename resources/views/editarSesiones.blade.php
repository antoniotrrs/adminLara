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
              width: 300px;
              border: 1px solid #cacaca;
              margin: 5px 0px;
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
              display: inline-block;
              border: 1px solid white;
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
            .grayButton {
              width: 80px;
              height: 35px;
              color: white;
              background: #808080;
              border: none;
              font-size: 13px;
            }
            .menuLeft a,.menuLeft a:hover, .menuLeft a:focus, .menuLeft a:active {
                color: white;
                text-decoration: none;
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
                  <li><a href="{{url('/biblioteca')}}">Biblioteca</a></li>
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
                <div class="subtitle">Editar Sesion</div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-12">
                <form action="{{url('/api/updatesesion')}}" method="post">
                  <input type="text" name="id" value="{{$result[0]->id}}" style="display: none;">
                <table border="1">
                  <tr>
                    <th>Mes</th><td><input type="text" name="mes" value="{{$result[0]->mes}}" autocomplete="off"></td>
                  </tr>
                  <tr>
                    <th>Titulo</th><td><textarea name="titulo" rows="4" cols="20" >{{$result[0]->titulo}}</textarea> </td>
                  </tr>
                  <tr>
                    <th>Ponente</th><td><textarea name="ponente" rows="4" cols="20" >{{$result[0]->ponente}}</textarea></td>
                  </tr>
                  <tr>
                    <th>Video</th><td><input type="text" name="video" value="{{$result[0]->video}}" autocomplete="off"></td>
                  </tr>
                  <tr>
                    <th>PDF</th><td><input type="text" name="pdf" value="{{$result[0]->pdf}}" autocomplete="off"></td>
                  </tr>
                  <tr>
                    <td colspan="2" style="text-align: right; padding: 10px 0px 10px 0px;"><input type="button" name="" value="Cancelar" class="grayButton" onclick="window.location='{{ url('/sesiones')}}'">
                    <input type="submit" name="" value="Editar" class="greenButton"></td>

                  </tr>
                </table>
                </form>
              </div>
            </div>


      </div>



    </body>
</html>
