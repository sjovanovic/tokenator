CREATE TABLE `DB_NAME`.`tokens` (
`id`                  BIGINT(22) UNSIGNED AUTO_INCREMENT,
`token`               VARCHAR(32),
`timestamp`           TIMESTAMP DEFAULT NOW(),
PRIMARY KEY (id)
)
