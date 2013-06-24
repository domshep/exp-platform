-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 15, 2013 at 12:57 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `exp-platform`
--

--
-- Dumping data for table `bmi_achievements`
--

INSERT INTO `bmi_achievements` (`user_id`, `latest_bmi`, `change_since_start`, `consec_healthy_weeks`, `created`, `modified`) VALUES
(4, 23.67, -15, 0, '2013-05-14 13:10:11', '2013-05-14 13:19:59');

--
-- Dumping data for table `bmi_screeners`
--

INSERT INTO `bmi_screeners` (`id`, `user_id`, `height_cm`, `start_weight_kg`, `start_bmi`, `created`, `modified`) VALUES
(1, 4, 178, 90, 28.34, '2013-05-14 13:10:11', '2013-05-14 13:10:11');

--
-- Dumping data for table `bmi_weekly`
--

INSERT INTO `bmi_weekly` (`id`, `week_beginning`, `user_id`, `height_cm`, `weight_kg`, `bmi`, `what_worked`, `created`, `modified`) VALUES
(1, '2013-05-13', 4, 178, 75, 23.67, '', '2013-05-14 13:11:59', '2013-05-14 13:11:59'),
(2, '2013-05-06', 4, 178, 35, 11.02, '', '2013-05-14 13:15:25', '2013-05-14 13:19:59');

--
-- Dumping data for table `drinking_achievements`
--

INSERT INTO `drinking_achievements` (`user_id`, `total_sensible_days`, `total_excess_days`, `total_binge_days`, `consec_healthy_weeks`, `created`, `modified`) VALUES
(4, 14, 7, 0, 1, '2013-05-14 15:08:19', '2013-05-14 15:12:36');

--
-- Dumping data for table `drinking_screeners`
--

INSERT INTO `drinking_screeners` (`id`, `user_id`, `gender`, `how_often`, `how_many`, `binge`, `score`, `created`, `modified`) VALUES
(1, 1, 'M', 1, 0, 1, 2, '2013-05-05 08:48:09', '2013-05-05 08:48:09'),
(2, 4, 'M', 0, 0, 0, 0, '2013-05-14 15:07:58', '2013-05-14 15:07:58');

--
-- Dumping data for table `drinking_weekly`
--

INSERT INTO `drinking_weekly` (`id`, `week_beginning`, `user_id`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `total`, `what_worked`, `created`, `modified`) VALUES
(1, '2013-05-13', 4, 2, 2, 2, 2, 2, 2, 2, 14, 'Good week', '2013-05-14 15:08:19', '2013-05-14 15:08:19'),
(2, '2013-05-06', 4, 5, 5, 5, 5, 5, 5, 5, 35, 'Bad week', '2013-05-14 15:08:29', '2013-05-14 15:08:29'),
(3, '2013-04-29', 4, 3, 3, 3, 3, 3, 3, 3, 21, '', '2013-05-14 15:12:36', '2013-05-14 15:12:36');

--
-- Dumping data for table `exercise_achievements`
--

INSERT INTO `exercise_achievements` (`user_id`, `best_week_so_far`, `total_minutes`, `total_full_weeks_healthy`, `consec_healthy_weeks`, `created`, `modified`) VALUES
(4, '2013-05-06 00:00:00', 420, 1, 1, '2013-05-14 15:01:20', '2013-05-14 15:01:46');

--
-- Dumping data for table `exercise_screeners`
--

INSERT INTO `exercise_screeners` (`id`, `user_id`, `vigorous_days`, `vigorous_mins`, `moderate_days`, `moderate_mins`, `walking_days`, `walking_mins`, `sedentary_mins`, `score`, `feedback`, `created`, `modified`) VALUES
(1, 4, 1, 5, 5, 5, 5, 5, 5, 223, 'LOW', '2013-05-14 15:01:00', '2013-05-14 15:01:00');

--
-- Dumping data for table `exercise_weekly`
--

