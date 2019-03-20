SELECT *
FROM albums
WHERE title LIKE '%on%'
ORDER BY title ASC;

SELECT albums.title, artists.name
FROM albums
JOIN artists
ON albums.artist_id = artists.artist_id
WHERE title LIKE '%on%'
ORDER BY title ASC;

SELECT tracks.name AS track_name, tracks.composer, media_types.name AS media_type, tracks.unit_price
FROM tracks
JOIN media_types
ON tracks.media_type_id = media_types.media_type_id
WHERE tracks.media_type_id = 5;

SELECT tracks.track_id, tracks.name AS track_name, tracks.composer, tracks.milliseconds, genres.name AS genre_name
FROM tracks
JOIN genres
ON tracks.genre_id = genres.genre_id
WHERE (tracks.genre_id = 2 OR tracks.genre_id = 14)
AND tracks.composer IS NOT NULL
ORDER BY tracks.name DESC;