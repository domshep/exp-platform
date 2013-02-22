SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


INSERT INTO `modules` (`id`, `name`, `version`, `type`, `parent_id`, `created`, `modified`) VALUES
(1, 'test', 1, 'one-time', 0, '2013-02-22 23:38:26', '2013-02-22 23:38:26');


INSERT INTO `users` (`id`, `email`, `password`, `role`, `created`, `modified`) VALUES
(1, 'andy@itsallnice-digital.co.uk', '679f61ec0a883203ec173b54fd66275fefa0df71', 'super-admin', '2013-02-22 22:46:20', '2013-02-22 22:59:02'),
(2, 'david.burton@doivedesigns.co.uk', '679f61ec0a883203ec173b54fd66275fefa0df71', 'super-admin', '2013-02-22 22:55:25', '2013-02-22 22:55:25'),
(3, 'test-admin@example.com', '27bf973165c423667ae19848570a56a28f9c4567', 'admin', '2013-02-22 22:57:01', '2013-02-22 22:57:01'),
(4, 'test-user@example.com', '27bf973165c423667ae19848570a56a28f9c4567', 'user', '2013-02-22 22:57:18', '2013-02-22 22:57:18');