INSERT INTO `exercise_weekly` (`id`, `week_beginning`, `user_id`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `total`, `created`, `modified`, `what_worked`) VALUES
(1, '2013-05-13', 4, 20, 20, 20, 20, 20, 20, 20, 140, '2013-05-14 15:01:20', '2013-05-14 15:01:20', 'Nothing at all'),
(2, '2013-05-06', 4, 30, 30, 30, 30, 30, 30, 30, 210, '2013-05-14 15:01:36', '2013-05-14 15:01:36', 'Lots'),
(3, '2013-04-29', 4, 10, 10, 10, 10, 10, 10, 10, 70, '2013-05-14 15:01:45', '2013-05-14 15:01:45', '');

--
-- Dumping data for table `fiveaday_achievements`
--

INSERT INTO `fiveaday_achievements` (`user_id`, `healthy_days_last_week`, `total_days_healthy`, `total_full_weeks_healthy`, `consec_healthy_weeks`, `created`, `modified`) VALUES
(1, 0, 1, 0, 0, '2013-05-07 21:53:18', '2013-05-07 21:53:18'),
(4, 0, 5, 0, 0, '2013-05-14 12:56:08', '2013-05-14 12:56:23');

--
-- Dumping data for table `fiveaday_screeners`
--

INSERT INTO `fiveaday_screeners` (`id`, `user_id`, `veg_often`, `veg_no`, `salad_often`, `salad_no`, `whole_fruit_often`, `whole_fruit_no`, `medium_fruit_often`, `medium_fruit_no`, `small_fruit_often`, `small_fruit_no`, `tinned_fruit_often`, `tinned_fruit_no`, `dried_fruit_often`, `dried_fruit_no`, `fruit_juice_often`, `fruit_juice_no`, `score`, `created`, `modified`) VALUES
(1, 1, 1, 2, 3, 4, 5, 5, 1, 2, 3, 4, 5, 5, 1, 2, 3, 4, 92, '2013-05-07 21:53:04', '2013-05-07 21:53:04'),
(2, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 7, 5, 0, 0, 35, '2013-05-14 12:55:41', '2013-05-14 12:55:41');

--
-- Dumping data for table `fiveaday_weekly`
--

INSERT INTO `fiveaday_weekly` (`id`, `week_beginning`, `user_id`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `total`, `what_worked`, `created`, `modified`) VALUES
(1, '2013-05-06', 1, 6, 4, 3, 2, 1, 2, 3, 21, '', '2013-05-07 21:53:18', '2013-05-07 21:53:18'),
(2, '2013-05-13', 4, 5, 3, 4, 5, 5, 5, 5, 32, 'Just testing', '2013-05-14 12:56:08', '2013-05-14 12:56:08'),
(3, '2013-05-06', 4, 3, 3, 4, 3, 3, 3, 3, 22, '', '2013-05-14 12:56:23', '2013-05-14 12:56:23');

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `version`, `type`, `parent_id`, `base_url`, `icon_url`, `module_name`, `active`, `created`, `modified`) VALUES
(1, 'Healthy Eating &ndash; &lsquo;5-a-day&rsquo;', 1, 'dashboard', 0, 'healthy_eating_module/five_a_day', '/healthy_eating_module/img/five_a_day/icon.png', 'HealthyEatingModule.FiveADay', 1, '2013-03-11 00:00:00', '2013-05-15 11:53:26'),
(2, 'Healthy Weight &ndash; Body Mass Index (BMI)', 1, 'dashboard', 0, 'healthy_weight_module/body_mass_index', '/healthy_weight_module/img/Bmi/icon.png', 'HealthyWeightModule.BodyMassIndex', 1, '2013-04-02 00:00:00', '2013-05-15 12:06:33'),
(3, 'Why am I doing this?', 1, 'widget', 0, 'motivation_module/motivation', '/motivation_module/img/icon.png', 'MotivationModule.Motivation', 1, '2013-03-27 10:57:37', '2013-05-15 12:03:43'),
(4, 'Stop Smoking', 1, 'dashboard', 0, 'stop_smoking_module/stop_smoking', '/stop_smoking_module/img/icon.png', 'StopSmokingModule.StopSmoking', 1, '2013-04-11 00:00:00', '2013-04-11 00:00:00'),
(5, 'Take Regular Exercise', 1, 'dashboard', 0, 'take_regular_exercise_module/exercise', '/take_regular_exercise_module/img/icon.png', 'TakeRegularExerciseModule.Exercise', 1, '2013-04-11 10:57:37', '2013-04-11 10:58:20'),
(6, 'Drink Safely', 1, 'dashboard', 0, 'drink_safely_module/drinking', '/drink_safely_module/img/drinking/icon.png', 'DrinkSafelyModule.Drinking', 1, '2013-04-16 00:00:00', '2013-05-15 11:37:35'),
(7, 'Example module &ndash; simple health test', 1, 'dashboard', 0, 'example_module/simple_health_test', '/example_module/img/icon.png', 'ExampleModule.SimpleHealthTest', 1, '2013-02-22 23:38:26', '2013-02-22 23:38:26');

