<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" ></script>
    <style type="text/css">
        body{
            margin-top: 150px;
         /*   background-color: #C4CCD9;*/
           /* background-image: url('https://i.etsystatic.com/5346760/r/il/8d7ccb/909769589/il_794xN.909769589_d2ac.jpg');*/
          /*  background-color: white;*/
             background-color: black;
            
        }
        .error-main{
          background-color: #fff;
          box-shadow: 0px 10px 10px -10px #5D6572;
          border-top: 1px solid #adafad94;
          border-left: 1px solid #adafad94;
          border-right: 1px solid #adafad94;
        }
        .error-main h1{
          font-weight: bold;
          color: #444444;
          font-size: 100px;
          text-shadow: 2px 4px 5px #6E6E6E;
        }
        .error-main h6{
          color: #42494F;
        }
        .error-main p{
          color: #9897A0;
          font-size: 14px; 
        }
    </style>
    </head>
   <body>
    <div class="container">
      <div class="row text-center">
         @yield('error-message')
      </div>
    </div>
</body>
</html>
