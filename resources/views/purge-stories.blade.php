<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="css/app.css" rel="stylesheet" type="text/css">

    </head>
    <body>

    <div class="container">
        <header>
            <h1>Edmonton Journal</h1>
            {{ Form::open() }}
                <?php echo Form::submit('Purge All Stories');?>
            {{ Form::close() }}

        </header>
    </div>




    </body>
</html>
