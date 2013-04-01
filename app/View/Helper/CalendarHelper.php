<?php
	/*
	A function for use with calendars
	The function parameters are as follows:

    $year – expects a year in 4 digit e.g. 2007
    $month – expects a month in english e.g. january
    $data – an array containing the data for each day of the month e.g.

	$data[2]['entry'] = '2/10';
    $data[2]['comment'] = ‘This is an entry for the 2nd day of the month’;
    $data[24]['entry'] = '9/10';
    $date[24]['comment'] = ‘A link for the 24th of the month‘;
	
    The data['entry'] is any HTML you want – it is up to you to generate it yourself before you hand it to the calendar.

    $base_url – the url to send the back / foward links on to i.e. the address of page (the calendar expects to be in a mod re-written situation e.g. www.flipflops.org/calendar/2008/june)
	
	Thanks to FlipFlops.org for the basic calendar function.
	*/

	class CalendarHelper extends AppHelper 
	{
		public $helpers = array('Html');
		
		/*public function __construct(View $view, $settings = array()) {
        	parent::__construct($view, $settings);
        	debug($settings);
    	}*/
		
		// year - month - data to show on date as an array - link for prev/next - link for date shown - pass rate - class for pass - class for fail
		public function calendar($year = '', $month = '', $data = '', $base_url = '', $link_url = '', $pass = '', $passclass = '', $failclass = '')
		{
			if ($passclass == "") $passclass = 'green';
			if ($failclass == "") $failclass = 'red';
			
			$str = '';
			$month_list = array('january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december');
			$day_list = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
			$day = 1;
			$today = 0;
	 		
			// If no year or month has been set
			if($year == '' || $month == '')// just use current year & month
			{
				$year = gmdate('Y');
				$month = gmdate('M');
			}
	 
			$flag = 0;
	 		
			// What is the month number...
			for($i = 0; $i < 12; $i++)
			{
				if(strtolower($month) == $month_list[$i])
				{
					if(intval($year) != 0)
					{
						$flag = 1;
						$month_num = $i + 1;
						break;
					}
				}
			}
	 
			if($flag == 0)
			{
				$year = gmdate('Y');
				$month = gmdate('F');
				$month_num = gmdate('m');
			}
	 		
			// Sort out one digit months (for the URL)
			if ($month_num < 10) $month_num = "0".$month_num;
						
			$next_year = $year;
			$prev_year = $year;
	 
			$next_month = intval($month_num) + 1;
			$prev_month = intval($month_num) - 1;
	 
			if($next_month == 13)
			{
				$next_month = 'january';
				$next_year = intval($year) + 1;
			}
			else $next_month = $month_list[$next_month -1];
	 
			if($prev_month == 0)
			{
				$prev_month = 'december';
				$prev_year = intval($year) - 1;
			}
			else $prev_month = $month_list[$prev_month - 1];
	 
			// set the flag that shows todays date but only in the current month - not past or future...
			if($year == gmdate('Y') && strtolower($month) == strtolower(gmdate('F'))) $today = gmdate('j');
	 		
			$days_in_month = gmdate("t", gmmktime(0, 0, 0, $month_num, 1, $year));
			$first_day_in_month = gmdate('D', gmmktime(0,0,0, $month_num, 1, $year)); 
	 		
			// Heading and Prev / Next
			$prev_link = $this->Html->image(
				'Actions-go-previous-view-icon.png',
				array('alt' => 'Previous week',
				  	'url' => $base_url . '/' . $prev_year . '/' . $prev_month . '#calendar',
				  	'class' => 'previous',
				  	'title' => 'Go to previous month'
					)
			);
			$next_link = $this->Html->image(
				'Actions-go-next-view-icon.png',
				array('alt' => 'Next week',
					  'url' => $base_url . '/' . $next_year . '/' . $next_month . '#calendar',
					  'class' => 'next',
					  'title' => 'Go to next month'
				)
		);
			
			$str .= '<table class="calendar" id="calendar">';
			$str .= '<tr><th class="cell-prev">'. $prev_link. '</th>';
			$str .= '<th colspan="5" style="text-align: center;">' . ucfirst($month) . ' ' . $year . '</th>';
			if(strtotime("1 " . $next_month . " ".$next_year) <= time()) {
				$str .= '<th class="cell-next">' . $next_link. '</th>';
			} else {
				$str .= '<th class="cell-next">&nbsp;</th>';
			}
			$str .= '</tr><tr>';
			
			// Day of the week headers
			for($i = 0; $i < 7;$i++)
			{
				$str .= '<th class="cell-header">' . $day_list[$i] . '</th>';
			}
			$str .= '</tr>';
	
			// get the first day of the month
			while($day < $days_in_month+1)
			{
				$str .= '<tr>';
				// Loop until we have a complete week.
				for($i = 0; $i < 7; $i ++)
				{
					// Load the data
					$cell = '&nbsp;';
					$popup = '';
					$popupfull = '';
					if(isset($data[$day]['entry'])) $cell = $data[$day]['entry'];
					if(isset($data[$day]['comment'])) $popupfull = $data[$day]['comment'];
					$popup = $popupfull;
					if (strlen($popup) > 100) $popup = substr($popupfull,0,100) . "...";
					$class = '';
					
					// optional weekend and today classes
					if($i > 4) $class = ' class="cell-weekend" ';
					elseif($day == $today) $class = ' class="cell-today" ';
					else $class='';
						
					// If we have reached the first day of the month
					if(($first_day_in_month == $day_list[$i] || $day > 1) && ($day < $days_in_month+1))
					{
						$caldate = gmmktime(0,0,0,$month_num,$day,$year); // the date we are rendering
						$now = gmdate("U"); // today's date
						
						// If this cell has contents
						if ($cell != "&nbsp;" and $cell != ""){
							// if the cell value meets the target
							if ($cell >= $pass) $class = ' class="'.$passclass.'"';
							elseif ($cell < $pass) $class = ' class="'.$failclass.'"'; // else show the failure
						}
						elseif ($caldate < $now){ 
							$cell = "+"; // if the date is in the past show an "add" link.
							$class = " class='add'";
							$popup = "Click to add a record for this date";
						}
						else $cell = "&nbsp;"; // else show nothing
						
						//Sort out the issue with single digit days
						if ($day < 10) $month_day = "0".$day;
						else $month_day = $day;
						
						if ($popup != "") $hover = 'title="'.$popup.'"';
						else $hover = '';
						
						// Write the cell.
						$str .= '<td '.$class.'><div class="cell-number">'.$day.'</div><div class="cell-data"><a '.$hover.' href="'.$link_url.'/'.$year.$month_num.$month_day.'">'.$cell.'</a></div></td>';
						$day++;
					}
					else $str .= '<td ' . $class . '>&nbsp;</td>'; // end of the month fillers
					$class = "";
				}
				$str .= '</tr>';
			}
			$str .= '</table>';
	 
			return $str;
		}
	}
?>