<!doctype html>
<html>
	<head>
	<!--Load the AJAX API-->
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script type="text/javascript">

		// Load the Visualization API and the piechart package.
		google.load('visualization', '1.0', {'packages':['corechart']});

		// Set a callback to run when the Google Visualization API is loaded.
		google.setOnLoadCallback(drawChart);
		google.setOnLoadCallback(drawChart2);

		// Callback that creates and populates a data table, 
		// instantiates the pie chart, passes in the data and
		// draws it.
		function drawChart() {

		// Create the data table.
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Module');
			data.addColumn('number', 'Number Of Students');
			data.addRows([
				<?php foreach($percofattenpermodule as $percofattenpermodule1):
				echo "['$percofattenpermodule1->name', $percofattenpermodule1->num],
				"; 
				endforeach; ?>
			]);

			// Set chart options
			var options = {'title':'How many students per module',
			'width':800,
			'height':600};

			// Instantiate and draw our chart, passing in some options.
			var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
			chart.draw(data, options);
			
			// Create the data table.
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Module');
			data.addColumn('number', 'Number Of Students');
			data.addRows([
				<?php foreach($numofusersforcourse as $numofusersforcourse1):
				echo "['$numofusersforcourse1->name', $numofusersforcourse1->num],
				"; 
				endforeach; ?>
			]);

			// Set chart options
			var options = {'title':'How many students per module',
			'width':800,
			'height':600};

			// Instantiate and draw our chart, passing in some options.
			var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
			chart.draw(data, options);
			
		}

	</script>
</head>

<body>
<!--Div that will hold the pie chart-->
<div id="container">
<div id="chart_div"></div>
</div>
</body>
</html>