CREATE TABLE `tokens` (
`id`                  BIGINT(22) UNSIGNED AUTO_INCREMENT,
`token`               VARCHAR(32),
`timestamp`           TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
`apikey`			  VARCHAR(32),
`userid`			  VARCHAR(32),
PRIMARY KEY (id)
)
