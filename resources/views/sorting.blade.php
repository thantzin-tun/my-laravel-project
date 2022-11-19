<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="{{ asset('/admin/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">
</head>
<body>
    <div class="container">
      <div class="row">
          <div class="col-md-3 mt-3">
              <select name="" id="selectOperations" class="form-control bg-dark text-light">
                  <option value="">Choose</option>
                  <option value="asc">Ascending</option>
                  <option value="desc">Descending</option>
              </select>
          </div>
      </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function(){
           
          $('#selectOperations').change(function(){
              $.ajax({
                type:"get",
                url:`http://localhost:8000/ajax/pizzaList/${$(this).val()}` ,
                dataType:'json',
                success: function(response){
                    console.log(response);
                }
              })
          })
        })
    </script>
    
</body>
</html>