--
-- Dumping data for table `module_users`
--

INSERT INTO `module_users` (`id`, `user_id`, `module_id`, `position`, `created`, `modified`) VALUES
(1, 1, 6, 1, '2013-05-05 08:48:09', '2013-05-05 08:48:09'),
(2, 1, 4, 2, '2013-05-05 09:00:29', '2013-05-05 09:00:29'),
(3, 1, 1, 3, '2013-05-07 21:53:04', '2013-05-07 21:53:04'),
(4, 4, 1, 1, '2013-05-14 12:55:41', '2013-05-14 12:55:41'),
(5, 4, 2, 2, '2013-05-14 13:10:12', '2013-05-14 13:10:12'),
(6, 4, 4, 3, '2013-05-14 13:22:34', '2013-05-14 13:22:34'),
(7, 4, 5, 4, '2013-05-14 15:01:00', '2013-05-14 15:01:00'),
(8, 4, 6, 5, '2013-05-14 15:07:58', '2013-05-14 15:07:58'),
(9, 4, 7, 6, '2013-05-14 15:15:17', '2013-05-14 15:15:17');

--
-- Dumping data for table `motivation_screeners`
--

INSERT INTO `motivation_screeners` (`id`, `user_id`, `reason`, `created`, `modified`) VALUES
(1, 1, 'It sounds like a good idea', '2013-05-14 13:24:45', '2013-05-14 13:24:45'),
(2, 4, 'Here''s a test', '2013-05-14 13:40:40', '2013-05-14 13:40:40');

--
-- Dumping data for table `news`
--


--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `user_id`, `name`, `gender`, `date_of_birth`, `height_cm`, `post_code`, `mobile_no`, `created`, `modified`) VALUES
(1, 1, 'Andy', 'M', '1974-03-01', 170, 'CF14 9XX', '07479999999', '2013-03-02 09:45:04', '2013-03-07 15:26:41'),
(2, 2, 'Dave Burton', 'M', '1980-03-08', 170, 'CF14 9XX', '07479999999', '2013-03-08 11:26:53', '2013-03-08 11:26:55'),
(3, 4, 'Test User', 'M', '1995-04-27', 178, 'CF14 9XX', '07479999999', '2013-04-27 10:40:41', '2013-04-27 10:41:48'),
(4, 3, 'Test Admin', 'F', '1960-09-09', 165, 'CF14 9XX', '07479999999', '2013-04-27 10:43:29', '2013-04-27 10:43:29');

--
-- Dumping data for table `simple_health_test_achievements`
--

INSERT INTO `simple_health_test_achievements` (`user_id`, `healthy_days_last_week`, `total_days_healthy`, `total_full_weeks_healthy`, `consec_healthy_weeks`, `created`, `modified`) VALUES
(4, 0, 7, 1, 0, '2013-05-14 15:15:29', '2013-05-14 15:15:41');

