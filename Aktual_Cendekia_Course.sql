CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('siswa', 'tentor') DEFAULT 'siswa' NOT NULL,
    profilepicture VARCHAR(255),
    nama VARCHAR(255),
    no_telp VARCHAR(15),
    usia INT,
    alamat_email VARCHAR(255)
);
-- INSERT INTO users (username, password, role, profilepicture, nama, no_telp, usia, alamat_email)
-- VALUES 
-- ('andriantambunan', PASSWORD('lalala123'), 'tentor', NULL, 'Andrian Tambunan', '08236258****', 19, 'andriantambunan2752@gmail.com'),
-- ('Aelita Stones', PASSWORD('lalala123'), 'siswa', NULL, NULL, NULL, NULL, NULL),
-- ('richardsalazar', PASSWORD('lalala123'), 'tentor', NULL, 'Richard Saladzar', '08126597****', 27, 'richardsaladzar**@gmail.com');


CREATE TABLE classes (
    id CHAR(5) PRIMARY KEY,
    class_name VARCHAR(255) NOT NULL
);
INSERT INTO classes (id, class_name) 
VALUES 
('HS10A', 'Kelas 10 A'),
('HS10B', 'Kelas 10 B'),
('HS10C', 'Kelas 10 C');

CREATE TABLE subjects (
    id CHAR(5) PRIMARY KEY,
    subject_name VARCHAR(255) NOT NULL
);
INSERT INTO subjects (id, subject_name) 
VALUES 
('MTH10', 'Matematika Kelas 10'),
('SNS10', 'Sains Kelas 10'),
('PHY10', 'Fisika Kelas 10'),
('BREAK', 'Istirahat'),
('ENG10', 'English Kelas 10'),
('CHM10', 'Kimia Kelas 10'),
('BIO10', 'Biologi Kelas 10'),
('ACC10', 'Akuntansi Kelas 10');

CREATE TABLE schedule (
    id INT PRIMARY KEY,
    class_id CHAR(5),
    subject_id CHAR(5),
    day VARCHAR(10) NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    tentor_id INT,
    FOREIGN KEY (class_id) REFERENCES classes(id),
    FOREIGN KEY (subject_id) REFERENCES subjects(id),
    FOREIGN KEY (tentor_id) REFERENCES users(id)
);
INSERT INTO schedule (id, class_id, subject_id, day, start_time, end_time, tentor_id)
VALUES
(1001, 'HS10A', 'MTH10', 'Senin', '16:30:00', '17:30:00', 1),
(1002, 'HS10A', 'BREAK', 'Senin', '17:30:00', '18:00:00', NULL),
(1003, 'HS10A', 'PHY10', 'Senin', '18:00:00', '19:00:00', 1),
(1004, 'HS10A', 'ACC10', 'Senin', '19:00:00', '20:00:00', 1),

(1005, 'HS10A', 'CHM10', 'Selasa', '16:30:00', '17:30:00', 3),
(1006, 'HS10A', 'BREAK', 'Selasa', '17:30:00', '18:00:00', NULL),
(1007, 'HS10A', 'MTH10', 'Selasa', '18:00:00', '19:00:00', 1),
(1008, 'HS10A', 'ENG10', 'Selasa', '19:00:00', '20:00:00', 3),

(1009, 'HS10A', 'ENG10', 'Rabu', '16:30:00', '17:30:00', 3),
(1010, 'HS10A', 'BREAK', 'Rabu', '17:30:00', '18:00:00', NULL),
(1011, 'HS10A', 'PHY10', 'Rabu', '18:00:00', '19:00:00', 1),
(1012, 'HS10A', 'CHM10', 'Rabu', '19:00:00', '20:00:00', 3),

(1013, 'HS10A', 'CHM10', 'Kamis', '16:30:00', '17:30:00', 3),
(1014, 'HS10A', 'BREAK', 'Kamis', '17:30:00', '18:00:00', NULL),
(1015, 'HS10A', 'MTH10', 'Kamis', '18:00:00', '19:00:00', 1),
(1016, 'HS10A', 'ENG10', 'Kamis', '19:00:00', '20:00:00', 3);

CREATE TABLE assignments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    subject_id CHAR(5),
    student_id INT,
    tentor_id INT,
    file_path VARCHAR(255),
    is_submitted BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (subject_id) REFERENCES subjects(id),
    FOREIGN KEY (student_id) REFERENCES users(id),
    FOREIGN KEY (tentor_id) REFERENCES users(id)
);
INSERT INTO assignments (subject_id, student_id, tentor_id, file_path, is_submitted)
VALUES
('MTH10', 3, 1, 'assignment1.pdf', TRUE),
('MTH10', 3, 1, 'assignment2.txt', TRUE),
('ACC10', 3, 1, 'assignment4.doc', FALSE),
('CHM10', 3, 3, 'assignment5.pdf', TRUE),
('ENG10', 3, 3, 'assignment6.txt', FALSE),
('ACC10', 3, 3, 'assignment6.txt', FALSE);