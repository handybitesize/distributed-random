<?php

require_once __DIR__.'/../src/GenerateRandom.php';

$min = isset($_POST['min']) ? intval($_POST['min']) : 0;
$max = isset($_POST['max']) ? intval($_POST['max']) : 1;
$mean = isset($_POST['mean']) ? floatval($_POST['mean']) : 0.5;
$round = isset($_POST['round']) ? floatval($_POST['round']) : null;
$size = isset($_POST['size']) ? intval($_POST['size']) : 1000;

$seed = isset($_POST['seed']) ? intval($_POST['seed']) : null;

$rand = new \HandyBiteSize\DistributedRandom\GenerateRandom($seed);
$res = $rand->randomArray($size, $min, $max, $mean, $round);

$values = array(array('Plot'));
foreach($res as $v) {
    $values[] = array($v);
}

$json = json_encode($values);

?>


<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script>
        google.charts.load("current", {packages: ["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable(<?php echo $json ?>);
            $(this).addClass("done");
            var options = {
                legend: {position: 'none'},
                hAxis: { textPosition: 'none' },
                colors: ['#ff9800', '#ff9800']
            };

            var chart = new google.visualization.Histogram(document.getElementById('chart_div'));
            chart.draw(data, options);
        }

        $(document).ready(function() {
            $('select').formSelect();
        });
    </script>
</head>
<body>
<div class="container">
    <br><br>
    <h1 class="header center orange-text">Distributed Random</h1>
    <div class="row center">
        <h5 class="header col s12 light">Generate random numbers from a range with a normal distribution. Allows skewing and rounding.</h5>
    </div>
    <form method="post">
        <div class="row">
            <div class="input-field col s12">
                <input id="seed" name="seed" type="number" value="<?php echo $rand->seed; ?>">
                <label for="seed" class="active">Random Seed (blank for new)</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s2">
                <input placeholder="10" id="min" name="min" type="number" value="<?php echo $min; ?>">
                <label for="min" class="active">Min Value</label>
            </div>
            <div class="input-field col s2">
                <input placeholder="100" id="max" name="max" type="number" value="<?php echo $max; ?>">
                <label for="max" class="active">Max Value</label>
            </div>
            <div class="input-field col s2">
                <input placeholder="50" id="mean" name="mean" type="number" value="<?php echo $mean; ?>">
                <label for="mean" class="active">Weight Mean</label>
            </div>
            <div class="input-field col s2">
                <div class="select-wrapper">
                    <select id="round" name="round" tabindex="-1">
                        <option value="" <?php if($round==null)echo 'selected'?>>Don't round</option>
                        <option value="0.2" <?php if($round==0.2)echo 'selected'?>>0.2</option>
                        <option value="0.5" <?php if($round==0.5)echo 'selected'?>>0.5</option>
                        <option value="1" <?php if($round==1)echo 'selected'?>="">1</option>
                        <option value="2" <?php if($round==2)echo 'selected'?>>2</option>
                        <option value="3" <?php if($round==3)echo 'selected'?>>3</option>
                        <option value="5" <?php if($round==5)echo 'selected'?>>5</option>
                        <option value="10" <?php if($round==10)echo 'selected'?>>10</option>
                        <option value="100" <?php if($round==100)echo 'selected'?>>100</option>
                        <option value="1000" <?php if($round==1000)echo 'selected'?>>1000</option>

                    </select></div>
                <label>Round to:</label>
            </div>
            <div class="input-field col s2">
                <div class="select-wrapper">
                    <select id="size" name="size" tabindex="-1">
                        <option value="10" <?php if($size==10)echo 'selected'?>>10</option>
                        <option value="100" <?php if($size==100)echo 'selected'?>>100</option>
                        <option value="1000" <?php if($size==1000)echo 'selected'?>>1000</option>
                        <option value="2000" <?php if($size==2000)echo 'selected'?>>2000</option>
                        <option value="5000" <?php if($size==5000)echo 'selected'?>="">5000</option>
                        <option value="10000" <?php if($size==10000)echo 'selected'?>>10000</option>
                        <option value="20000" <?php if($size==20000)echo 'selected'?>>20000</option>
                    </select></div>
                <label>Sample size</label>
            </div>

            <div class="col s2">
                <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </div>
    </form>
    <div class="container">

        <div class="row">
            <div class="col s2">
                <h4>Data</h4>
                <div class="valign-wrapper center-align" id="data_div" style=" width:100%; height: 400px; overflow: auto;">
                    <?php
                    foreach($res as $val) {
                        echo $val . '<br/>';
                    }
                    ?>
                </div>
            </div>
            <div class="col s10">
                <h4>Distribution</h4>
                <div class="valign-wrapper center-align" id="chart_div" style="width:100%; height: 500px; "></div><
            </div>
        </div>
    </div>


</body>
</html>


