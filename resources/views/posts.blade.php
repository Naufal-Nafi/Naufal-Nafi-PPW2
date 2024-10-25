<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    @vite('resources/sass/app.scss', 'resources/js/app.js')
</head>

<body>
    <h1>Posts</h1>
    <?php                
    $message = Session::get('error')
?>
    <div class="alert alert-danger">
        {{$message}}
    </div>
</body>

</html>

