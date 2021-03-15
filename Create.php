<?php

require 'dbcon.php';

// Create database


$sql = "CREATE DATABASE Routine;";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br/>";
} else {
    echo "Error creating database: <br/>" . $conn->error;
}



$conn = new mysqli($servername, $username, $password, $dbname);


// sql to create table

$sql = "CREATE TABLE Rooms (
    R_code varchar(255) NOT NULL PRIMARY KEY,
    R_type int not null 
);";

if ($conn->query($sql) === TRUE) {
    echo "Tables created successfully<br/>";
} else {
    echo "Error creating tables: <br/>" . $conn->error;
}

$sql = "CREATE TABLE Teachers (
    T_id varchar(255) NOT NULL PRIMARY KEY,
    T_holiday int 
);";

if ($conn->query($sql) === TRUE) {
    echo "Tables created successfully<br/>";
} else {
    echo "Error creating tables: <br/>" . $conn->error;
}


$sql = "CREATE TABLE Sections (
    S_id varchar(255) NOT NULL primary key,
    Lab_no int NOT NULL
);";

if ($conn->query($sql) === TRUE) {
    echo "Tables created successfully<br/>";
} else {
    echo "Error creating tables: <br/>" . $conn->error;
}

$sql = "CREATE TABLE Courses (
    C_id varchar(255) NOT NULL PRIMARY KEY,
    C_type int NOT NULL
);";

if ($conn->query($sql) === TRUE) {
    echo "Tables created successfully<br/>";
} else {
    echo "Error creating tables: <br/>" . $conn->error;
}

$sql = "CREATE TABLE Course_Teacher (
    C_id varchar(255) ,
	T_id varchar(255) ,
	S_id varchar(255) ,
	FOREIGN KEY (C_id) REFERENCES Courses(C_id),
	FOREIGN KEY (T_id) REFERENCES Teachers(T_id),
	FOREIGN KEY (S_id) REFERENCES Sections(S_id),
	constraint CS_id primary key (C_id,S_id)
);";

if ($conn->query($sql) === TRUE) {
    echo "Tables created successfully<br/>";
} else {
    echo "Error creating tables: <br/>" . $conn->error;
}

$sql = "CREATE TABLE TimeTable (
   	C_id varchar(255) ,
	T_id varchar(255) ,
	S_id varchar(255) ,
	Grp_no int ,
	R_code varchar(255) ,
	Timeslot int not null,
	Dayslot int not null,
	FOREIGN KEY (C_id) REFERENCES Courses(C_id),
	FOREIGN KEY (T_id) REFERENCES Teachers(T_id),
	FOREIGN KEY (S_id) REFERENCES Sections(S_id),
	FOREIGN KEY (R_code) REFERENCES Rooms(R_code),
	constraint RTD primary key (R_code,Timeslot,Dayslot),
	constraint TTD unique (T_id,Timeslot,Dayslot),
	constraint STD unique (S_id,Grp_no,Timeslot,Dayslot)
);";

if ($conn->query($sql) === TRUE) {
    echo "Tables created successfully<br/>";
} else {
    echo "Error creating tables: <br/>" . $conn->error;
}

$sql = "CREATE TABLE User (
    email varchar(100) NOT NULL PRIMARY KEY,
    password varchar(50)  NOT NULL
);";

if ($conn->query($sql) === TRUE) {
    echo "Tables created successfully<br/>";
} else {
    echo "Error creating tables: <br/>" . $conn->error;
}

$sql = "INSERT INTO Rooms
VALUES ('601AB','0'),
 ('604AB','0'),
 ('607AB','0'),
 ('501AB','0'),
 ('502AB','0'),
 ('504AB','0'),
 ('406AB','0'),
 ('305AB','0'),
 ('605AB','1'),
 ('404AB','1'),
 ('304AB','1'),
 ('405AB','1');";

if ($conn->query($sql) === TRUE) {
    echo "Tables created successfully<br/>";
} else {
    echo "Error creating tables: <br/>" . $conn->error;
}

$sql = "INSERT INTO Teachers
VALUES ('Dr. Touhid Bhuiyan','1'),
('Dr. Md. Asraf Ali','5'),
('M. Khaled Sohel','0'),
('Dr. Imran Mahmud','5'),
('Dr. Mostafijur Rahman','5'),
('Md. Maruf Hassan','5'),
('K M Imtiaz Uddin','0'),
('Mr. Kaushik Sarker','0'),
('Md. Fahad Bin Zamal','0'),
('Nazia Nishat ','5'),
('Iftekher Alam','0'),
('Md Alamgir Kabir','5'),
('Afsana Begum','0'),
('Asif Khan Shakir','5'),
('Md. Anwar Hossen','5'),
('Syeda Sumbul Hossain','2'),
('Nusrat Jahan','5'),
('Farzana Sadia Borna','0'),
('Monon Binte Taj Noor','5'),
('Md. Mushfiqur Rahman','0'),
('Khalid Been Badruzzaman Biplob','1'),
('Lamisha Rawshan','0'),
('Tapushe Rabaya Toma','0'),
('Rayhanul Islam','0'),
('Md. Shohel Arman','0'),
('Fatama Binta Rafiq','2'),
('Shayla Parvin','5'),
('Priyanka Mandal','0'),
('Mobashir Sadat','2'),
('Khandker M Qaiduzzaman','2'),
('Sheikh Shah Mohammad Motiur Rahman','0'),
('Md. Habibur Rahman','0'),
('Samia Nasrin','0');";

if ($conn->query($sql) === TRUE) {
    echo "Tables created successfully<br/>";
} else {
    echo "Error creating tables: <br/>" . $conn->error;
}

