-- Ceylon Tea cloud

CREATE DATABASE ceylonteacloud;
use ceylonteacloud;

-- -----------------------------------------
-- Owner
CREATE TABLE IF NOT EXISTS Owner
(
    owner_id int          NOT NULL AUTO_INCREMENT,
    name     VARCHAR(255) NOT NULL,
    email    VARCHAR(320) NOT NULL,
    tele     int          NOT NULL,
    PRIMARY KEY (owner_id)

);

-- factory-owner-map
CREATE TABLE IF NOT EXISTS factory_owner_map
(
    factory_id int NOT NULL,
    owner_id   int NOT NULL,
    CONSTRAINT Pk_factoryownermap PRIMARY KEY (factory_id, owner_id)

);

-- Factory

CREATE TABLE IF NOT EXISTS Factory
(
    factory_id int          NOT NULL AUTO_INCREMENT,
    name       VARCHAR(255) NOT NULL,
    date       DATETIME     NOT NULL,
    actSTatus  BOOLEAN      NOT NULL,
    address    VARCHAR(700) NOT NULL,
    contactNo  int          NOT NULL,
    PRIMARY KEY (factory_id)
);

-- member-report-map
CREATE TABLE IF NOT EXISTS member_report_map
(
    member_id int NOT NULL,
    report_id int NOT NULL,
    CONSTRAINT Pk_memberreportmap PRIMARY KEY (member_id, report_id)

);

-- monthly_report
CREATE TABLE IF NOT EXISTS monthly_report
(
    report_id                  int      NOT NULL AUTO_INCREMENT,
    date                       DATETIME NOT NULL,
    total_weight               float    NOT NULL,
    total_deducation_per_month float    NOT NULL,
    price_of_1kg               DECIMAL(10, 2),
    total_price                float    NOT NULL,
    payment                    DECIMAL(10, 2),
    PRIMARY KEY (report_id)
);

-- data_input
CREATE TABLE IF NOT EXISTS data_input
(
    data_id         int      NOT NULL AUTO_INCREMENT,
    number_of_sacks int      NOT NULL,
    total_weight    float    NOT NULL,
    member_id       int      NOT NULL,
    date            DATETIME NOT NULL,
    PRIMARY KEY (data_id)

);

-- member_data_input_map

CREATE TABLE IF NOT EXISTS member_data_input_map
(
    member_id int NOT NULL,
    data_id   int NOT NULL,
    CONSTRAINT Pk_memberdatainputmap PRIMARY KEY (member_id, data_id)

);
-- member
CREATE TABLE IF NOT EXISTS member
(
    member_id  int NOT NULL AUTO_INCREMENT,
    factory_id int NOT NULL,
    grower_id  int NOT NULL,

    PRIMARY KEY (member_id)

);

-- member_request_map


CREATE TABLE IF NOT EXISTS member_request_map
(
    member_id int NOT NULL,
    req_id    int NOT NULL,
    CONSTRAINT Pk_memberrequestmap PRIMARY KEY (member_id, req_id)

);

-- data_input_dedication_map
CREATE TABLE IF NOT EXISTS data_input_dedication_map
(
    data_id      int NOT NULL,
    deduction_id int NOT NULL,
    CONSTRAINT Pk_memberinputdedicationmap PRIMARY KEY (data_id, deduction_id)

);

-- net_weight
CREATE TABLE IF NOT EXISTS net_weight
(
    id           int AUTO_INCREMENT,
    data_id      int   NOT NULL,
    deduction_id int   NOT NULL,
    weight       float NOT NULL,
    PRIMARY KEY (id)
);

-- grower
CREATE TABLE IF NOT EXISTS grower
(
    id          int AUTO_INCREMENT,
    name        VARCHAR(255) NOT NULL,
    reg_date    DATETIME     NOT NULL,
    status      BOOLEAN      NOT NULL,
    email       VARCHAR(320) NOT NULL,
    tele        int          NOT NULL,
    address     VARCHAR(700) NOT NULL,
    profileLink VARCHAR(700) NOT NULL,

    PRIMARY KEY (id)
);

-- request
CREATE TABLE IF NOT EXISTS request
(
    req_id      int      NOT NULL AUTO_INCREMENT,
    req_date    DATETIME NOT NULL,
    accept_date DATETIME NOT NULL,
    status      BOOLEAN  NOT NULL,
    issued_date DATETIME NOT NULL,


    PRIMARY KEY (req_id)
);

-- deduction

CREATE TABLE IF NOT EXISTS deduction
(
    ded_id              int   NOT NULL AUTO_INCREMENT,
    sack_waight         float NOT NULL,
    non_standard_leaves float NOT NULL,
    ded_total           float NOT NULL,
    PRIMARY KEY (ded_id)


);

