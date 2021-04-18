CREATE TABLE `user` (
  `ID` int(11)  PRIMARY KEY AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` char(60) NOT NULL,
  `name` varchar(255) NOT NULL
);


INSERT INTO `user` (`email`, `password`, `name`) VALUES ('testuser@vcu.edu', '$2y$10$3mOG26x704YtQq5Q/SGo2OlHm9IUDEoLaOGUUh7C8RcJCiovVSY2S', 'Test User');
INSERT INTO `user` (`email`, `password`, `name`) VALUES ('testuser@vcu.edu', '$2y$10$3mOG26x704YtQq5Q/SGo2OlHm9IUDEoLaOGUUh7C8RcJCiovVSY2S', 'Test User 2');

-- Use https://phppasswordhash.com/ to generate the hash for the password