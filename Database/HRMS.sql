CREATE TABLE Department (
    departmentCode varchar(10) NOT NULL,
    description varchar(30) NOT NULL,
    PRIMARY KEY (departmentCode)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS LeaveType (
    leaveTypeCode VARCHAR(30) NOT NULL,
    yearStart INT(3),
    yearEnd INT(3),
    entitle INT(2),
    description VARCHAR(30),
    PRIMARY KEY (leaveTypeCode,yearStart)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS LeaveTemplate (
    leaveTemplateCode VARCHAR(10) NOT NULL,
    description VARCHAR(30),
    annualLeave VARCHAR(30),
    sickLeave VARCHAR(30),
    maternityLeave VARCHAR(30),
    paternityLeave VARCHAR(30),
    speacialLeave VARCHAR(30),
    PRIMARY KEY (leaveTemplateCode),
    FOREIGN KEY (annualLeave) REFERENCES LeaveType(leaveTypeCode),
    FOREIGN KEY (sickLeave) REFERENCES LeaveType(leaveTypeCode),
    FOREIGN KEY (maternityLeave) REFERENCES LeaveType(leaveTypeCode),
    FOREIGN KEY (paternityLeave) REFERENCES LeaveType(leaveTypeCode),
    FOREIGN KEY (speacialLeave) REFERENCES LeaveType(leaveTypeCode)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS Employ (
    staffID VARCHAR(10) NOT NULL,
    staffType VARCHAR(1) NOT NULL,
    chineseName VARCHAR(30),
    englishName VARCHAR(30),
    gender VARCHAR(1),
    HKID VARCHAR(10),
    birthday DATE,
    phone varchar(8),
    address varchar(255),
    email varchar(255),
    employmentDate DATE,
    departmentCode varchar(10),
    position varchar(30),
    leaveTemplateCode varchar(10),
    attendanceID varchar(255),
    PRIMARY KEY (staffID),
    FOREIGN KEY (departmentCode) REFERENCES Department(departmentCode),
    FOREIGN KEY (leaveTemplateCode) REFERENCES LeaveTemplate(leaveTemplateCode)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS Bank (
    accountNo VARCHAR(30) NOT NULL,
    staffID VARCHAR(10) NOT NULL,
    bankName VARCHAR(30),
    branch VARCHAR(30),
    accountName VARCHAR(30),
    PRIMARY KEY (accountNo),
    FOREIGN KEY (staffID) REFERENCES Employ(staffID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS Login (
    accID VARCHAR(10) NOT NULL,
    staffID VARCHAR(10) NOT NULL,
    password VARCHAR(30),
    PRIMARY KEY (accID),
    FOREIGN KEY (staffID) REFERENCES Employ(staffID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS LeaveTaken (
    id INT(11) NOT NULL AUTO_INCREMENT,
    staffID VARCHAR(10) NOT NULL,
    leaveTypeCode VARCHAR(30) NOT NULL,
    startDate DATE NOT NULL,
    startTakingUnit VARCHAR(2) NOT NULL,
    endDate DATE NOT NULL,
    endTakingUnit VARCHAR(2) NOT NULL,
    taken DOUBLE(5,2),
    status VARCHAR(3),
    alert VARCHAR(1),
    PRIMARY KEY (id),
    FOREIGN KEY (staffID) REFERENCES Employ(staffID),
    FOREIGN KEY (leaveTypeCode) REFERENCES LeaveType(leaveTypeCode)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS Attendance (
    id INT(11) NOT NULL AUTO_INCREMENT,
    staffID VARCHAR(10) NOT NULL,
    attendance TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    site VARCHAR(10),
    PRIMARY KEY (id),
    FOREIGN KEY (staffID) REFERENCES Employ(staffID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO Employ VALUES('HR','h','人事部','HR department',NULL,NULL,NULL,NULL);

INSERT INTO Login VALUES('HR','HR','hradmin');