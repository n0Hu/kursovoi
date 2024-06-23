CREATE TABLE `users` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `email` varchar(191) UNIQUE NOT NULL,
  `nickname` varchar(191) UNIQUE NOT NULL,
  `password` varchar(255) NOT NULL,
  `isConfirm` tinyint(1) NOT NULL DEFAULT 0,
  `surname` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `middle_name` varchar(255),
  `gender` tinyint(1) NOT NULL,
  `age` int(11)
);

CREATE TABLE `temp_urn_for_accept_account` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(11) UNIQUE NOT NULL,
  `urn` varchar(255) NOT NULL
);

CREATE TABLE `weight_user` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `date` varchar(255) NOT NULL
);

CREATE TABLE `calories_user` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `nutrition` varchar(255) NOT NULL,
  `calories` int(11) NOT NULL,
  `proteins` int(11),
  `fats` int(11),
  `carbohydrates` int(11),
  `date` varchar(255) NOT NULL
);

CREATE TABLE `history_visit_gym` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL
);

CREATE TABLE `type_activities` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(191) UNIQUE NOT NULL
);

INSERT INTO `type_activities`(id, name)
VALUES
    (1, 'Бег'),
    (2, 'Силовые упражнения');

CREATE TABLE `trainers` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `type_activity_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL
);

INSERT INTO `trainers`(type_activity_id, name)
VALUES
    (1, 'Беговая дорожка'),
    (2, 'Глют-машина'),
    (2, 'Тренажер комбинированная тяга'),
    (2, 'Баттерфляй');

CREATE TABLE `history_activity_gym` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type_activity_id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `calories` int(11) NOT NULL,
  `date` varchar(255) NOT NULL
);

ALTER TABLE `temp_urn_for_accept_account` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `weight_user` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `calories_user` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `history_visit_gym` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `trainers` ADD FOREIGN KEY (`type_activity_id`) REFERENCES `type_activities` (`id`);

ALTER TABLE `trainers` ADD CONSTRAINT uc_type_and_name UNIQUE (type_activity_id, name);

ALTER TABLE `history_activity_gym` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `history_activity_gym` ADD FOREIGN KEY (`type_activity_id`) REFERENCES `type_activities` (`id`);

ALTER TABLE `history_activity_gym` ADD FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`);
