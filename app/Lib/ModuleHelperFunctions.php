<?php
class ModuleHelperFunctions {
	/**
	 * Returns the week beginning date for the given date (starting on a Monday).
	 *
	 * @param string $date
	 */
	public function _getWeekBeginningDate($date) {
		$dateTime = strtotime("2:00 " . $date);
		if(date('w',$dateTime) == '1') {
			// It's Monday, so return the same date
			return $dateTime;
		} else {
			// return last Monday's date
			return strtotime('this week last monday', $dateTime);
		}
	}
	
	/**
	 * Returns the set of monthly calendar entries for the given year and month, in a format ready to
	 * pass to the CalendarHelper class.
	 *
	 * @param string $year
	 * @param string $month
	 * @return array
	 */
	public function getMonthlyCalendarEntries($model = null, $userId = null, $year = null, $month = null, $whatworked = false) {
		// Use today's date if no date given.
		if(is_null($month)) $month = gmdate("F");
		if(is_null($year)) $year = gmdate("Y");
	
		// Calculate the month number and week-beginning date for the first of the month
		$monthnum = gmdate('n', strtotime("2:00 1 ".$month. " ".$year));
		$monthStartDate = gmmktime(2,0,0,$monthnum,1,$year);
		$monthWeekBeginning = $this->_getWeekBeginningDate(gmdate("Ymd",$monthStartDate));
	
		// Retrieve all the weekly entries between the start week and the last day of the month
		$allEntries = $model->find('all',array(
				'conditions' => array(
						'user_id' => $userId,
						'week_beginning >=' => gmdate("Y-m-d",$monthWeekBeginning),
						'week_beginning <=' => gmdate("Y-m-t",$monthStartDate)
				),
				'order' => array('week_beginning' => 'asc')
		));
	
		$records = array();
		$weekdayList = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
	
		// Iterate through the entries and reformat them as, e.g., array( 1 => '10', 2 => '5', 14 => '2'... 31 => '12')
		foreach($allEntries as $key => $weeklyEntry) {
			foreach($weekdayList as $weekDayNo => $weekday) {
				$weekDayDate = strtotime("2:00 " . $weeklyEntry[get_class($model)]['week_beginning']
						. " +" . $weekDayNo . " day");
				if(date('n Y', $weekDayDate) == $monthnum . " " . $year) {
					if ($whatworked == false) $records[date('j', $weekDayDate)] = $weeklyEntry[get_class($model)][$weekday]; // weekday entries
					else
					{
						$whatworked = $weeklyEntry[get_class($model)]['what_worked'];
						$records[date('j', $weekDayDate)] = $whatworked; // what worked?
					}
				}
			}
		}
	
		return $records;
	}
}
?>