<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>TODO App</title>
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        <div>
            <h1 class="text-center">TO DO LIST</h1>
            <div class="new-wrapper">
                <input type="text" value="New task">
                <button class="btn btn-circle btn-info">+</button>
            </div>

            <ul class="list-group list-group-flush tasks">
                <li class="list-group-item">
                    <span>Not done task</span>
                    <a href="#" class="btn btn-done glyphicon glyphicon-unchecked"></a>
                </li>
                <li class="list-group-item done">
                    <span>Done task</span>
                    <a href="#" class="btn btn-done glyphicon glyphicon-check"></a>
                </li>
            </ul>
        </div>

        <script type="text/javascript" src="/js/app.js"></script>
    </body>
</html>
