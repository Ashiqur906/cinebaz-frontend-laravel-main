<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Welcome to Cinebaz</title>
  </head>
  <body style="background: black;" id="animation">
    <div class="container" id="image">
      <div class="row">
        <div class="col-6 offset-3">
        <br>
        <br>
        <br>
        <br>
        <br>
          <img src="https://mgr2.cinebaz.com/assets/frontend/images/logo.png" class="img-fluid pt-6">
        </div>
            <div id="welcome" style="display:none">
            <img src="https://media3.giphy.com/media/26tOZ42Mg6pbTUPHW/giphy.gif" style="width:100%">
            </div>
            <div id ="show">
        <div class="col-12 text-center text-light mt-5">
            <h1>Waiting to launch</h1>
        </div>
        <div class="col-6 offset-3 mt-5">
          <form action="{{route('frontend.welcome')}}" method="get" id="formID">  

          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Launch Code" aria-label="Launch Code" aria-describedby="button-addon2" name="launch" id="launch">
            <button class="btn btn-outline-light" type="submit" id="button-addon2">Submit Launch Code</button>
          </div>
          </form>
        </div>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

    <script>
    // Form #2 Example
        window.onload = function() {




        document.getElementById("formID").onsubmit = function() {
            var form = this;


            var launch = document.getElementById("launch").value;
            
            if(launch == 'mujib100'){

                document.getElementById("show").style.display = "none";
            document.getElementById("welcome").style.display = "block";
            }
        

            setTimeout(function() {
                var targetDiv = document.getElementById("image");
                targetDiv.style.display = "none";
                form.submit();
            }, 3000); // 3 seconds
            return false;
        };

        };
    </script>
  </body>
</html>
