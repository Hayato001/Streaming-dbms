USE streamdb;

-- Insert Ratings
INSERT INTO Rating (ratingID) VALUES
('G'), ('NO RATING'), ('NR'), ('PG'), ('PG-13'), ('R');

-- Insert Length Categories
INSERT INTO Length (lengthID, lengthCategory) VALUES
(1, 'Short'),
(2, 'Feature'),
(3, 'Long'),

-- Insert Genres
INSERT INTO Genre (genreID, genreName) VALUES
(1, 'Action'),
(2, 'Comedy'),
(3, 'Sci-Fi'),
(4, 'Drama'),

-- Insert Some Sample Films
INSERT INTO Film (title, releaseYear, filmDescription, genreID, lengthID, ratingID) VALUES
('Test Movie', 2022, 'A movie used for testing database loads.', 2, 2, 'PG'),
('Data Loader', 2001, 'Will the data load successfully?', 3, 3, 'PG'),
('Numbers', 2000, '1, 2, 3 yo', 4, 1, 'R'),
('Yell', 1999, 'GRAAAH', 1, 2, 'PG-13'),
('Mystery', NULL, '', 2, 2, 'NO RATING');

-- Insert Series Relationships
-- (example, linking prequels and sequels if any)
-- Example:
-- INSERT INTO Series (prequelID, sequelID) VALUES (1, 2);


-- Insert Admin User
INSERT INTO Admin (username, passwordHash)
VALUES ('admin', '$2y$12$JkwDnWhSMSEtsthu3DlEtOFVxbcpsupfOT0.0yZsopOyu1Pdgokq2');
