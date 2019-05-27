

CREATE TABLE `states` (
  `id` mediumint(9) NOT NULL,
  `state` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `state`) VALUES
(1, 'To do'),
(2, 'Done');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` mediumint(9) NOT NULL,
  `description` char(30) NOT NULL,
  `state_id` int(11) NOT NULL,
  `user_id` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `description`, `state_id`, `user_id`) VALUES
(1, 'conference', 1, 3),
(2, 'concert', 1, 6),
(3, 'interview', 2, 1),
(4, 'lesson', 1, 4),
(5, 'conference', 1, 2),
(6, 'concert', 2, 5),
(7, 'conference', 1, 7),
(8, 'concert', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` mediumint(9) NOT NULL,
  `name` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`) VALUES
(1, 'Bob James'),
(2, 'Clare Fischer'),
(3, 'Joe Sample'),
(4, 'Eumir Deodato'),
(5, 'Herbie Hancock'),
(6, 'Chick Corea'),
(7, 'Keith Jarrett'),
(8, 'Donald Fagen');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
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
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;
