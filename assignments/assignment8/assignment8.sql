-- Part 1
USE vannieke_football_db;

-- makeshift reset
DELETE FROM games
WHERE id > 19;
ALTER TABLE games AUTO_INCREMENT = 19;

-- 1
CREATE OR REPLACE VIEW football_schedule AS
SELECT SUBSTR(DAYNAME(games.date), 1, 3) day, games.date, 
teams.name home, a.name away,
venues.name venue
FROM games
JOIN teams
ON games.home_team_id = teams.id 
JOIN teams a
ON games.away_team_id = a.id
JOIN venues
ON games.venue_id = venues.id
ORDER BY games.date ASC;

SELECT * FROM football_schedule;

-- 2
INSERT INTO venues (name, city)
SELECT 'Folsom Field', 'Boulder' 
WHERE NOT EXISTS (SELECT * FROM venues WHERE name = 'Folsom Field');

INSERT INTO games (date, home_team_id, away_team_id, venue_id)
SELECT '2017-11-18', 7, 4, 10
WHERE NOT EXISTS (	SELECT * FROM games
					WHERE date = '2017-11-18'
                    AND home_team_id = 7
                    AND away_team_id = 4
                    AND venue_id = 10);

INSERT INTO games (date, home_team_id, away_team_id, venue_id)
SELECT '2017-11-18', 9, 6, 8
WHERE NOT EXISTS (	SELECT * FROM games
					WHERE date = '2017-11-18'
                    AND home_team_id = 9
                    AND away_team_id = 6
                    AND venue_id = 8);

-- 3
UPDATE games 
SET date = '2017-11-11', away_team_id = 1
WHERE date = '2017-11-18'
AND home_team_id = 7
AND away_team_id = 4;

-- 4
DELETE FROM games 
WHERE date = '2017-11-18'
AND home_team_id = 9
AND away_team_id = 6;

-- 5
SELECT venues.id, venues.name, 
(SELECT COUNT(games.venue_id) FROM games WHERE games.venue_id = venues.id) AS game_count
FROM venues
ORDER BY venues.id ASC;

SELECT * FROM football_schedule;


-- Part 2
USE vannieke_dvd_db;

-- 1
CREATE OR REPLACE VIEW dramas AS
SELECT dvd_title_id, title, release_date, award, formats.format, genres.genre, labels.label, ratings.rating, sounds.sound
FROM dvd_titles
JOIN formats USING (format_id)
JOIN genres USING (genre_id)
JOIN labels USING (label_id)
JOIN ratings USING (rating_id)
JOIN sounds USING (sound_id)
WHERE genre_id = 9
AND release_date IS NOT NULL;

SELECT * FROM dramas;

-- 2
INSERT INTO dvd_titles (title, release_date, award, label_id, sound_id, genre_id, rating_id, format_id)
SELECT 'The Godfather', '1972-03-24', '45th Academy Award for Best Picture', 92, 4, 9, 7, 2
WHERE NOT EXISTS (SELECT * FROM dvd_titles WHERE title = 'The Godfather');

-- 3
UPDATE dvd_titles
SET label_id = 24, genre_id = 7, format_id = 4
WHERE dvd_title_id = 5131;

-- 4
DELETE FROM dvd_titles
WHERE dvd_title_id = '5932';

-- 5
SELECT MAX(LENGTH(title)) AS longest_title, MIN(LENGTH(title)) AS shortest_title
FROM dvd_titles;

-- 6
SELECT genre_id, genre,
(SELECT COUNT(dvd_titles.genre_id) FROM dvd_titles WHERE dvd_titles.genre_id = genres.genre_id) AS dvd_count
FROM genres
ORDER BY genre_id ASC;