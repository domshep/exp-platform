SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


INSERT INTO `modules` (`id`, `name`, `version`, `type`, `parent_id`, `base_url`, `icon_url`, `created`, `modified`) VALUES
(1, 'Healthy Eating &ndash; &lsquo;5-a-day&rsquo;', 1, 'daily', 0, 'healthy_eating_module/five_a_day', 'healthy_eating_module/img/five_a_day/icon.png', '2013-03-11 00:00:00', '2013-03-11 00:00:00'),
(2, 'Dave&apos;s module', 1, 'daily', 0, 'dave_module/daves', 'dave_module/img/icon.png', '2013-03-08 10:01:31', '2013-03-08 10:01:34'),
(3, 'Test module', 1, 'weekly', 0, 'test_module/tests', 'test_module/img/icon.png', '2013-02-22 23:38:26', '2013-02-22 23:38:26');

INSERT INTO `modules_users` (`id`, `user_id`, `module_id`, `position`, `created`, `modified`) VALUES
(1, 1, 1, 1, '2013-03-01 00:00:00', '2013-03-01 00:00:00'),
(2, 2, 1, 1, '2013-03-01 00:00:00', '2013-03-01 00:00:00'),
(3, 4, 1, 1, '2013-03-01 00:00:00', '2013-03-01 00:00:00'),
(4, 1, 2, 2, '2013-03-08 10:54:04', '2013-03-08 10:54:07'),
(5, 2, 2, 2, '2013-03-08 11:25:35', '2013-03-08 11:25:37');

INSERT INTO `news` (`id`, `headline`, `article`, `created`, `modified`) VALUES
(1, 'my news article edited', 0x7465737420656469746564, '2013-03-14 18:37:06', '2013-03-15 09:14:36');

INSERT INTO `profile` (`id`, `user_id`, `name`, `gender`, `date_of_birth`, `height_cm`, `post_code`, `mobile_no`, `created`, `modified`) VALUES
(1, 1, 'Andy', 'M', '1974-03-01', 170, 'CF14 9XX', '0747999999', '2013-03-02 09:45:04', '2013-03-07 15:26:41'),
(2, 2, 'Dave Burton', 'M', '1980-03-08', 170, 'CF14 9XX', NULL, '2013-03-08 11:26:53', '2013-03-08 11:26:55');

INSERT INTO `users` (`id`, `email`, `password`, `role`, `created`, `modified`) VALUES
(1, 'andy@itsallnice-digital.co.uk', '27bf973165c423667ae19848570a56a28f9c4567', 'super-admin', '2013-02-22 22:46:20', '2013-03-07 15:26:41'),
(2, 'david.burton@doivedesigns.co.uk', '679f61ec0a883203ec173b54fd66275fefa0df71', 'super-admin', '2013-02-22 22:55:25', '2013-02-22 22:55:25'),
(3, 'test-admin@example.com', '27bf973165c423667ae19848570a56a28f9c4567', 'admin', '2013-02-22 22:57:01', '2013-02-22 22:57:01'),
(4, 'test-user@example.com', '27bf973165c423667ae19848570a56a28f9c4567', 'user', '2013-02-22 22:57:18', '2013-02-22 22:57:18');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
