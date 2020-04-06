<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mouvers</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    <style type="text/css" media="screen">
        img{
            margin: auto;
            display: block;
            width: 100%;
        }
        .content{
            border: 25px solid #907aa8;
            padding: 0px;
            width: 35%;
            min-width: 400px;
            margin: auto;
            background-size: 100%;
            background-position: bottom;
            background-repeat: no-repeat;
            font-family: 'Roboto', sans-serif;
        }
        .title{
            text-align: center;
            margin: 0px;
            color: #907aa8;
        }
        .content-text{
            margin-top: 20px;
            padding: 30px;
            text-align: justify;
        }
        .button-cta{
            text-decoration: none;
            margin: auto;
            display: block;
            background-color: #907aa8;
            padding: 15px;
            text-align: center;
            border-radius: 4px;
            color: #fff;
            width: 65%;
        }
    </style>
</head>
<body>
    <div class="content">
        <!--img src="https://mouvers.mx/terminos/imgs/bg.jpg" alt=""-->
        <div class="content-text">
            <!--img src="https://service24.app/assets/images/service24.png" style="text-align: center; width: 300px;"-->
            <br>
            <h2 class="title">BIENVENIDO A PATRONNA</h2>
            <br>
            <p style="color: #000">Usa el siguiente código para validar tu cuenta: </p>
            <br>

            <p style="text-align: center; font-weight: bold">{{$enlace}}</p>
        <br>
        
        <br>
        <p style="color: #000">Saludos cordiales, el equipo de Patronna</p>
        </div>
    </div>
</body>
</html>