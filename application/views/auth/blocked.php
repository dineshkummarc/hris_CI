<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>404</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,700" rel="stylesheet">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/') ?>css/style-block.css" />
    <link rel="stylesheet" href="<?= base_url('assets/font-awesome') ?>/css/font-awesome.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
    <style>
        .btn {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
                border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .btn-danger {
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-outline-primary {
            color: #dc3545;
            background-color: transparent;
            background-image: none;
            border-color: #dc3545;
        }
    </style>
</head>

<body>

    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404">
                <h1>4<span>0</span>4</h1>
            </div>
            <p>The page you are looking for was not found, or you do not have access to that page</p>
            <button class="btn btn-danger btn-outline-primary btn-lg balik"><i class="fa fa-arrow-left"></i> Back</button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".balik").click(function() {
                window.history.back();
            })
        })
    </script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>