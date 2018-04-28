-- find the names of all the actors in the movie 'Die Another Day'.
SELECT CONCAT( first, ' ', last ) as name FROM Actor a, Movie m, MovieActor c
WHERE m.title = 'Die Another Day' and c.aid = a.id and m.id = c.mid;

-- Give me the count of all the actors who acted in multiple movies.
select count(*) from (
    select ma.aid, count(*) from Movie mv, MovieActor ma
    where ma.mid = mv.id
    group by ma.aid
    having count(*) > 1 
) as actors;

-- find all the last names of actors who are females
SELECT last as "last name" from Actor
WHERE Actor.sex = 'Female';

-- find all the titles of comedy movies
SELECT x.title from (SELECT genre, id, title FROM MovieGenre m, Movie mv
WHERE m.genre = 'Comedy' and m.mid = mv.id) as x;
