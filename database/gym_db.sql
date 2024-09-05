-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2020 at 09:52 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gym_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(30) NOT NULL,
  `member_id` int(30) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `member_id`, `firstname`, `middlename`, `lastname`, `gender`, `contact`, `address`, `email`, `date_created`) VALUES
(1, 10000001, 'Juan', 'A.', 'Pérez', 'Male', '+54911-1234-5678', 'Av. Libertador 1234, Buenos Aires', 'juan.perez@example.com', '2022-01-15 10:12:34'),
(2, 10000002, 'María', 'E.', 'Gómez', 'Female', '+54911-9876-5432', 'Calle Falsa 456, Córdoba', 'maria.gomez@example.com', '2022-01-16 11:23:45'),
(3, 10000003, 'Carlos', 'J.', 'Ramírez', 'Male', '+549351-7654-3210', 'San Martín 789, Mendoza', 'carlos.ramirez@example.com', '2022-01-17 09:45:12'),
(4, 10000004, 'Ana', 'M.', 'López', 'Female', '+549261-4567-1234', 'Belgrano 1111, Rosario', 'ana.lopez@example.com', '2022-01-18 08:34:56'),
(5, 10000005, 'Lucía', 'V.', 'Martínez', 'Female', '+549381-2345-6789', 'Rivadavia 2222, Tucumán', 'lucia.martinez@example.com', '2022-01-19 14:12:34'),
(6, 10000006, 'José', 'L.', 'Sánchez', 'Male', '+549261-9876-5432', 'Mitre 3333, Salta', 'jose.sanchez@example.com', '2022-01-20 10:54:21'),
(7, 10000007, 'Gabriela', 'P.', 'Fernández', 'Female', '+549351-1234-5678', 'Lavalle 4444, La Plata', 'gabriela.fernandez@example.com', '2022-01-21 12:15:32'),
(8, 10000008, 'Ricardo', 'O.', 'Rodríguez', 'Male', '+54911-2345-6789', 'Córdoba 5555, Mar del Plata', 'ricardo.rodriguez@example.com', '2022-01-22 09:33:44'),
(9, 10000009, 'Laura', 'F.', 'García', 'Female', '+549223-8765-4321', 'San Juan 6666, San Juan', 'laura.garcia@example.com', '2022-01-23 14:45:12'),
(10, 10000010, 'Sergio', 'R.', 'González', 'Male', '+549261-5678-1234', 'Pueyrredón 7777, Neuquén', 'sergio.gonzalez@example.com', '2022-01-24 11:22:33'),
(11, 10000011, 'Valeria', 'G.', 'Torres', 'Female', '+549221-3456-7890', 'Mitre 8888, Chaco', 'valeria.torres@example.com', '2022-01-25 13:11:22'),
(12, 10000012, 'Diego', 'H.', 'Domínguez', 'Male', '+549381-2345-6789', 'Roca 9999, Jujuy', 'diego.dominguez@example.com', '2022-01-26 12:12:12'),
(13, 10000013, 'Camila', 'T.', 'Hernández', 'Female', '+549261-1234-5678', '9 de Julio 1010, Corrientes', 'camila.hernandez@example.com', '2022-01-27 09:09:09'),
(14, 10000014, 'Matías', 'B.', 'Muñoz', 'Male', '+549351-9876-5432', 'Independencia 1111, Formosa', 'matias.munoz@example.com', '2022-01-28 14:45:45'),
(15, 10000015, 'Florencia', 'Z.', 'Paz', 'Female', '+549381-7654-3210', 'Güemes 1212, La Rioja', 'florencia.paz@example.com', '2022-01-29 13:33:33'),
(16, 10000016, 'Federico', 'S.', 'Silva', 'Male', '+54911-2345-6789', 'Santa Fe 1313, San Luis', 'federico.silva@example.com', '2022-01-30 15:12:12'),
(17, 10000017, 'Romina', 'L.', 'Mendoza', 'Female', '+549261-4567-1234', 'Urquiza 1414, Tierra del Fuego', 'romina.mendoza@example.com', '2022-02-01 10:10:10'),
(18, 10000018, 'Joaquín', 'M.', 'Castro', 'Male', '+54911-7654-3210', 'Balcarce 1515, San Fernando', 'joaquin.castro@example.com', '2022-02-02 11:45:45'),
(19, 10000019, 'Sofía', 'A.', 'Ortiz', 'Female', '+549351-5678-1234', 'Alsina 1616, Moreno', 'sofia.ortiz@example.com', '2022-02-03 14:22:22'),
(20, 10000020, 'Leonardo', 'R.', 'Suárez', 'Male', '+549223-3456-7890', 'Laprida 1717, Pilar', 'leonardo.suarez@example.com', '2022-02-04 12:12:12'),
(21, 10000021, 'Julieta', 'V.', 'Ruiz', 'Female', '+54911-8765-4321', 'Sarmiento 1818, Vicente López', 'julieta.ruiz@example.com', '2022-02-05 13:13:13'),
(22, 10000022, 'Martín', 'D.', 'Mora', 'Male', '+549261-1234-5678', 'Avellaneda 1919, Tigre', 'martin.mora@example.com', '2022-02-06 14:45:45'),
(23, 10000023, 'Paula', 'C.', 'Navarro', 'Female', '+549351-2345-6789', 'Catamarca 2020, Tres de Febrero', 'paula.navarro@example.com', '2022-02-07 15:45:45'),
(24, 10000024, 'Agustín', 'G.', 'Reyes', 'Male', '+549381-7654-3210', 'Jujuy 2121, San Miguel', 'agustin.reyes@example.com', '2022-02-08 09:12:12'),
(25, 10000025, 'Mónica', 'E.', 'Morales', 'Female', '+549261-9876-5432', 'Chaco 2222, Quilmes', 'monica.morales@example.com', '2022-02-09 10:45:45'),
(26, 10000026, 'Tomás', 'R.', 'Ibáñez', 'Male', '+549223-2345-6789', 'Corrientes 2323, Lomas de Zamora', 'tomas.ibanez@example.com', '2022-02-10 11:22:22'),
(27, 10000027, 'Victoria', 'A.', 'Rivas', 'Female', '+54911-7654-3210', 'San Luis 2424, Almirante Brown', 'victoria.rivas@example.com', '2022-02-11 13:33:33'),
(28, 10000028, 'Lucas', 'F.', 'Aguilar', 'Male', '+549381-1234-5678', 'Entre Ríos 2525, Esteban Echeverría', 'lucas.aguilar@example.com', '2022-02-12 12:12:12'),
(29, 10000029, 'Daniela', 'L.', 'Vega', 'Female', '+549261-4567-1234', 'Santa Cruz 2626, Florencio Varela', 'daniela.vega@example.com', '2022-02-13 15:12:12'),
(30, 10000030, 'Hernán', 'S.', 'Rojas', 'Male', '+549351-9876-5432', 'Misiones 2727, Berazategui', 'hernan.rojas@example.com', '2022-02-14 16:45:45'),
(31, 10000031, 'Elena', 'G.', 'Romero', 'Female', '+549223-8765-4321', 'Chubut 2828, Lanús', 'elena.romero@example.com', '2022-02-15 13:22:22'),
(32, 10000032, 'Emiliano', 'D.', 'Vargas', 'Male', '+54911-2345-6789', 'Formosa 2929, Avellaneda', 'emiliano.vargas@example.com', '2022-02-16 09:33:33'),
(33, 10000033, 'Claudia', 'P.', 'Benítez', 'Female', '+549261-1234-5678', 'San Juan 3030, Merlo', 'claudia.benitez@example.com', '2022-02-17 10:12:12'),
(34, 10000034, 'Esteban', 'J.', 'Soto', 'Male', '+549351-7654-3210', 'La Pampa 3131, San Isidro', 'esteban.soto@example.com', '2022-02-18 14:45:45'),
(35, 10000035, 'Sabrina', 'F.', 'Acosta', 'Female', '+549381-2345-6789', 'Río Negro 3232, José C. Paz', 'sabrina.acosta@example.com', '2022-02-19 15:12:12'),
(36, 10000036, 'Ignacio', 'V.', 'Villalba', 'Male', '+54911-9876-5432', 'Neuquén 3333, Malvinas Argentinas', 'ignacio.villalba@example.com', '2022-02-20 16:45:45'),
(37, 10000037, 'Noelia', 'C.', 'Bustos', 'Female', '+549223-3456-7890', 'Salta 3434, Hurlingham', 'noelia.bustos@example.com', '2022-02-21 17:22:22'),
(38, 10000038, 'Enzo', 'T.', 'Maldonado', 'Male', '+549261-5678-1234', 'Chaco 3535, Ituzaingó', 'enzo.maldonado@example.com', '2022-02-22 14:33:33'),
(39, 10000039, 'Melina', 'R.', 'Ponce', 'Female', '+54911-2345-6789', 'Tierra del Fuego 3636, Moreno', 'melina.ponce@example.com', '2022-02-23 18:12:12'),
(40, 10000040, 'Gabriel', 'L.', 'Cuevas', 'Male', '+549381-7654-3210', 'Entre Ríos 3737, San Martín', 'gabriel.cuevas@example.com', '2022-02-24 19:45:45');


