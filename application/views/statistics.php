<?php $this->load->view('inc/meta.php'); ?>
<div class="container">
	<?php $this->load->view('inc/header.php'); ?>
<!--Div that will hold the pie chart-->	
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script type="text/javascript">

		// Load the Visualization API and the piechart package.
		google.load('visualization', '1.0', {'packages':['corechart']});

		// Set a callback to run when the Google Visualization API is loaded.
		google.setOnLoadCallback(drawChart);

		// Callback that creates and populates a data table, 
		// instantiates the pie chart, passes in the data and
		// draws it.
		function drawChart() {

		// Create the data table.
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Module');
			data.addColumn('number', '% of attendance for top 10 modules');

				<?php 
				$i = 0;
				echo "data.addRows($num_numofusersforcourse);";
				foreach($toppercofattenpermodule as $percofattenpermodule1):
				echo "data.setValue($i,0,'$percofattenpermodule1->name');";
				echo "data.setValue($i,1,$percofattenpermodule1->num);";
				$i++;
				endforeach; ?>
	

			// Set chart options
			var options = {'title':'% of attendance for eaech module',
			'width':800,
			'height':600, 
			min:0, 
			max:100,
			hAxis: {title: 'Module', titleTextStyle: {color: 'red'}}};

			// Instantiate and draw our chart, passing in some options.
			var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
			chart.draw(data, options);
			
			var data2 = new google.visualization.DataTable();
			data2.addColumn('string', 'Module');
			data2.addColumn('number', '% of attendance for bottom 10 modules');

				<?php 
				$i = 0;
				echo "data2.addRows($num_numofusersforcourse);";
				foreach($bottompercofattenpermodule as $percofattenpermodule1):
				echo "data2.setValue($i,0,'$percofattenpermodule1->name');";
				echo "data2.setValue($i,1,$percofattenpermodule1->num);";
				$i++;
				endforeach; ?>
	

			// Set chart options
			var options2 = {'title':'% of attendance for bottom 10 modules',
			'width':800,
			'height':600, 
			min:0, 
			max:100,
			hAxis: {title: 'Module', titleTextStyle: {color: 'red'}}};

			// Instantiate and draw our chart, passing in some options.
			var chart2 = new google.visualization.ColumnChart(document.getElementById('chart_div2'));
			chart2.draw(data2, options2);
			
			var data1 = new google.visualization.DataTable();
			data1.addColumn('string', 'Module');
			data1.addColumn('number', 'Number Of Students');
			data1.addRows([
				<?php foreach($topnumofusersforcourse as $numofusersforcourse1):
				echo "['$numofusersforcourse1->name', $numofusersforcourse1->num],
				"; 
				endforeach; ?>
			]);

			// Set chart options
			var options1 = {'title':'How many students per top 10 modules',
			'width':800,
			'height':600};

			// Instantiate and draw our chart, passing in some options.
			var chart1 = new google.visualization.ColumnChart(document.getElementById('chart_div1'));
			chart1.draw(data1, options1);
			

			// Instantiate and draw our chart, passing in some options.
			var chart3 = new google.visualization.ColumnChart(document.getElementById('chart_div1'));
			chart3.draw(data1, options1);
			
			var data3 = new google.visualization.DataTable();
			data3.addColumn('string', 'Module');
			data3.addColumn('number', 'Number Of Students');
			data3.addRows([
				<?php foreach($bottomnumofusersforcourse as $numofusersforcourse1):
				echo "['$numofusersforcourse1->name', $numofusersforcourse1->num],
				"; 
				endforeach; ?>
			]);

			// Set chart options
			var options3 = {'title':'How many students per bottom 10 modules',
			'width':800,
			'height':600};

			// Instantiate and draw our chart, passing in some options.
			var chart3 = new google.visualization.ColumnChart(document.getElementById('chart_div3'));
			chart3.draw(data3, options3);
			
		}
		
	</script>
<div id="chart_div"></div>
<div id="chart_div2"></div>
<div id="chart_div1"></div>
<div id="chart_div3"></div>
</div>

<?php $this->load->view('inc/footer.php'); ?>