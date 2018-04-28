CREATE TABLE Movie(
	id int unique,
	title varchar(100) NOT NULL,
	year int,
	rating varchar(10),
	company varchar(50),
	PRIMARY KEY (id)  -- id must be unique
) ENGINE=INNODB;

CREATE TABLE Actor(
	id int unique,
	last varchar(20),
	first varchar(20),
	sex varchar(6),
	dob DATE NOT NULL, -- dob cannot be null
	dod DATE,
	PRIMARY KEY (id)  -- id must be unique
) ENGINE=INNODB;

CREATE TABLE Director(
	id int,
	last varchar(20),
	first varchar(20),
	dob DATE NOT NULL, -- dob cannot be null
	dod DATE,
	PRIMARY KEY (id)  -- id must be unique
) ENGINE=INNODB;

CREATE TABLE MovieGenre(
	mid int,
	genre varchar(20),
	FOREIGN KEY (mid) references Movie(id) -- movie must exist
) ENGINE=INNODB;

CREATE TABLE MovieDirector(
	mid int,
	did int,
	-- PRIMARY KEY (mid),  -- mid must be unique
	FOREIGN KEY (mid) references Movie(id), -- movie must exist
	FOREIGN KEY (did) references Director(id) -- director must exist
) ENGINE=INNODB;

CREATE TABLE MovieActor(
	mid int,
	aid int,
	role varchar(50),
	FOREIGN KEY (mid) references Movie(id), -- movie must exist
	FOREIGN KEY (aid) references Actor(id) -- actor must exist
) ENGINE=INNODB;


CREATE TABLE Review(
	name varchar(20),
	time timestamp,
	mid int,
	rating int,
	comment varchar(500),
	-- PRIMARY KEY (mid),  -- mid must be unique
	FOREIGN KEY (mid) references Movie(id) -- movie must exist
) ENGINE=INNODB;

CREATE TABLE MaxPersonID(id int);
CREATE TABLE MaxMovieID(id int);