-- req_loan_map
CREATE TABLE IF NOT EXISTS req_loan_map
(
    req_id  int NOT NULL,
    loan_id int NOT NULL,
    CONSTRAINT Pk_recloanmap PRIMARY KEY (req_id, loan_id)
);

-- req_fertilizer_map

CREATE TABLE IF NOT EXISTS req_fertilizer_map
(
    req_id        int NOT NULL,
    fertilizer_id int NOT NULL,
    CONSTRAINT Pk_recfertilizermap PRIMARY KEY (req_id, fertilizer_id)
);


-- req_tea_map
CREATE TABLE IF NOT EXISTS req_tea_map
(
    req_id int NOT NULL,
    tea_id int NOT NULL,
    CONSTRAINT Pk_recteamap PRIMARY KEY (req_id, tea_id)
);


-- deduction_other_map
CREATE TABLE IF NOT EXISTS deduction_other_map
(
    ded_id       int NOT NULL,
    ded_other_id int NOT NULL,
    CONSTRAINT Pk_deductionothermap PRIMARY KEY (ded_id, ded_other_id)
);

-- deduction_others

CREATE TABLE IF NOT EXISTS deduction_others
(
    ded_other_id int          NOT NULL AUTO_INCREMENT,
    reason       VARCHAR(850) NOT NULL,
    price        DECIMAL(10, 2),
    PRIMARY KEY (ded_other_id)


);

-- loan


CREATE TABLE IF NOT EXISTS loan
(
    loan_id                 int   NOT NULL AUTO_INCREMENT,
    amount                  float NOT NULL,
    number_of_months_to_pay int   NOT NULL,
    monthly_ded             float NOT NULL,
    PRIMARY KEY (loan_id)


);

-- fertilizer

CREATE TABLE IF NOT EXISTS fertilizer
(
    fertilizer_id     int          NOT NULL AUTO_INCREMENT,
    type              VARCHAR(350) NOT NULL,
    amount            float        NOT NULL,
    date_wanted       DATETIME     NOT NULL,
    price             DECIMAL(10, 2),
    number_of_months  int          NOT NULL,
    monthly_deduction float        NOT NULL,
    PRIMARY KEY (fertilizer_id)


);

-- Tea

CREATE TABLE IF NOT EXISTS tea
(
    tea_id                  int          NOT NULL AUTO_INCREMENT,
    type                    VARCHAR(350) NOT NULL,
    amount                  float        NOT NULL,
    price                   DECIMAL(10, 2),
    date_wanted             DATETIME     NOT NULL,
    number_of_months_to_pay int          NOT NULL,
    monthly_ded             float        NOT NULL,
    PRIMARY KEY (tea_id)


);

-- ------------------------------------------------------------------------

-- modified grower status column
ALTER TABLE grower
    DROP COLUMN status;
ALTER TABLE grower
    ADD active_status BOOLEAN NOT NULL DEFAULT 0;

ALTER TABLE owner
    DROP COLUMN name;
ALTER TABLE owner
    ADD owner_name VARCHAR(255) NOT NULL;

ALTER TABLE owner
    ADD pwd VARCHAR(512) NOT NULL;

ALTER TABLE owner
    ADD actSTatus BOOLEAN NOT NULL DEFAULT 0;

ALTER TABLE owner
    RENAME TO company_owner;

CREATE TABLE IF NOT EXISTS owner_session
(
    owner_id       int          NOT NULL,
    session_id     varchar(100) NOT NULL,
    session_expire DATETIME     NOT NULL,
    PRIMARY KEY (owner_id)
);

-- -----------------------------------------------------------------
-- foreign keys

ALTER TABLE factory_owner_map
    ADD FOREIGN KEY (owner_id) REFERENCES company_owner (owner_id);

ALTER TABLE factory_owner_map
    ADD FOREIGN KEY (factory_id) REFERENCES factory (factory_id);

ALTER TABLE member
    ADD FOREIGN KEY (grower_id) REFERENCES grower (id);

ALTER TABLE member
    ADD FOREIGN KEY (factory_id) REFERENCES factory (factory_id);

ALTER TABLE member_data_input_map
    ADD FOREIGN KEY (member_id) REFERENCES member (member_id);

ALTER TABLE member_data_input_map
    ADD FOREIGN KEY (data_id) REFERENCES data_input (data_id);

ALTER TABLE member_request_map
    ADD FOREIGN KEY (member_id) REFERENCES member (member_id);

ALTER TABLE member_report_map
    ADD FOREIGN KEY (member_id) REFERENCES member (member_id);

ALTER TABLE member_report_map
    ADD FOREIGN KEY (report_id) REFERENCES monthly_report (report_id);

ALTER TABLE member_request_map
    ADD FOREIGN KEY (req_id) REFERENCES request (req_id);

