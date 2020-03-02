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

        <!-- Styles -->
        <style>

.inputLogin {
  height: 30px;
    width: 200px;
    border: 1px solid #cecece;
    border-radius: 5px;
    font-size: 12px;
    padding-left: 5px;
}

.btnLogin {
  margin-top: 10px;
    border: 1px solid white;
    background-color: #158437;
    width: 70px;
    color: white;
    height: 25px;
    border-radius: 5px;
    font-size: 12px;
}

label{
  font-size: 12px;
}

.centerRow {
  top: 50%;
    margin-top: -150px;
    position: absolute;
    left: 50%;
    margin-left: -100px;
}

.imgLogo {
  width: 80px;
  margin-bottom: 30px;
}
        </style>
    </head>
    <body>


<div class="container text-center">
      <div class="row centerRow">
        <form action="{{url('/login')}}" method="post">
          @csrf <!-- {{ csrf_field() }} -->
        <img src="{{ url('/public/images/colegioTrans.png') }}" class="imgLogo"><br>
        <label>Usuario:</label><br>
        <input type="text"  name="usuario" value="" class="inputLogin"><br>
        <label>Contraseña</label><br>
        <input type="password"  name="pass" value="" class="inputLogin"><br>
        <input type="submit" value="Entrar" class="btnLogin">
      </form>
      </div>

</div>

    </body>
</html>
