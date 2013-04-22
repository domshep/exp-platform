<?php
App::import('Vendor', 'jpgraph/jpgraph');
App::import('Vendor', 'jpgraph/jpgraph_line');
App::import('Vendor', 'jpgraph/jpgraph_date');

// Some data
$ydata = $graphData;
$xdata = $dates;

// Create the graph. These two calls are always required
$graph = new Graph(434,475);
$graph->SetScale('datlin',min($ydata)-1,max($ydata) + 1, min($xdata),max($xdata));
$graph->img->SetAntiAliasing(false); 

$graph->xaxis->title->SetFont(FF_FONT1, FS_BOLD, 10);
$graph->xaxis->title->Set("Week beginning");
$graph->xaxis->title->SetMargin(50);

$graph->yaxis->title->SetFont(FF_FONT1, FS_BOLD, 10);
$graph->yaxis->title->Set("Body Mass Index (BMI)");
$graph->yaxis->title->SetMargin(20);

// Force labels to only be displayed every 7 days
$graph->xaxis->scale->ticks->Set(60*60*24*7);

// Use hour:minute format for the labels
$graph->xaxis->scale->SetDateFormat('d M Y');

// Slightly larger than normal margins at the bottom to have room for
// the x-axis labels
$graph->SetMargin(70,20,20,200);
$graph->SetClipping(true);

// Set the angle for the labels to 90 degrees
$graph->xaxis->SetLabelAngle(45);

// Ticks on the outside
$graph->xaxis->SetTickSide(SIDE_DOWN);
$graph->yaxis->SetTickSide(SIDE_LEFT);


$obeseplot = new LinePlot(array(50,50),array($xdata[0],end($xdata)));
$graph->Add($obeseplot);
$obeseplot->SetColor('red');
$obeseplot->SetFillGradient('red','white',32);

$overweightplot = new LinePlot(array(29.9,29.9),array($xdata[0],end($xdata)));
$graph->Add($overweightplot);
$overweightplot->SetColor('yellow');
$overweightplot->SetFillGradient('yellow','white',64);

$healthyweightplot = new LinePlot(array(24.9,24.9),array($xdata[0],end($xdata)));
$graph->Add($healthyweightplot);
$healthyweightplot->SetColor('green');
$healthyweightplot->SetFillGradient('green','white',32);

$underweightplot = new LinePlot(array(18.4,18.4),array($xdata[0],end($xdata)));
$graph->Add($underweightplot);
$underweightplot->SetColor('red');
$underweightplot->SetFillGradient('red','white',32);

// Create the linear plot
$lineplot=new LinePlot($ydata,$xdata);
$graph->Add($lineplot);
$lineplot->SetColor('blue');
$lineplot->mark->SetType(MARK_UTRIANGLE);
$lineplot->mark->SetColor('blue');
$lineplot->mark->SetFillColor('blue');
$lineplot->SetFillGradient('white','lightblue');

$healthyweightplot2 = new LinePlot(array(24.9,24.9),array($xdata[0],end($xdata)));
$graph->Add($healthyweightplot2);
$healthyweightplot2->SetColor('green');

$healthyweightplot3 = new LinePlot(array(18.5,18.5),array($xdata[0],end($xdata)));
$graph->Add($healthyweightplot3);
$healthyweightplot3->SetColor('green');

$overweightplot2 = new LinePlot(array(29.9,29.9),array($xdata[0],end($xdata)));
$graph->Add($overweightplot2);
$overweightplot2->SetColor('yellow');

// Set the legends for the plots
$lineplot->SetLegend('Your BMI score');
$underweightplot->SetLegend('A BMI of less than 18.5 is classed as "underweight"');
$healthyweightplot->SetLegend('A BMI between 18.5 and 24.9 is classed as "healthy"');
$overweightplot->SetLegend('A BMI between 25 and 29.9 is classed as "overweight"');
$obeseplot->SetLegend('A BMI over 30 is classed as "obese"');

// Adjust the legend position
$graph->legend->SetPos(0.01,0.98,'left','bottom');
$graph->legend->SetShadow('gray@0.4',2);
$graph->legend->SetColumns(1);

// Display the graph
$graph->graph_theme=null;
$graph->Stroke();
?>