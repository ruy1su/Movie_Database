-- For Movie
insert into	Movie value(489,NULL,1961,"PG","Paramount Pictures"); -- violates the NOT NULL constraints / Column 'title' cannot be null

insert into	Movie value(489,"Blue Hawaii",1961,"PG","Paramount Pictures"); -- violates the primary key constraints / Duplicate entry '489' for key 'PRIMARY'

-- For Actor
insert into Actor value (246,"Adams","Edie","Female",NULL,\N);  -- violates the NOT NULL constraints / Column 'dob' cannot be null

insert into Actor value (246,"Adams","Edie","Female",19270416,\N); -- violates the primary key constraints / Duplicate entry '246' for key 'PRIMARY'


-- For Director 
insert into Director value (45162,"Neretniece","Ada",NULL,\N); -- violates the NOT NULL constraints / Column 'dob' cannot be null

insert into Director value (45162,"Neretniece","Ada",19240602,\N); -- violates the primary key constraints / Duplicate entry '45162' for key 'PRIMARY'

-- For MovieGenre
insert into MovieGenre value (100000123,"Thriller"); -- violates the foreign key / Cannot add or update a child row: a foreign key constraint fails (`CS143`.`MovieGenre`, CONSTRAINT `MovieGenre_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

insert into MovieGenre value (8,"Thriller"); -- violates the primary key constraints / Duplicate entry '8' for key 'PRIMARY'


-- For MovieActor
insert into MovieActor value (323200000,5316600000,"Prison Guard"); -- violates the foreign key constraints / Cannot add or update a child row: a foreign key constraint fails (`CS143`.`MovieActor`, CONSTRAINT `MovieActor_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

insert into MovieActor value (3232,53166,"Prison Guard"); -- violates the primary key constraints / Duplicate entry '3232' for key 'PRIMARY'


-- For MovieDirector
insert into MovieDirector value (219700000,114100000); -- violates the foreigh key / Cannot add or update a child row: a foreign key constraint fails (`CS143`.`MovieDirector`, CONSTRAINT `MovieDirector_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

insert into MovieDirector value (2197,1141); -- violates the primary key constraints Duplicate entry '2197' for key 'PRIMARY'