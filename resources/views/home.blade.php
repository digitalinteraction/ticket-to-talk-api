<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=PT+Mono" rel="stylesheet">
    <!--Import materialize.css-->
    {!! Html::style('css/materialize.css', ['media' => 'screen,projection']) !!}
    {!! Html::style('css/style.css') !!}

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <meta title="Ticket to Talk"/>
    <meta author="Daniel Welsh"/>
    <meta charset="UTF-8">
    <meta name="description" content="Ticket to Talk: an application helping to scaffold interactions between younger people and older relatives with dementia.">
</head>

<body>

    <div id="title-block" class="row">


        <h1 id="title" class="center-align">
            ticket-to-talk
        </h1>

        <div class="container">
            <div id="title-description" class="card-panel center-align">
                <p>
                    An application helping to support conversation between younger people and older relatives with dementia.
                    <br/>
                    Use Ticket to Talk to create talking points with older relatives through crafting a collection of pictures, sounds, and YouTube videos.
                </p>
            </div>
        </div>

    </div>

    <div id="work-flow" class="row">

        <div class="container">
            <div class="card-panel">
                
            </div>
        </div>

    </div>

<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
{!! Html::script('js/materialize.js') !!}
{!! Html::script('js/script.js') !!}
</body>
</html>