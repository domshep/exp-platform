<?php
interface ModulePlugin {
	/**
	 * Return the public name of the module.
	 */
	public function module_name();
	
	/**
	 * Returns the base URL to this module.
	 *
	 * @return string
	 */
	public function module_base_url();
	
	/**
	 * Returns the path to the icon for this module.
	 *
	 * @return string
	 */
	public function module_icon_url();

	/**
	 * Returns the type of module (e.g. dashboard, widget, survey).
	 *
	 * @return string
	 */
	public function module_type();
	
	/**
	 * Default index function for the module.
	 * 
	 * If the module is on the user's dashboard, then they should be automatically redirected to the module dashboard.
	 * Otherwise, they should be redirected to the 'explore_module' view.
	 */
	public function index();
	
	
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
	
	/**
	 * Returns the total number of data records that have been recorded by this module.
	 *
	 * @throws ForbiddenException
	 * @return number
	 */
	public function total_data_records();
	
	/**
	 * Displays the 'Health data' module view for the admin panel.
	 */
	public function admin_module_data();
	
	/**
	 * Tidies up database in preparation for the module to be deleted from the website.
	 */
	public function admin_delete_module();
	
	/**
	 * Returns the SQL necessary to create and set up the module for use.
	 *
	 * @return array of SQL commands to execute
	 */
	public function admin_install_sql();
}
?>