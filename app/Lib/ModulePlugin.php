<?php
interface ModulePlugin {
	/**
	 * Return the public name of the module.
	 */
	public function _module_name();
	
	/**
	 * Initial landing screen for finding out what the module is about. This is the first
	 * page that a non-logged in user will see when they arrive in the module.
	 */
	public function explore_module();
	
	/**
	 * Initial landing screen for the process of a logged-in user adding the module to their
	 * dashboard.
	 * 
	 * May simply redirect to the data_entry screen for one-off and other special modules.
	 */
	public function add_module();
	
	/**
	 * 'Home page' for the module, when accessed by a logged-in user from their dashboard.
	 * 
	 * Will usually contain feedback / charts on their achievements so far, along with the
	 * ability to quickly make a new data entry.
	 */
	public function module_dashboard();
	
	/**
	 * Initial landing screen for the main data entry point for the module. This could be in
	 * the form of a daily / weekly submission form, or a one-off survey.
	 */
	public function data_entry();
	
	/**
	 * If you need the user to be able to edit this data it can be done here.
	 */
	//public function admin_edit_data();
	
	
	/**
	 * Initial landing screen for the review area for the module. Should provide options for
	 * reviewing achievements.
	 */
	public function review_progress();
	
	/**
	 * Displays the view block that will appear in the module dashboard 'achievements' widget
	 * reviewing achievements. This will be unique to the user.
	 */
	public function dashboard_achievements();
	
	/**
	 * Displays the view block that will appear in the module dashboard widget for those
	 * users who have added the module to their dashboard. This will usually be unique to the
	 * user.
	 * TODO: Still need to define exact dimensions of the screen-space that will be available.
	 */
	public function dashboard_widget();
	
	/**
	 * Displays any news / updates / information from this module in the user's news feed.
	 */
	public function dashboard_news();
}
?>