--
-- Dumping data for table `simple_health_test_screeners`
--

INSERT INTO `simple_health_test_screeners` (`id`, `user_id`, `healthy`, `score`, `created`, `modified`) VALUES
(1, 4, 'Y', 100, '2013-05-14 15:15:17', '2013-05-14 15:15:17');

--
-- Dumping data for table `simple_health_test_weekly`
--

INSERT INTO `simple_health_test_weekly` (`id`, `week_beginning`, `user_id`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `total`, `what_worked`, `created`, `modified`) VALUES
(1, '2013-05-13', 4, 7, 7, 7, 7, 7, 7, 7, 49, '', '2013-05-14 15:15:29', '2013-05-14 15:15:29'),
(2, '2013-05-06', 4, 5, 5, 5, 5, 5, 5, 5, 35, '', '2013-05-14 15:15:35', '2013-05-14 15:15:35'),
(3, '2013-04-29', 4, 2, 2, 2, 2, 2, 2, 2, 14, '', '2013-05-14 15:15:41', '2013-05-14 15:15:41');

--
-- Dumping data for table `stop_smoking_achievements`
--

INSERT INTO `stop_smoking_achievements` (`user_id`, `healthy_days_last_week`, `total_days_healthy`, `total_full_weeks_healthy`, `consec_healthy_weeks`, `created`, `modified`) VALUES
(1, 0, 7, 1, 0, '2013-05-05 22:04:59', '2013-05-05 22:04:59'),
(4, 6, 18, 1, 0, '2013-05-14 13:22:49', '2013-05-14 13:23:09');

--
-- Dumping data for table `stop_smoking_screeners`
--

INSERT INTO `stop_smoking_screeners` (`id`, `user_id`, `smoker`, `how_many`, `first_cig`, `diff_non_smoking`, `most_hate`, `more_morning`, `smoke_in_bed`, `score`, `created`, `modified`) VALUES
(1, 1, 'Y', 0, 3, 0, 1, 0, 0, 4, '2013-05-05 09:00:29', '2013-05-05 09:00:29'),
(2, 4, 'Y', 0, 2, 1, 1, 0, 1, 5, '2013-05-14 13:22:34', '2013-05-14 13:22:34');

--
-- Dumping data for table `stop_smoking_weekly`
--

INSERT INTO `stop_smoking_weekly` (`id`, `week_beginning`, `user_id`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `total`, `what_worked`, `created`, `modified`) VALUES
(1, '2013-04-29', 1, 1, 1, 1, 1, 1, 1, 1, 7, '', '2013-05-05 22:04:59', '2013-05-05 22:04:59'),
(2, '2013-05-13', 4, 1, 1, 0, 1, 1, 1, 0, 5, '', '2013-05-14 13:22:49', '2013-05-14 13:22:49'),
(3, '2013-05-06', 4, 1, 1, 1, 1, 1, 0, 1, 6, '', '2013-05-14 13:22:57', '2013-05-14 13:22:57'),
(4, '2013-04-29', 4, 1, 1, 1, 1, 1, 1, 1, 7, '', '2013-05-14 13:23:09', '2013-05-14 13:23:09');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`, `created`, `modified`) VALUES
(1, 'andy@itsallnice-digital.co.uk', '27bf973165c423667ae19848570a56a28f9c4567', 'super-admin', '2013-02-22 22:46:20', '2013-03-07 15:26:41'),
(2, 'david.burton@doivedesigns.co.uk', '679f61ec0a883203ec173b54fd66275fefa0df71', 'super-admin', '2013-02-22 22:55:25', '2013-02-22 22:55:25'),
(3, 'test-admin@example.com', '27bf973165c423667ae19848570a56a28f9c4567', 'admin', '2013-02-22 22:57:01', '2013-02-22 22:57:01'),
(4, 'test-user@example.com', '27bf973165c423667ae19848570a56a28f9c4567', 'user', '2013-02-22 22:57:18', '2013-02-22 22:57:18');
