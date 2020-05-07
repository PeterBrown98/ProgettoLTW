DROP TABLE IF EXISTS users_table;

CREATE TABLE users_table (
    id serial NOT NULL,
    name character varying(50) NOT NULL
);

INSERT INTO users_table VALUES (1, 'Steven');
INSERT INTO users_table VALUES (2, 'Sally');
INSERT INTO users_table VALUES (3, 'Reggie');