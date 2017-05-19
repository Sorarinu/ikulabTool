<!doctype html>
<head>
    <meta charset="utf-8">
    <title>
        生野研Viewer
    </title>
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
</head>

<body>

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
        google.load("visualization", "1", {packages:["corechart"]});
        google.setOnLoadCallback(
            function() {
              var graphArray = JSON.parse('<?php echo json_encode($graphData); ?>');
              var data = google.visualization.arrayToDataTable(graphArray);

              var options = {
                  title: '生野研 総滞在時間',
                  hAxis: {title: '学籍番号'},
                  vAxis: {title: '時間'}
              };

              var chart = new google.visualization.ColumnChart(document.getElementById('gct_sample_column'));
              chart.draw(data, options);
          });
      </script>
    <div id="gct_sample_column" style="width:100%; height: 500pt" ></div>

    <div class="col-md-12">
        <form action="/ikulab/download" method="get">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="submit" name="downloadBtn" value="CSVをダウンロード">
        </form>

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
                        @if($d['out'] === '0000-00-00 00:00:00')
                            <td>データなし</td>
                        @else
                            <td>{{$d['out']}}</td>
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>