-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(30) NOT NULL,
  `package` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `package`, `description`, `amount`) VALUES
(1, 'Explosión Corporal Total', 'Un programa intensivo de 4 semanas que incluye entrenamiento personalizado y asesoramiento nutricional. Ideal para tonificar y aumentar la fuerza.', 4500),
(2, 'Enfocado y en Forma', 'Sesiones de entrenamiento de alta intensidad diseñadas para mejorar la resistencia, fuerza y flexibilidad. Incluye 8 clases grupales.', 3000),
(3, 'Poder Personal', 'Paquete individual con 10 sesiones personalizadas y seguimiento continuo. Perfecto para quienes desean maximizar su rendimiento físico.', 5000),
(4, 'Renovación Completa', 'Programa de 6 semanas que combina entrenamiento, nutrición y bienestar mental. Ideal para una transformación integral.', 6000),
(5, 'Pilates & Estiramientos', 'Un plan especializado de 12 clases para mejorar la flexibilidad, fortalecer el core y relajar el cuerpo con pilates y técnicas de estiramiento.', 3500);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(30) NOT NULL,
  `registration_id` int(30) NOT NULL,
  `amount` int(30) NOT NULL,
  `remarks` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=registration, 2= monthly payment',
  `date_created` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `registration_id`, `amount`, `remarks`, `type`, `date_created`) VALUES
