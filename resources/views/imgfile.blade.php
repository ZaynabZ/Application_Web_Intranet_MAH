<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>

    <style>
.fit {
    width:100rem;
    height:100rem;
    max-width: 100%;
    max-height: 100%;
    bottom: 0;
    left: 0;
    margin: auto;
    overflow: auto;
    position: fixed;
    right: 0;
    top: 0;
    -o-object-fit: contain;
    object-fit: contain;
}
    </style>
</head>
<body>


<div id="container" >
    <img class='fit' src="{{asset('uploads/')}}/{{$namefile}}" alt='doc'/>

</div>

</body>
</html>