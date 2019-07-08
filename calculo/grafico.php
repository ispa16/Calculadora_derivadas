<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php
		$ses["bases"] = array(2);
		$ses["expoentes"] = array(4);
		$ses["dbases"] = array(8);
		$ses["dexpoentes"] = array(3);

		$min = 0;
		$max = 5;
	?>
	<script type="text/javascript">
		window.onload = function () {
			var chart = new CanvasJS.Chart("chartContainer",
			{
				animationEnabled: true,
		      	theme: "theme2",
				title:{
					text: "Grafico da Função e Derivada"
				},
		      	axisY:[{
		          lineColor: "#4F81BC",
		          tickColor: "#4F81BC",
		          labelFontColor: "#4F81BC",
		          titleFontColor: "#4F81BC",
		          lineThickness: 2,
		      	},
		        {
		          lineColor: "#C0504E",
		          tickColor: "#C0504E",
		          labelFontColor: "#C0504E",
		          titleFontColor: "#C0504E",
		          lineThickness: 2,
		          
		      	}],
				data: [
				{
					type: "spline", //change type to bar, line, area, pie, etc
					showInLegend: true,        
					dataPoints: [
						<?php
							for ($x = $min; $x <= $max; $x++) {
								$res = 0;
								for($i=0; $i < count($ses['bases']); $i++){
									$res += $ses['bases'][$i]*pow($x, $ses['expoentes'][$i]);
								}
								echo "{ x: $x, y: $res },";
							}
						?>
					]
					},
					{
					type: "spline",
					showInLegend: true,            
					dataPoints: [
						<?php
							for ($x = $min; $x <= $max; $x++) {
								$res = 0;
								for($i=0; $i < count($ses['dbases']); $i++){
									$res += $ses['dbases'][$i]*pow($x, $ses['dexpoentes'][$i]);
								}
								echo "{ x: $x, y: $res },";
							}
						?>
					]
					}
				],
				legend: {
					cursor: "pointer",
					itemclick: function (e) {
						if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
							e.dataSeries.visible = false;
						} else {
							e.dataSeries.visible = true;
					}
					chart.render();
					}
				}
			});

			chart.render();
		}
</script>
<script type="text/javascript" src="_js/canvasjs.min.js"></script>
</head>
<body>

	<h1>Graficooo</h1>

	<div id="chartContainer" style="height: 300px; width: 100%;"></div>

</body>
</html>