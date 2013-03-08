<?php
interface ModulePlugin {
	public function test_view();
	public function module_name();
	public function module_snapshot();
	public function explore_module();
	public function add_module();
	public function module_dashboard();
	public function data_entry();
	public function review_progress();
	public function dashboard_widget();
	public function dashboard_news();
}
?>