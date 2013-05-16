SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

INSERT INTO `modules` (`id`, `name`, `version`, `type`, `parent_id`, `base_url`, `icon_url`, `module_name`, `active`, `created`, `modified`) VALUES
(1, 'Healthy Eating &ndash; &lsquo;5-a-day&rsquo;', '1', 'dashboard', 0, 'healthy_eating_module/five_a_day', 'healthy_eating_module/img/five_a_day/icon.png', 'HealthyEatingModule.FiveADay', 1, '2013-03-11 00:00:00', '2013-03-11 00:00:00'),
(2, 'Healthy Weight &ndash; Body Mass Index (BMI)', '1', 'dashboard', 0, 'healthy_weight_module/body_mass_index', 'healthy_weight_module/img/Bmi/icon.png', 'HealthyWeightModule.BodyMassIndex', 1, '2013-04-02 00:00:00', '2013-04-02 00:00:00'),
(3, 'Why am I doing this?', '1', 'widget', 0, 'motivation_module/motivation', 'motivation_module/img/icon.png', 'MotivationModule.Motivation', 1, '2013-03-27 10:57:37', '2013-03-27 10:58:20'),
(4, 'Stop Smoking', '1', 'dashboard', 0, 'stop_smoking_module/stop_smoking', 'stop_smoking_module/img/icon.png', 'StopSmokingModule.StopSmoking', 1, '2013-04-11 00:00:00', '2013-04-11 00:00:00'),
(5, 'Take Regular Exercise', '1', 'dashboard', 0, 'take_regular_exercise_module/exercise', 'take_regular_exercise_module/img/icon.png', 'TakeRegularExerciseModule.Exercise', 1, '2013-04-11 10:57:37', '2013-04-11 10:58:20'),
(6, 'Drink Safely', '1', 'dashboard', 0, 'drink_safely_module/drinking', 'drink_safely_module/img/drinking/icon.png', 'DrinkSafelyModule.Drinking', 1, '2013-04-16 00:00:00', '2013-04-16 00:00:00'),
(7, 'Example module &ndash; simple health test', '1', 'dashboard', 0, 'example_module/simple_health_test', 'example_module/img/icon.png', 'ExampleModule.SimpleHealthTest', 1, '2013-02-22 23:38:26', '2013-02-22 23:38:26');

INSERT INTO `profile` (`id`, `user_id`, `name`, `gender`, `date_of_birth`, `height_cm`, `post_code`, `mobile_no`, `created`, `modified`) VALUES
(1, 1, 'Andy', 'M', '1974-03-01', 170, 'CF14 9XX', '0747999999', '2013-03-02 09:45:04', '2013-03-07 15:26:41'),
(2, 2, 'Dave Burton', 'M', '1980-03-08', 170, 'CF14 9XX', NULL, '2013-03-08 11:26:53', '2013-03-08 11:26:55'),
(3, 4, 'Test User', 'M', '1995-04-27', 178, '', '', '2013-04-27 10:40:41', '2013-04-27 10:41:48'),
(4, 3, 'Test Admin', 'F', '1960-09-09', 165, '', '', '2013-04-27 10:43:29', '2013-04-27 10:43:29');

INSERT INTO `users` (`id`, `email`, `password`, `role`, `created`, `modified`) VALUES
(1, 'andy@itsallnice-digital.co.uk', '27bf973165c423667ae19848570a56a28f9c4567', 'super-admin', '2013-02-22 22:46:20', '2013-03-07 15:26:41'),
(2, 'david.burton@doivedesigns.co.uk', '679f61ec0a883203ec173b54fd66275fefa0df71', 'super-admin', '2013-02-22 22:55:25', '2013-02-22 22:55:25'),
(3, 'test-admin@example.com', '27bf973165c423667ae19848570a56a28f9c4567', 'admin', '2013-02-22 22:57:01', '2013-02-22 22:57:01'),
(4, 'test-user@example.com', '27bf973165c423667ae19848570a56a28f9c4567', 'user', '2013-02-22 22:57:18', '2013-02-22 22:57:18');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
