<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>

</head>

<body>
    @for ($i = 0; $i < 10; $i++)
        <div class="alert alert-success" role="alert">Oh snap! Change a few things up and try submitting again.</div>
        <div class="alert alert-info" role="alert">Oh snap! Change a few things up and try submitting again.</div>
        <div class="alert alert-warning" role="alert">Oh snap! Change a few things up and try submitting again.</div>
        <div class="alert alert-danger" role="alert">Oh snap! Change a few things up and try submitting again.</div>
    @endfor()
</body>
</html>
