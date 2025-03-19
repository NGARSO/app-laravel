<x-app-layout>
   
    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div id="chartContainer1" class="rounded shadow-lg animate__animated animate__fadeInUp" style="height: 370px; width: 100%;"></div>
                            </div>
                            <div class="col-md-6">
                                <div id="chartContainer2" class="rounded shadow-lg animate__animated animate__fadeInUp" style="height: 370px; width: 100%;"></div>
                            </div>
                        </div>
                    </div>

    <!-- Dependencies -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script>
        window.onload = function() {
            // First chart
            var chart1 = new CanvasJS.Chart("chartContainer1", {
                animationEnabled: true,
                theme: "light2",
                title: {
                    text: "Statistiques de présences"
                },
                axisY: {
                    suffix: "%",
                    scaleBreaks: {
                        autoCalculate: true
                    }
                },
                data: [{
                    type: "column",
                    yValueFormatString: "#,##0\"%\"",
                    indexLabel: "{y}",
                    indexLabelPlacement: "inside",
                    indexLabelFontColor: "white",
                    dataPoints: <?php echo $dataPointsJson1; ?>
                }]
            });
            chart1.render();

            // Second chart
            var chart2 = new CanvasJS.Chart("chartContainer2", {
                animationEnabled: true,
                exportEnabled: true,
                title: {
                    text: "Statistiques de cours"
                },
                subtitles: [{
                    text: "Devise utilisée : Baht thaïlandais (฿)"
                }],
                data: [{
                    type: "pie",
                    showInLegend: true,
                    legendText: "{label}",
                    indexLabelFontSize: 16,
                    indexLabel: "{label} - #percent%",
                    yValueFormatString: "฿#,##0",
                    dataPoints: <?php echo $dataPointsJson2; ?>
                }]
            });
            chart2.render();
        };
    </script>

    <style>
        .btn-custom {
            background: #00b4d8;
            color: #fff;
            padding: 10px 25px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 180, 216, 0.4);
        }

        .modal-content {
            border: none;
            border-radius: 15px;
            animation: fadeInUp 0.5s ease-out;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</x-app-layout>