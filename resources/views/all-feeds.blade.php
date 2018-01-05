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
        <div class="row">
            @foreach ($all_items as $item)
            <article class="story--item col-md-4"> 
                <a target="_blank" href="{{ $item->link }}"><h2>{{ $item->title }} </h2></a>
                <p>{{ $item->pubDate }} </p>
                <p>{{ $item->author }} </p>
                <p>{!! html_entity_decode($item->description)!!} </p>
                <p>
                @foreach ($item->category as $cat)
                    <span>{{$cat}}</span>
                @endforeach   
                </p>
            <a target="_blank" class="btn btn-primary" href="{{ $item->link }}">Read this</a>  <a class="btn btn-success" href="#">Hide this</a>  <a class="btn-danger btn" href="#"><i class="fa fa-bookmark"></i></a>
        </article>
        @endforeach
        </div>
    </div>






    </body>
</html>