(1, 2, 4500, 'First payment', 2, '2020-10-21 14:39:26'),
(2, 2, 3500, 'payment for november', 2, '2020-10-21 14:39:52');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(30) NOT NULL,
  `plan` int(30) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `plan`, `amount`) VALUES
(1, 1, 1500),  -- Plan básico de 1 mes
(2, 3, 4000),  -- Plan intermedio de 3 meses
(3, 6, 7000),  -- Plan avanzado de 6 meses
(4, 12, 12000), -- Plan completo de 12 meses
(5, 24, 20000); -- Plan premium de 24 meses


-- --------------------------------------------------------

--
-- Table structure for table `registration_info`
--

CREATE TABLE `registration_info` (
  `id` int(30) NOT NULL,
  `member_id` int(30) NOT NULL,
  `plan_id` int(30) NOT NULL,
  `package_id` int(30) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `trainer_id` tinyint(30) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=Inactive, 1= Active',
  `date_created` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registration_info`
--

INSERT INTO `registration_info` (`id`, `member_id`, `plan_id`, `package_id`, `start_date`, `end_date`, `trainer_id`, `status`, `date_created`) VALUES
(2, 5, 1, 2, '2020-10-21', '2021-10-21', 0, 0, '2020-10-21'),
(3, 5, 1, 2, '2020-10-21', '2021-10-21', 0, 1, '2020-10-21'),
(4, 6, 1, 2, '2019-10-19', '2020-10-19', 0, 0, '2020-10-21'),
(5, 6, 1, 2, '2020-10-21', '2021-10-21', 0, 1, '2020-10-21');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(30) NOT NULL,
  `member_id` int(30) NOT NULL,
  `dow` text NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `contact` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `rate` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`id`, `name`, `contact`, `email`, `rate`) VALUES
(1, 'Juan Pérez', '+54911-1234-5678', 'juan.perez@ejemplo.com', 4500),
(2, 'María López', '+54911-9876-5432', 'maria.lopez@ejemplo.com', 5000),
(3, 'Carlos Fernández', '+549223-4567-8901', 'carlos.fernandez@ejemplo.com', 5500),
(4, 'Ana González', '+549351-2345-6789', 'ana.gonzalez@ejemplo.com', 4800);


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 3 COMMENT '1=Admin,2=Staff, 3= subscriber'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`) VALUES
(1, 'Administrador', 'admin', '0192023a7bbd73250516f069df18b500', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration_info`
--
ALTER TABLE `registration_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `registration_info`
--
ALTER TABLE `registration_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
