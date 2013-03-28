<?php 
	/* Not used by this module
App::import('Vendor', 'jpgraph/jpgraph');
App::import('Vendor', 'jpgraph/jpgraph_line');
App::import('Vendor', 'jpgraph/jpgraph_date');

// Some data
$ydata = $graphData;
$xdata = $dates;

// Create the graph. These two calls are always required
$graph = new Graph(350,250);
$graph->SetScale('datlin');

$graph->title->SetFont(FF_ARIAL, FS_BOLD, 14);
$graph->title->Set("Using JpGraph Library");
$graph->title->SetMargin(10);

$graph->xaxis->title->SetFont(FF_ARIAL, FS_BOLD, 10);
$graph->xaxis->title->Set("Week beginning");

$graph->yaxis->title->SetFont(FF_ARIAL, FS_BOLD, 10);
$graph->yaxis->title->Set("Health score (out of 10)");

//$graph->xaxis->scale->SetDateAlign( DAYADJ_7 );
// Force labels to only be displayed every 7 days
$graph->xaxis->scale->ticks->Set(60*60*24*7);

// Use hour:minute format for the labels
$graph->xaxis->scale->SetDateFormat('d M Y');

// Slightly larger than normal margins at the bottom to have room for
// the x-axis labels
$graph->SetMargin(40,40,30,130);

// Set the angle for the labels to 90 degrees
$graph->xaxis->SetLabelAngle(90);

// Create the linear plot
$lineplot=new LinePlot($ydata,$xdata);
$lineplot->SetColor('blue');

// Add the plot to the graph
$graph->Add($lineplot);

// Display the graph
$graph->Stroke();

*/
?>
<p>The graph is not used by this module</p>