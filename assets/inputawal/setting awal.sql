-- Insert super administrator

INSERT INTO `users` (`nama`, `role_id`, `unit_id`, `email`, `sandi`, `image`, `is_active`, `date_created`) VALUES
('Fatih Amrullah', 1, '01', 'aroedata@gmail.com', '$2y$10$udhX7JHS5fDxMYqJBkasBucKofboyP50bHHZ6/CtsKdTb0BCiyXt2', 'default.jpg', 1, '2019-11-14 17:00:00');
-- Insert role
INSERT INTO `roles` (`role`, `keterangan`) VALUES
('Super Administrator', 'Super Administrator');