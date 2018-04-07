INSERT INTO identities (`id`, `sin`, `name`, `birthday`, `gender`) VALUES
    ('identity00000000', 'sin000000', 'Willie Gonzales', DATE '1989-01-13', 'M'),
    ('identity00000001', 'sin000001', 'Sara Barnes',     DATE '1992-12-02', 'F'),
    ('identity00000002', 'sin000002', 'Steve Rodriguez', DATE '1980-11-29', 'M'),
    ('identity00000003', 'sin000003', 'Deborah Richard', DATE '1991-04-25', 'F'),
    ('identity00000004', 'sin000004', 'Barbara Foster',  DATE '1990-04-31', 'F'),
    ('identity00000005', 'sin000005', 'Randy Taylor',    DATE '1987-05-14', 'M'),
    ('identity00000006', 'sin000006', 'Judy Sanders',    DATE '1990-11-07', 'F'),
    ('identity00000007', 'sin000007', 'Brandon Clark',   DATE '1993-01-28', 'M'),
    ('identity00000008', 'sin000008', 'Denise Collins',  DATE '1990-02-13', 'F'),
    ('identity00000009', 'sin000009', 'Betty Morris',    DATE '1978-03-30', 'O'),
    ('identity00000010', 'sin000010', 'Larry Gray',      DATE '1990-03-07', 'M'),
    ('identity00000011', 'sin000011', 'Phillip Smith',   DATE '1990-06-03', 'M'),
    ('identity00000012', 'sin000012', 'Laura King',      DATE '1993-09-04', 'F'),
    ('identity00000013', 'sin000013', 'Paula Nelson',    DATE '1988-05-04', 'F'),
    ('identity00000014', 'sin000014', 'Ryan Cooper',     DATE '1990-12-01', 'M'),
    ('identity00000015', 'sin000015', 'Louis Wilson',    DATE '1990-01-11', 'M'),
    ('identity00000016', 'sin000016', 'Jennifer Parker', DATE '1970-01-15', 'F'),
    ('identity00000017', 'sin000017', 'Gerald White',    DATE '1996-06-28', 'M'),
    ('identity00000018', 'sin000018', 'Nicole Jackson',  DATE '1991-11-26', 'O'),
    ('identity00000019', 'sin000019', 'Nicholas Green',  DATE '1987-01-02', 'M');

INSERT INTO departments (`id`, `name`) VALUES
    ('department000000', 'Department ABC'),
    ('department000001', 'Department BCD'),
    ('department000002', 'Department CDE'),
    ('department000003', 'Department DEF'),
    ('department000004', 'Department EFG');

INSERT INTO employees (`iid`, `did`, `supervisor`, `address`, `phone`, `hourly`) VALUES
    ('identity00000000', 'department000000',  NULL,              '7791 Pumpkin Lane; Aberdeen, SD 57401',     '(816) 998-4706', 200.00),
    ('identity00000001', 'department000000', 'identity00000000', '219 University St.; Gwynn Oak, MD 21207',   '(602) 252-6805',  17.19),
    ('identity00000002', 'department000003', 'identity00000000', '9325 NE. Mayfair Lane; Natick, MA 01760',   '(660) 769-0493',  19.34),
    ('identity00000003', 'department000001', 'identity00000000', '672 Joy Ridge Dr.; Orland Park, IL 60462',  '(913) 947-6066',  42.21),
    ('identity00000004', 'department000002', 'identity00000003', '463 Euclid St.; Moncks Corner, SC 29461',   '(716) 561-1506',  20.00),
    ('identity00000005', 'department000000', 'identity00000000', '8147 Jones St.; Harbor Township, NJ 08234', '(146) 988-8914',  36.70),
    ('identity00000006', 'department000001', 'identity00000005', '7228 Lexington Court; Brentwood, NY 11717', '(478) 397-7314',  30.11),
    ('identity00000007', 'department000002', 'identity00000003', '12 East Primrose Ave.; Fairport, CT 06606', '(569) 955-1983',  21.90),
    ('identity00000008', 'department000003', 'identity00000005', '327 Hudson St.; Port Chester, NY 10573',    '(252) 772-3151',  14.54),
    ('identity00000009', 'department000004', 'identity00000005', '9111 Brook Hill Lane; Clarkston, MI 48348', '(833) 219-2099',  16.06);

INSERT INTO dependents (`iid`, `eid`) VALUES
    ('identity00000010', 'identity00000000'),
    ('identity00000011', 'identity00000001'),
    ('identity00000012', 'identity00000002'),
    ('identity00000013', 'identity00000003'),
    ('identity00000014', 'identity00000004'),
    ('identity00000015', 'identity00000005'),
    ('identity00000016', 'identity00000006'),
    ('identity00000017', 'identity00000007'),
    ('identity00000018', 'identity00000008'),
    ('identity00000019', 'identity00000009');

INSERT INTO managers (`eid`, `did`, `start`) VALUES
    ('identity00000000', 'department000000', DATE '2003-03-21'),
    ('identity00000000', 'department000003', DATE '2007-09-18'),
    ('identity00000003', 'department000001', DATE '2013-12-03'),
    ('identity00000003', 'department000002', DATE '2014-07-24'),
    ('identity00000005', 'department000004', DATE '2014-05-16');

INSERT INTO locations (`id`, `did`, `location`) VALUES
    ('location00000000', 'department000000', 'Location ABC'),
    ('location00000001', 'department000001', 'Location BCD'),
    ('location00000002', 'department000002', 'Location CDE'),
    ('location00000003', 'department000003', 'Location DEF'),
    ('location00000004', 'department000004', 'Location EFG');

INSERT INTO projects (`id`, `did`, `lid`, `name`, `lead`, `stage`) VALUES
    ('project000000000', 'department000004', 'location00000004', 'Project ABC', 'identity00000009', 3),
    ('project000000001', 'department000001', 'location00000003', 'Project BCD', 'identity00000003', 1),
    ('project000000002', 'department000002', 'location00000002', 'Project CDE', 'identity00000004', 2),
    ('project000000003', 'department000003', 'location00000001', 'Project DEF', 'identity00000008', 1),
    ('project000000004', 'department000000', 'location00000000', 'Project EFG', 'identity00000005', 0);

INSERT INTO assignments (`eid`, `pid`, `hours`) VALUES
    ('identity00000000', 'project000000000',  210.00),
    ('identity00000001', 'project000000001', 1060.00),
    ('identity00000001', 'project000000004',  340.25),
    ('identity00000002', 'project000000002', 1060.00),
    ('identity00000003', 'project000000003',  990.50),
    ('identity00000004', 'project000000004', 1100.00),
    ('identity00000004', 'project000000002', 3040.00),
    ('identity00000005', 'project000000003',  670.00),
    ('identity00000006', 'project000000002', 1270.25),
    ('identity00000007', 'project000000003',  300.00),
    ('identity00000008', 'project000000001', 3420.00),
    ('identity00000008', 'project000000004',   40.50),
    ('identity00000008', 'project000000002',  180.50),
    ('identity00000009', 'project000000003', 1300.00);
