<!doctype html>
<head>
    <meta charset="utf-8">
    <title>
        @yield('title')
    </title>
    <link rel="stylesheet" href="{{asset("bower_components/AdminLTE/bootstrap/css/bootstrap.min.css")}}">
    <script src="{{asset("bower_components/AdminLTE/bootstrap/js/bootstrap.min.js")}}" type="text/javascript"></script>
</head>

<body>
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <th>学籍番号</th>
                    <th>入校時間</th>
                    <th>退校時間</th>
                </tr>
                @foreach ($data as $d)
                    <tr>
                        <td></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>