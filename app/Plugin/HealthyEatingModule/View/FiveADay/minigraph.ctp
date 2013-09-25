<?php
App::import('Vendor', 'jpgraph/jpgraph');
App::import('Vendor', 'jpgraph/jpgraph_line');
App::import('Vendor', 'jpgraph/jpgraph_date');

// Some data
$ydata = $graphData;
$xdata = $dates;

// Create the graph. These two calls are always required
$graph = new Graph(494,475);
$graph->SetScale('datlin',min(array_merge($ydata, array(35)))-1,max(array_merge($ydata, array(35))) + 1, min($xdata),max($xdata));
$graph->img->SetAntiAliasing(false); 

$graph->xaxis->title->SetFont(FF_FONT1, FS_BOLD, 10);
$graph->xaxis->title->Set("Week beginning");
$graph->xaxis->title->SetMargin(50);

$graph->yaxis->title->SetFont(FF_FONT1, FS_BOLD, 10);
$graph->yaxis->title->Set("Servings of fruit & veg eaten during the week");
$graph->yaxis->title->SetMargin(20);

// Force labels to only be displayed every 7 days
$graph->xaxis->scale->ticks->Set(60*60*24*7);

// Use hour:minute format for the labels
$graph->xaxis->scale->SetDateFormat('d M Y');

// Slightly larger than normal margins at the bottom to have room for
// the x-axis labels
$graph->SetMargin(70,20,20,150);

// Set the angle for the labels to 90 degrees
$graph->xaxis->SetLabelAngle(45);

// Ticks on the outside
$graph->xaxis->SetTickSide(SIDE_DOWN);
$graph->yaxis->SetTickSide(SIDE_LEFT);

// Create the linear plot
$lineplot=new LinePlot($ydata,$xdata);
$lineplot->SetColor('blue');
$lineplot->mark->SetType(MARK_UTRIANGLE);
$lineplot->mark->SetColor('blue');
$lineplot->mark->SetFillColor('blue');
$lineplot->SetFillGradient('white','lightblue');

// Add the plot to the graph
$graph->Add($lineplot);

// Create the marker plot - 5 x 7 = 35 servings of fruit is the target to aim for
$markerplot = new LinePlot(array(35,35),array($xdata[0],end($xdata)));
$markerplot->SetColor('red');

// Add the marker plot to the graph
$graph->Add($markerplot);
$markerplot->SetWeight(3);

// Set the legends for the plots
$lineplot->SetLegend('Your recorded servings of fruit & veg');
$markerplot->SetLegend('Recommended 35 servings of fruit & veg');

// Adjust the legend position
$graph->legend->SetPos(0.01,0.98,'left','bottom');
$graph->legend->SetShadow('gray@0.4',2);
$graph->legend->SetColumns(1);

// Display the graph
$graph->graph_theme=null;
$graph->Stroke();
?>