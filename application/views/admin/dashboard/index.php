<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="card-header">
                            <h3 class="card-title"><center>Operar</center></h3>

                            <div class="card-tools">
                            </div>
                        </div>
                        <div class="card-body"><center>
                                <a href="<?= base_url('admin/operar/operar'); ?>" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i> INICIAR <i class="fa fa-arrow-circle-left"></i></a></center>
                        </div>
                    </div>
                </div>    
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $all_admin; ?></h3>
                            <p>Operadores Cadastrados</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="<?= base_url('admin/admin'); ?>" class="small-box-footer">Listar <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                   <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $all_pontos; ?></h3>

                <p>Pontos de Venda</p>
              </div>
              <div class="icon">
                <i class="ion ion-navigate"></i>
              </div>
              <a href="<?= base_url('admin/pontos'); ?>" class="small-box-footer">Listar <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= $all_machines; ?></h3>
                            <p>Equipamentos cadastrados</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="<?= base_url('admin/machines'); ?>" class="small-box-footer">Listar <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Visão geral dos últimos 90 dias</h5>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                               
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <p class="text-center">
                                        <strong>1 Jan, 2020 - 01 Fev, 2020</strong>
                                    </p>
                                    <!-- Sales Chart Canvas -->
                                    <div class="chart">
                                        <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                                    </div>
                                </div>                             
                                <div class="col-md-4">
                                    <p class="text-center">
                                        <strong>Melhor faturamento por ponto
                                    </p>
                                    
                                    <?php foreach($all_operacoes as $operacao){
                                      
                       
                    $ponto = $this->ponto_model->get_ponto($operacao->ponto);
                
                    
                                        
                                        ?> 
                                    <!-- /.progress-group -->
                                    <div class="progress-group">
                                        <span class="progress-text">
                                           <?php echo $ponto->ponto; ?></span>
                                        <span class="float-right"><b><?php echo  $operacao->saldo; ?></span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-warning" style="width: 40%"></div>
                                        </div>
                                    </div>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">
                                        <h5 class="description-header">R$ 000.000,00</h5>
                                        <span class="description-text">FATURAMENTO ANUAL</span>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">

                                        <h5 class="description-header">R$ 000.000,00</h5>
                                        <span class="description-text">PERCENTUAL ANUAL</span>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">
                                        <h5 class="description-header">R$ 000.000,00</h5>
                                        <span class="description-text">FATURAMENTO MÊS ATUAL</span>
                                    </div>
                                </div> 
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">
                                        <h5 class="description-header">R$ 000.000,00</h5>
                                        <span class="description-text">PERCENTUAL DO MÊS</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            


            
            <!-- inicio mapa -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Localização dos Equipamentos</h3>
                            <div class="card-tools">   </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="d-md-flex">
                                <div class="p-1 flex-1" style="overflow: hidden">

                                    <script src="https://codeigniter.tutsmake.com/public/jquery.js"></script>
                                    <style>
                                        .container{
                                            padding: 2%;
                                            text-align: center;
                                        } 
                                        #map_wrapper_div {
                                            height: 480px;
                                        }
                                        #map_tuts {
                                            width: 100%;
                                            height: 100%;
                                        }
                                    </style>
                                    <div class="row">
                                        <div class="col-12">
                                            <div id="map_wrapper_div">
                                                <div id="map_tuts"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- fim mapa -->   

            </div>
        </div>
        
            
    </section>
</div>



<!-- PAGE PLUGINS -->
<!-- SparkLine -->
<script src="<?= base_url() ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jVectorMap -->
<script src="<?= base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?= base_url() ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.2 -->
<script src="<?= base_url() ?>assets/plugins/chartjs-old/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="<?= base_url() ?>assets/dist/js/pages/dashboard2.js"></script>
<script src="<?= base_url() ?>assets/plugins/jquery.mask.js"></script>

<!-- google maps -->
<script>
    $(function ($) {
// Asynchronously Load the map API 
        var script = document.createElement('script');
        script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyDp6K-uwKI_vZYmaB3KPKnmlGlYxS-pXrQ&callback=initMapsensor=false&callback=initialize";
        document.body.appendChild(script);
    });

    function initialize() {
        var map;
        var bounds = new google.maps.LatLngBounds();
        var mapOptions = {
            mapTypeId: 'roadmap'
        };

// Display a map on the page
        map = new google.maps.Map(document.getElementById("map_tuts"), mapOptions);
        map.setTilt(45);

// Multiple Markers
        var markers = JSON.parse(`<?php echo ($markers); ?>`);
        console.log(markers);

        var infoWindowContent = JSON.parse(`<?php echo ($infowindow); ?>`);

// Display multiple markers on a map
        var infoWindow = new google.maps.InfoWindow(), marker, i;

// Loop through our array of markers &amp; place each one on the map  
        for (i = 0; i < markers.length; i++) {
            var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
            bounds.extend(position);
            marker = new google.maps.Marker({
                position: position,
                map: map,
                title: markers[i][0]
            });

            // Each marker to have an info window    
            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                return function () {
                    infoWindow.setContent(infoWindowContent[i][0]);
                    infoWindow.open(map, marker);
                }
            })(marker, i));

            // Automatically center the map fitting all markers on the screen
            map.fitBounds(bounds);
        }

// Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
        var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function (event) {
            this.setZoom(5);
            google.maps.event.removeListener(boundsListener);
        });

    }
    
    
    $(function () {

  'use strict'

  // Get context with jQuery - using jQuery's .get() method.
  var salesChartCanvas = $('#salesChart').get(0).getContext('2d')
  // This will get the first returned node in the jQuery collection.
  var salesChart       = new Chart(salesChartCanvas)

  var salesChartData = {
    labels  : <?php echo  json_encode($operacao_mes); ?>,
    datasets: [
      
      {
        label               : 'Ganhos',
        fillColor           : 'rgba(0, 123, 255, 0.9)',
        strokeColor         : 'rgba(0, 123, 255, 1)',
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(0, 123, 255, 1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(0, 123, 255, 1)',
        data                : <?php echo  json_encode($operacao_vendas); ?>
      }
    ]
  }

  var salesChartOptions = {
    //Boolean - If we should show the scale at all
    showScale               : true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines      : false,
    //String - Colour of the grid lines
    scaleGridLineColor      : 'rgba(0,0,0,.05)',
    //Number - Width of the grid lines
    scaleGridLineWidth      : 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines  : true,
    //Boolean - Whether the line is curved between points
    bezierCurve             : true,
    //Number - Tension of the bezier curve between points
    bezierCurveTension      : 0.3,
    //Boolean - Whether to show a dot for each point
    pointDot                : false,
    //Number - Radius of each point dot in pixels
    pointDotRadius          : 4,
    //Number - Pixel width of point dot stroke
    pointDotStrokeWidth     : 1,
    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    pointHitDetectionRadius : 20,
    //Boolean - Whether to show a stroke for datasets
    datasetStroke           : true,
    //Number - Pixel width of dataset stroke
    datasetStrokeWidth      : 2,
    //Boolean - Whether to fill the dataset with a color
    datasetFill             : true,
    //String - A legend template
    legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%=datasets[i].label%></li><%}%></ul>',
    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio     : false,
    //Boolean - whether to make the chart responsive to window resizing
    responsive              : true
  }

  //Create the line chart
  salesChart.Line(salesChartData, salesChartOptions)
  
  });
</script>
<!-- end google maps -->