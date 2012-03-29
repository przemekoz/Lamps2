CREATE TABLE `mss`.`background` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY
) ENGINE = MYISAM ;


CREATE TABLE `merge_column_crown` (
  `id_column` INT(11) NOT NULL DEFAULT '0',
  `id_crown` INT(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `NewIndex1` (`id_column`,`id_crown`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

CREATE TABLE `merge_column_fitting` (
  `id_column` INT(11) NOT NULL DEFAULT '0',
  `id_fitting` INT(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `NewIndex1` (`id_column`,`id_fitting`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci

CREATE TABLE `merge_crown_fitting` (
  `id_crown` INT(11) NOT NULL DEFAULT '0',
  `id_fitting` INT(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `NewIndex1` (`id_crown`,`id_fitting`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;