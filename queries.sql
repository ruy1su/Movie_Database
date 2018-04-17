SELECT s.name from (SELECT CONCAT( first, ' ', last ) as name, title, aid FROM Actor a, Movie m, MovieActor c
WHERE m.title = 'Die Another Day' and c.aid = a.id and m.id = c.mid) s;
-- find the names of all the actors in the movie 'Die Another Day'.

SELECT count(*) from 
(SELECT a.last, a.id, ma.aid, title from Actor a, MovieActor ma, Movie m
WHERE a.id = ma.aid and ma.mid = m.id 
group by a.id 
having count(*) > 1) x;
-- Give me the count of all the actors who acted in multiple movies.

SELECT count(*) from 
(SELECT d.last, d.id, md.mid, title from Director d, MovieDirector md, Movie m
WHERE d.id = md.did and md.mid = m.id 
group by d.id 
having count(*) > 4) x;
-- Give the count of all the directors who directed at least 4 movies.

SELECT last as "last name" from Actor
WHERE Actor.sex = 'Female';
-- find all the last names of actors who are females

SELECT x.title from (SELECT genre, id, title FROM MovieGenre m, Movie mv
WHERE m.genre = 'Comedy' and m.mid = mv.id) as x;
-- find all the titles of comedy movies