ALTER TABLE req_tea_map
    ADD FOREIGN KEY (req_id) REFERENCES request (req_id);

ALTER TABLE req_fertilizer_map
    ADD FOREIGN KEY (req_id) REFERENCES request (req_id);

ALTER TABLE req_loan_map
    ADD FOREIGN KEY (req_id) REFERENCES request (req_id);

ALTER TABLE req_loan_map
    ADD FOREIGN KEY (loan_id) REFERENCES loan (loan_id);

ALTER TABLE req_fertilizer_map
    ADD FOREIGN KEY (fertilizer_id) REFERENCES fertilizer (fertilizer_id);

ALTER TABLE req_tea_map
    ADD FOREIGN KEY (tea_id) REFERENCES tea (tea_id);

ALTER TABLE net_weight
    ADD FOREIGN KEY (data_id) REFERENCES data_input (data_id);

ALTER TABLE net_weight
    ADD FOREIGN KEY (deduction_id) REFERENCES deduction_others (ded_other_id);

ALTER TABLE data_input_dedication_map
    ADD FOREIGN KEY (data_id) REFERENCES data_input (data_id);

ALTER TABLE data_input_dedication_map
    ADD FOREIGN KEY (deduction_id) REFERENCES deduction (ded_id);

ALTER TABLE deduction_other_map
    ADD FOREIGN KEY (ded_id) REFERENCES deduction (ded_id);

ALTER TABLE deduction_other_map
    ADD FOREIGN KEY (ded_other_id) REFERENCES deduction_others (ded_other_id);

-- -----------------------------------------------------------------------------------------------
-- tea type table
CREATE TABLE IF NOT EXISTS tea_type
(
    type_id      INT AUTO_INCREMENT,
    tea_type     VARCHAR(255)   NOT NULL,
    price_of_1kg DECIMAL(10, 2) NOT NULL,
    PRIMARY KEY (type_id)
);

ALTER TABLE tea
    DROP COLUMN type;

CREATE TABLE IF NOT EXISTS fertilizer_type
(
    type_id         INT AUTO_INCREMENT,
    fertilizer_type VARCHAR(255)   NOT NULL,
    price_of_1kg    DECIMAL(10, 2) NOT NULL,
    PRIMARY KEY (type_id)
);

ALTER TABLE fertilizer
    DROP COLUMN type;

CREATE TABLE IF NOT EXISTS tea_request
(
    type_id     INT AUTO_INCREMENT,
    request_id  INT            NOT NULL,
    tea_type_id INT            NOT NULL,
    item_price  DECIMAL(10, 2) NOT NULL,
    PRIMARY KEY (type_id)
);

CREATE TABLE IF NOT EXISTS fertilizer_request
(
    type_id            INT AUTO_INCREMENT,
    request_id         INT            NOT NULL,
    fertilizer_type_id INT            NOT NULL,
    item_price         DECIMAL(10, 2) NOT NULL,
    PRIMARY KEY (type_id)
);

ALTER TABLE tea_request
    ADD FOREIGN KEY (request_id) REFERENCES tea (tea_id);

ALTER TABLE fertilizer_request
    ADD FOREIGN KEY (request_id) REFERENCES fertilizer (fertilizer_id);

ALTER TABLE tea_request
    ADD FOREIGN KEY (tea_type_id) REFERENCES tea_type (type_id);

ALTER TABLE fertilizer_request
    ADD FOREIGN KEY (fertilizer_type_id) REFERENCES fertilizer_type (type_id);

-- -------------------------------------------------------------------------------------
-- added colum to add amout of the tea and fertilizer

ALTER TABLE tea
    DROP COLUMN amount;
ALTER TABLE tea
    DROP COLUMN price;
ALTER TABLE tea_request
    ADD amount INT NOT NULL;

ALTER TABLE fertilizer
    DROP COLUMN amount;
ALTER TABLE fertilizer
    DROP COLUMN price;
ALTER TABLE fertilizer_request
    ADD amount INT NOT NULL;

-- monthly deduction have to go fertilizer_request, tea_request -- because of the insertion problem

ALTER TABLE tea
    DROP COLUMN monthly_ded;
ALTER TABLE tea_request
    ADD monthly_ded DECIMAL(10, 2) NOT NULL;

ALTER TABLE fertilizer
    DROP COLUMN monthly_deduction;
ALTER TABLE fertilizer_request
    ADD monthly_deduction DECIMAL(10, 2) NOT NULL;

-- -----------------------------------------------------------
-- added email colums for company details

ALTER TABLE factory
    ADD email VARCHAR(320) NOT NULL;

-- add column to lone table

ALTER TABLE loan
    ADD loanHeader VARCHAR(100) NOT NULL;

ALTER TABLE loan
    ADD discription TEXT NOT NULL;