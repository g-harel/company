<!DOCTYPE html>
<html>

<head>
    <title>Company, Main project</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css?<?php echo rand(); ?>">
</head>

<body>
    <style>
        header {
            background-color: #212529;
            text-align: center;
            border-bottom: 6px solid #3c4f79;
        }

        .nav {
            display: inline-block;
        }

        .nav a {
            transition: .1s background-color;
            text-decoration: none;
            display: inline-block;
            margin-right: -5px;
            text-align: center;
            line-height: 50px;
            outline: none;
            height: 50px;
            width: 140px;
            color: #fff;
        }

        .nav a:hover,
        .nav a.selected {
            background-color: #3c4f79;
        }
    </style>

    <header>
        <div class="nav">
            <a href="index.php" class="selected">Home</a>
            <a href="employees.php">Employees</a>
            <a href="departments.php">Departments</a>
            <a href="projects.php">Projects</a>
        </div>
    </header>

    <script>
        function filename(str) {
            var match = (/(?:[^]*\/)?(\S+\.\S+)/g).exec(str);
            if (match != null) {
                return match[1];
            }
            return Math.random();
        }

        var current = filename(window.location.pathname);

        $('header .nav a').each(function() {
            if (current === filename(this.href)) {
                $(this).addClass('selected');
            } else {
                $(this).removeClass('selected');
            }
        });
    </script>
