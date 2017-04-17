<!doctype html>
<head>
    <meta charset="utf-8">
    <title>
        生野研Viewer
    </title>
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js"></script>
</head>

<body>
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover" border="1">
                <tr>
                    <th>学籍番号</th>
                    <th>入校時間</th>
                    <th>退校時間</th>
                </tr>

                @foreach($timedata as $d)
                    <tr>
                        <td>{{$d['studentId']}}</td>
                        <td>{{$d['in']}}</td>
                        <td>{{$d['out']}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>