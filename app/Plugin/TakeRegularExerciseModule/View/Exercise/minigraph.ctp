<?php
App::import('Vendor', 'jpgraph/jpgraph');
App::import('Vendor', 'jpgraph/jpgraph_line');
App::import('Vendor', 'jpgraph/jpgraph_date');

// Some data
$ydata = $graphData;
$xdata = $dates;

// Create the graph. These two calls are always required
$graph = new Graph(434,375);
$graph->SetScale('datlin');

$graph->xaxis->title->SetFont(FF_FONT1, FS_BOLD, 10);
$graph->xaxis->title->Set("Week beginning");
$graph->xaxis->title->SetMargin(50);

$graph->yaxis->title->SetFont(FF_FONT1, FS_BOLD, 10);
$graph->yaxis->title->Set("Time in Minutes of exercise done over the week");
$graph->yaxis->title->SetMargin(20);

// Force labels to only be displayed every 7 days
$graph->xaxis->scale->ticks->Set(60*60*24*7);

// Use hour:minute format for the labels
$graph->xaxis->scale->SetDateFormat('d M Y');

// Slightly larger than normal margins at the bottom to have room for
// the x-axis labels
$graph->SetMargin(70,20,20,100);

// Set the angle for the labels to 90 degrees
$graph->xaxis->SetLabelAngle(45);

// Create the linear plot
$lineplot=new LinePlot($ydata,$xdata);
$lineplot->SetColor('blue');

// Add the plot to the graph
$graph->Add($lineplot);

// Create the marker plot - 5 x 7 = 35 servings of fruit is the target to aim for
$markerplot = new LinePlot(array(150,150),array($xdata[0],end($xdata)));
$markerplot->SetColor('red');

// Add the marker plot to the graph
$graph->Add($markerplot);

// Display the graph
$graph->Stroke();
?>