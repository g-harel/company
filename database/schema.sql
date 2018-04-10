CREATE TABLE identities (
    `id`       CHAR(16)    NOT NULL,
    `sin`      CHAR(9)     NOT NULL,
    `name`     VARCHAR(32) NOT NULL,
    `birthday` DATE        NOT NULL,
    `gender`   CHAR(1)     NOT NULL,
    --
    PRIMARY KEY (`id`),
    CONSTRAINT uq_sin UNIQUE (`sin`)
);

CREATE TABLE departments (
    `id`   CHAR(16)    NOT NULL,
    `name` VARCHAR(32) NOT NULL,
    --
    PRIMARY KEY (`id`),
    CONSTRAINT uq_name UNIQUE (`name`)
);

CREATE TABLE employees (
    `iid`        CHAR(16)      NOT NULL,
    `did`        CHAR(16)      NOT NULL,
    `supervisor` CHAR(16),
    `address`    VARCHAR(64)   NOT NULL,
    `phone`      VARCHAR(32)   NOT NULL,
    `hourly`     DECIMAL(16,2) NOT NULL,
    --
    PRIMARY KEY (`iid`),
    FOREIGN KEY (`iid`)        REFERENCES identities (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`did`)        REFERENCES departments (`id`),
    FOREIGN KEY (`supervisor`) REFERENCES employees (`iid`)
);

CREATE TABLE dependents (
    `iid` CHAR(16) NOT NULL,
    `eid` CHAR(16) NOT NULL,
    --
    PRIMARY KEY (`iid`),
    FOREIGN KEY (`iid`) REFERENCES identities (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`eid`) REFERENCES employees (`iid`) ON DELETE CASCADE
);

CREATE TABLE managers (
    `eid`   CHAR(16) NOT NULL,
    `did`   CHAR(16) NOT NULL,
    `start` DATE NOT NULL,
    --
    PRIMARY KEY (`eid`, `did`),
    FOREIGN KEY (`eid`) REFERENCES employees (`iid`),
    FOREIGN KEY (`did`) REFERENCES departments (`id`),
    CONSTRAINT uq_did UNIQUE (`did`)
);

CREATE TABLE locations (
    `id`       CHAR(16)    NOT NULL,
    `did`      CHAR(16)    NOT NULL,
    `location` VARCHAR(32) NOT NULL,
    --
    PRIMARY KEY (`id`),
    FOREIGN KEY (`did`) REFERENCES departments (`id`)
);

CREATE TABLE projects (
    `id`    CHAR(16)    NOT NULL,
    `did`   CHAR(16)    NOT NULL,
    `lid`   CHAR(16)    NOT NULL,
    `name`  VARCHAR(32) NOT NULL,
    `lead`  CHAR(16)    NOT NULL,
    `stage` TINYINT     NOT NULL,
    --
    PRIMARY KEY (`id`),
    FOREIGN KEY (`did`)  REFERENCES departments (`id`),
    FOREIGN KEY (`lid`)  REFERENCES locations (`id`),
    FOREIGN KEY (`lead`) REFERENCES employees (`iid`),
    CONSTRAINT uq_name UNIQUE (`name`)
);

CREATE TABLE assignments (
    `eid`        CHAR(16)       NOT NULL,
    `pid`        CHAR(16)       NOT NULL,
    `hours`      DECIMAL(16, 2) NOT NULL,
    --
    PRIMARY KEY (`eid`, `pid`),
    FOREIGN KEY (`eid`) REFERENCES employees (`iid`) ON DELETE CASCADE,
    FOREIGN KEY (`pid`) REFERENCES projects (`id`) ON DELETE CASCADE
);
