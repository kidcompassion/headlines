<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="css/app.css" rel="stylesheet" type="text/css">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>

    </head>
    <body>

    <div class="container">
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="/edmonton-journal">Edmonton Journal</a> </li> 
                    <li class="nav-item"><a class="nav-link" href="/edmonton-sun">Edmonton Sun</a></li>
                    <li class="nav-item"><a class="nav-link" href="/cbc-edmonton">CBC Edmonton</a></li>
                    <li class="nav-item"><a class="nav-link" href="/ctv-edmonton">CTV Edmonton</a></li>
                    <li class="nav-item"><a class="nav-link" href="/global-edmonton">Global Edmonton</a></li>
                    <li class="nav-item"><a class="nav-link" href="/metro-edmonton">Metro Edmonton</a></li>
                    <li class="nav-item"><a class="nav-link" href="/aptn">APTN</a></li>
                    <li class="nav-item"><a class="nav-link" href="/bookmarks">Bookmarks</a></li>
                    </ul>
                </div>
            </nav>
            <div class="row p-3">
                <h1 class="col-md-8">CBC Edmonton</h1>
                <div class="col-md-2">
                    {{ Form::open() }}
                        <?php echo Form::button('<i class="fa fa-refresh"></i>  Update Stories', ['class' => 'btn btn-large btn-primary', 'type' => 'submit']);?>
                    {{ Form::close() }}
                </div>
                <div class="col-md-2">
                    <a class="btn btn-secondary" href="http://www.cbc.ca/news/canada/edmonton" target="_blank"><i class="fa fa-external-link"></i> Visit Site</a>
                </div>
            </div>
        </header>
        <div class="row">

            
           @foreach ($all_items as $item)
            <article class="story--item col-md-12"> 
                <div class="row">
                    <div class="col-md-3">
                        <img src="{{ $item->thumbnail }}"/>
                    </div>
                    <div class="col-md-9">
                        <a target="_blank" href="{{ $item->link }}"><h2>{{ $item->title }} </h2></a>
                        <p>{{$item->date}} | {{ $item->author }}</p>
                    
                        <p>{{$item->body}} </p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3 offset-md-9">
                        <a target="_blank" class="btn btn-info" href="{{ $item->link }}">Read this</a>  <a class="btn btn-warning" href="#">Copy Link</a>  <a class="btn-danger btn" href="#"><i class="fa fa-bookmark"></i></a>
                    </div>
                </div>
        </article>
        @endforeach
        </div>
    </div>






    </body>
</html>