$sql = "INSERT INTO Sections
VALUES ('1A','2'),
('1B','2'),
('1C','2'),
('1D','2'),
('2A','2'),
('2B','2'),
('2C','2'),
('2D','2'),
('3A','2'),
('3B','2'),
('3C','2'),
('3D','2'),
('4A','2'),
('4B','2'),
('4C','2'),
('5A','2'),
('5B','2'),
('5C','2'),
('6A','2'),
('6B','2'),
('6C','2'),
('7A','2'),
('7B','2'),
('7C','2'),
('8A','2'),
('8B','2'),
('8C','1'),
('9A','2'),
('9B','2'),
('9C','1'),
('10A','2'),
('10B','2'),
('10C','1'),
('11A','2'),
('11B','2'),
('11C','1'),
('12A','2'),
('12B','2');";

if ($conn->query($sql) === TRUE) {
    echo "Tables created successfully<br/>";
} else {
    echo "Error creating tables: <br/>" . $conn->error;
}

$sql = "INSERT INTO Courses
VALUES ('SE111','0'),
('SE112','1'),
('SE113','0'),
('ENG101','0'),
('AOL101','0'),
('SE121','0'),
('SE122','1'),
('SE123','0'),
('MAT101','0'),
('PHY101','0'),
('MAT102','0'),
('SWE111','2'),
('SWE133','0'),
('SWE134','1'),
('STA101','0'),
('SWE132','0'),
('SWE137','1'),
('SWE213','0'),
('SWE214','1'),
('SWE211','0'),
('SWE212','1'),
('SWE233','0'),
('SWE234','1'),
('SWE222','0'),
('SWE223','0'),
('SWE224','1'),
('SWE225','0'),
('SWE226','0'),
('SWE227','0'),
('SWE131','1'),
('SWE232','0'),
('SWE299','0'),
('SWE235','0'),
('SWE228','0'),
('SWE435','0'),
('SWE301','0'),
('SWE302','1'),
('SWE303','0'),
('SWE304','1'),
('SWE305','0'),
('SWE306','1'),
('SWE307','0'),
('SWE308','0'),
('SWE309','0'),
('SWE310','2'),
('SWE311','0'),
('SWE312','1'),
('SWE313','0'),
('SWE401','1'),
('SWE402','0'),
('SWE403','1'),
('SWE404','0'),
('SWE405','1'),
('SWE406','0'),
('SWE407','1'),
('SWE408','0'),
('SWE409','2'),
('SWE410','0'),
('SWE411','1'),
('SWE412','2');";

if ($conn->query($sql) === TRUE) {
    echo "Tables created successfully<br/>";
} else {
    echo "Error creating tables: <br/>" . $conn->error;
}

$sql = "INSERT INTO Course_Teacher
VALUES ('SE111','Dr. Touhid Bhuiyan','1A'),
('SE111','Dr. Md. Asraf Ali','1B'),
('SE111','Dr. Md. Asraf Ali','1C'),
('SE113','Dr. Mostafijur Rahman','1A'),
('SWE404','Dr. Mostafijur Rahman','5A'),
('SWE407','Tapushe Rabaya Toma','9A'),
('SWE412','Lamisha Rawshan','4C'),
('SWE224','Md Alamgir Kabir','6C'),
('SWE309','Mr. Kaushik Sarker','11A'),
('SWE299','Lamisha Rawshan','4B'),
('SWE307','Md Alamgir Kabir','8A'),
('SWE435','Tapushe Rabaya Toma','2B'),
('SWE214','Md Alamgir Kabir','4A'),
('SWE411','Mr. Kaushik Sarker','6A');";

if ($conn->query($sql) === TRUE) {
    echo "Tables created successfully<br/>";
} else {
    echo "Error creating tables: <br/>" . $conn->error;
}

$sql = "INSERT INTO TimeTable
VALUES ('SE111','Dr. Touhid Bhuiyan','1A','0','604AB','0','1'),
('SE111','Dr. Md. Asraf Ali','1B','0','604AB','0','2'),
('SE111','Dr. Md. Asraf Ali','1C','0','607AB','0','3'),
('SWE411','Mr. Kaushik Sarker','6A','0','604AB','0','0'),
('SWE309','Mr. Kaushik Sarker','11A','0','305AB','1','3'),
('SWE412','Lamisha Rawshan','4C','0','502AB','0','5'),
('SWE299','Lamisha Rawshan','4B','0','305AB','0','4'),
('SWE307','Md Alamgir Kabir','8A','0','502AB','1','1'),
('SWE214','Md Alamgir Kabir','4A','0','502AB','1','2'),
('SWE407','Tapushe Rabaya Toma','9A','0','405AB','2','1'),
('SWE435','Tapushe Rabaya Toma','2B','0','501AB','0','4'),
('SWE407','Tapushe Rabaya Toma','9A','0','305AB','2','2'),
('SWE214','Md Alamgir Kabir','4A','0','405AB','1','3'),
('SWE299','Lamisha Rawshan','4B','0','501AB','0','0'),
('SWE309','Mr. Kaushik Sarker','11A','0','305AB','3','5'),
('SE111','Dr. Md. Asraf Ali','1B','0','405AB','3','2'),
('SE111','Dr. Md. Asraf Ali','1B','0','305AB','1','5'),
('SE111','Dr. Touhid Bhuiyan','1A','0','501AB','3','3');
";

if ($conn->query($sql) === TRUE) {
    echo "Tables created successfully<br/>";
} else {
    echo "Error creating tables: <br/>" . $conn->error;
}
$sql = "INSERT INTO User
VALUES ('faruk35-1280@diu.edu.bd','21232f297a57a5a743894a0e4a801fc3');";

if ($conn->query($sql) === TRUE) {
    echo "Tables created successfully<br/>";
} else {
    echo "Error creating tables: <br/>" . $conn->error;
}
$conn->close();
?>
