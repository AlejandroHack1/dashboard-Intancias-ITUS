<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ITUS API</title>

   <!-- Librer?a jQuery requerida por los plugins de JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="js/funtions.js"></script>

    <script src="https://code.iconify.design/1/1.0.6/iconify.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>

</head>
<body>


<div class="row">

@foreach($data["listaInstancias"]["instanceList"]['items'] as $value)


            


@endforeach


<!--•	Si la cantidad de instancias en estado “Active” es mayor que cinco (5), se debe mostrar en rojo y se debe presentar el led rojo en el lado izquierdo y el link de “Ver” del lado derecho-->
<div class="col-md-2">

            <span id="sDataColor" class="iconify" data-icon="bi:circle-fill" data-inline="false"
                  style="color: {{$data['instancias']['colorActive']}}; margin: 45px auto auto 433px; "></span>

        </div>


        <div class="col-md-2">
            <span id="sDataColor" class="iconify" data-icon="bi:circle-fill" data-inline="false"
                  style="color: {{$data['instancias']['color']}}; margin: 190px auto auto 200px; "></span>
        </div>




      <div  class="col-md-3">
            <div class="table-responsive">
            <span>Instancias</span>
                <table class="table table-bordered table-condensed">
                    <thead>
                    <tr>
                    <th>Active</th>

                    <td><div style="color: {{$data['instancias']['colorActive']}};">{{$data["instancias"]["active"]}}</div></td>
                    </tr>

                    <tr>
                    <th>Completed</th>
                    <td><div>{{$data["instancias"]["completed"]}}</div></td>

                    </tr>

                    <tr>
                    <th>Terminated</th>
                    <td><div>{{$data["instancias"]["terminated"]}}</div></td>

                    </tr>


                    <tr>
                    <th>
                    Failed</th>
                    <td><div style="color: {{$data['instancias']['color']}};">{{$data["instancias"]["failed"]}}</div></td>

                    </tr>

                    <tr>
                    <th>Suspended</th>
                    <td><div>{{$data["instancias"]["suspended"]}}</div></td>

                    </tr>

                    </thead>


                </table>
            </div>
        </div>



        <div class="col-md-2"  style="margin: 45px 348px auto auto;">
            <a href="https://www.w3schools.com">Ver</a>
        </div>

        <div class="col-md-2" style="margin: -100px 348px auto auto;">
            <a href="https://www.w3schools.com">Ver</a>
        </div>




      


</div>
</div>




<style>





    .show {
        display: block !important;
    }

    .hide {
        display: none !important;
    }
</style>

</body>
</html>
