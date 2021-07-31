USE `webapp_php_sample`;
-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `iplogg`
--

CREATE TABLE ipLogg
(
    IPID     varchar(256) CHARACTER SET utf8 NOT NULL,
    info     text,
    clientIP VARCHAR(500),
    publicIP VARCHAR(500),
    TS       TIME,
    DT       DATE,
    PRIMARY KEY (IPID)
);


--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE usr
(
    UID       varchar(256) CHARACTER SET utf8 NOT NULL,
    userName  text CHARACTER SET utf8 NOT NULL,
    firstName text CHARACTER SET utf8 NOT NULL,
    lastName  text CHARACTER SET utf8 NOT NULL,
    email     text CHARACTER SET utf8 NOT NULL,
    userRank  text CHARACTER SET utf8 NOT NULL,
    age       date                    NOT NULL,
    PRIMARY KEY (UID)
);



--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE passWd
(
    PWID     varchar(256) CHARACTER SET utf8 NOT NULL,
    UID      varchar(256) CHARACTER SET utf8 NOT NULL,
    passwort text(256) NOT NULL,
    PRIMARY KEY (PWID),
    CONSTRAINT FK_UID FOREIGN KEY (UID) REFERENCES usr (UID)
);



--
-- Tabellenstruktur für Tabelle `migrations`
--

CREATE TABLE migrations
(
    MID           int(11)   NOT NULL auto_increment,
    migrationName text(256) NOT NULL,
    TS            TIME,
    DT            DATE,
    PRIMARY KEY (MID)
);



-- --------------------------------------------------------

--
-- Einfügen des Admin Acounts
--

INSERT INTO usr (UID, userName, firstName, lastName, email, userRank, age)
VALUES ('edcc170a-df17-4bc8-843e-5505695a48ce', 'Admin', 'Admin', 'Admin', 'admin@email.de', 'Admin', '1997-03-06'),
       ('f8c48d52-7379-4f8a-84bb-2b7f33a0dc53', 'Tester1', 'Tester1', 'Tester1', 'test1@email.de', 'User', '1997-03-06')
;

--
-- Einfügen des Temporären, gehashten Admin Passworts
--

INSERT INTO passWd (PWID, UID, passwort)
VALUES ('a75b1405-dc25-4704-9a13-6e4329543336', 'edcc170a-df17-4bc8-843e-5505695a48ce', '$2y$10$BtaQ1/t3pcDlT1kRb8j79eeSGpW0QINqG6vEtwvvKk17o1ASn7vaq'),
       ('b3464adb-80b6-4b5a-93d1-0632448d423c', 'f8c48d52-7379-4f8a-84bb-2b7f33a0dc53', '$2y$10$BFL5Qd.ETHD9KvADTQ3o8OHbXBvLJJJSzmvFkS8P76.bPrYz4mrQ6')
;

