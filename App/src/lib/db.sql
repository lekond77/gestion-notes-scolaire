

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données : `releve_notes`
--

-- --------------------------------------------------------

--
-- Structure de la table `belonging_level`
--

DROP TABLE IF EXISTS `belonging_level`;
CREATE TABLE IF NOT EXISTS `belonging_level` (
  `levels` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  PRIMARY KEY (`levels`,`course`),
  KEY `Fk_Belonging_course` (`course`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `classroom`
--

DROP TABLE IF EXISTS `classroom`;
CREATE TABLE IF NOT EXISTS `classroom` (
  `numClassRoom` varchar(50) NOT NULL,
  PRIMARY KEY (`numClassRoom`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `classroom`
--

INSERT INTO `classroom` (`numClassRoom`) VALUES
('classe1'),
('classe2'),
('classe3');

-- --------------------------------------------------------

--
-- Structure de la table `class_course`
--

DROP TABLE IF EXISTS `class_course`;
CREATE TABLE IF NOT EXISTS `class_course` (
  `numClassRoom` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  PRIMARY KEY (`numClassRoom`,`course`),
  KEY `Fk_CLASS_COURSE_COURSE` (`course`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `courseNum` varchar(50) NOT NULL,
  `courseName` varchar(50) NOT NULL,
  `teacher` varchar(50) NOT NULL,
  `coefficient` int NOT NULL,
  `courseColor` varchar(8) NOT NULL,
  PRIMARY KEY (`courseNum`),
  KEY `FK_COURSE_TEACHER` (`teacher`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `course`
--

INSERT INTO `course` (`courseNum`, `courseName`, `teacher`, `coefficient`, `courseColor`) VALUES
('course1', 'Français', 'teacher1@gmail.com', 3, '#8CBDB9'),
('course2', 'PCT', 'teacher2@gmail.com', 5, '#8CA9DE'),
('course3', 'SVT', 'teacher3@gmail.com', 3, '#E8ECEB'),
('course4', 'ELECTRO', 'teacher1@gmail.com', 4, '#E09E50'),
('course5', 'Mathematique', 'teacher2@gmail.com', 5, '#F26659');

-- --------------------------------------------------------

--
-- Structure de la table `evaluation`
--

DROP TABLE IF EXISTS `evaluation`;
CREATE TABLE IF NOT EXISTS `evaluation` (
  `numEvaluation` varchar(50) NOT NULL,
  `nameEvaluation` varchar(50) NOT NULL,
  `dateEvaluation` date DEFAULT NULL,
  `teacher` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  PRIMARY KEY (`numEvaluation`,`course`),
  KEY `FK_EVALUATION_TEACHER` (`teacher`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `evaluation`
--

INSERT INTO `evaluation` (`numEvaluation`, `nameEvaluation`, `dateEvaluation`, `teacher`, `course`) VALUES
('ev1', 'Sommative', '2021-10-11', 'teacher4@gmail.com', 'course5'),
('ev1', 'Fromative', '2021-02-03', 'teacher3@gmail.com', 'course3'),
('ev2', 'Sommative', '2021-10-02', 'teacher4@gmail.com', 'course5'),
('ev1', 'Sommative', '2021-10-02', 'teacher1@gmail.com', 'course1'),
('ev3', 'Sommative', '2021-05-12', 'teacher4@gmail.com', 'course5');

-- --------------------------------------------------------

--
-- Structure de la table `exam`
--

DROP TABLE IF EXISTS `exam`;
CREATE TABLE IF NOT EXISTS `exam` (
  `student` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  `evaluation` varchar(50) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `note` float NOT NULL,
  PRIMARY KEY (`student`,`course`,`evaluation`,`semester`),
  KEY `FK_EXAM_EVALUATION` (`course`,`evaluation`),
  KEY `FK_EXAM_SEMESTER` (`semester`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `exam`
--

INSERT INTO `exam` (`student`, `course`, `evaluation`, `semester`, `note`) VALUES
('student@gmail.com', 'course5', 'ev1', 'semestre1', 17),
('student@gmail.com', 'course5', 'ev2', 'semestre1', 18),
('student@gmail.com', 'course3', 'ev2', 'semestre1', 10.5),
('student@gmail.com', 'course1', 'ev1', 'semestre1', 16.5),
('student@gmail.com', 'course1', 'ev2', 'semestre1', 10),
('student@gmail.com', 'course2', 'ev2', 'semestre2', 10.5),
('student1@gmail.com', 'course1', 'ev1', 'semestre1', 8),
('student2@gmail.com', 'course1', 'ev1', 'semestre2', 16),
('student@gmail.com', 'course1', 'ev3', 'semestre1', 14),
('student@gmail.com', 'course2', 'ev1', 'semestre2', 14),
('student2@gmail.com', 'course1', 'ev2', 'semestre1', 5),
('example@gmail.com', 'course2', 'ev1', 'semestre2', 13),
('example@gmail.com', 'course1', 'ev1', 'semestre1', 13);

-- --------------------------------------------------------

--
-- Structure de la table `levels`
--

DROP TABLE IF EXISTS `levels`;
CREATE TABLE IF NOT EXISTS `levels` (
  `numLevel` varchar(50) NOT NULL,
  PRIMARY KEY (`numLevel`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `studentRegister` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `classRoom` varchar(20) NOT NULL,
  PRIMARY KEY (`studentRegister`),
  KEY `Fk_classRoom` (`classRoom`)
  KEY `Fk_studentRegister` (`studentRegister`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `student`
--

INSERT INTO `student` (`studentRegister`, `classRoom`) VALUES
('1234', 'classe1'),
('1235', 'classe2'),
('1236', 'classe1'),
('1237', 'classe2'),
('1238', 'classe3');

-- --------------------------------------------------------

--
-- Structure de la table `teacher`
--

DROP TABLE IF EXISTS `teacher`;
CREATE TABLE IF NOT EXISTS `teacher` (
  `teacherRegister` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `grade` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`teacherRegister`)
  KEY `teacherRegister` (`teacherRegister`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `teacher`
--

INSERT INTO `teacher` (`teacherRegister`, `grade`) VALUES
('4123', 'A1'),
('4124', 'A1'),
('4125', 'A2+'),
('4126', 'A2');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `register` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `birthDay` date NOT NULL,
  `password` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '12345',
  `keyPass` varchar(500) NOT NULL DEFAULT '0',
  `dateLastUpdate` datetime NOT NULL DEFAULT '2023-01-15 00:00:00',
  `profilImage` varchar(250) NOT NULL DEFAULT '0',
  `isTeacher` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`register`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`register`, `email`, `firstName`, `lastName`, `birthDay`, `password`, `keyPass`, `dateLastUpdate`, `profilImage`, `isTeacher`) VALUES
('1234', 'student@gmail.com', 'AKO', 'LEO', '1995-11-10', '$2y$10$e8hIGBNPbgGbBI5YNdZVpeaaqzkHha/vymJNpDnl7F/unR4rfNvrS', '', '2023-06-25 09:32:15', '', 0),
('1235', 'student1@gmail.com', 'STU', 'STU', '1989-10-12', '$2y$10$PRLVIRlpD/l5f06fDaMoEehJ3ZFq79rSi1MrLrnjOloAHqssMBFHq', '0', '2023-06-25 11:19:40', '', 0),
('1236', 'example@gmail.com', 'Example', 'JOSE', '1996-11-10', 'pass', '', '2023-06-25 09:32:15', '', 0),
('1237', 'student2@gmail.com', 'JAZY', 'MECO', '1994-02-28', '$2y$10$e8hIGBNPbgGbBI5YNdZVpeaaqzkHha/vymJNpDnl7F/unR4rfNvrS', '', '2023-06-25 09:32:15', '', 0),
('1238', 'student3@gmail.com', 'MEYER', 'LUC', '1990-06-30', '', '', '2023-06-25 09:32:15', '', 0),
('4123', 'teacher1@gmail.com', 'DO', 'Jean', '1890-12-05', '$2y$10$e8hIGBNPbgGbBI5YNdZVpeaaqzkHha/vymJNpDnl7F/unR4rfNvrS', '8cf7c45f26420f8bf517aaefca5f396b', '2023-01-15 00:00:00', '0', 1),
('4124', 'teacher2@gmail.com', 'TOTO', 'Toto', '1990-12-05', 'A1sdf', '0', '2023-01-15 00:00:00', '0', 1),
('4125', 'teacher3@gmail.com', 'TITI', 'Titi', '1890-11-25', 'A2+fcre', '0', '2023-01-15 00:00:00', '0', 1),
('4126', 'teacher4@gmail.com', 'Tata', 'tata', '1991-01-09', 'A2rfrvrf', '0', '2023-01-15 00:00:00', '0', 1);
COMMIT;

