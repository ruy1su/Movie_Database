CS143 Database Project 1C

In previous project we have learnt how to build a specific database, load data from database, and learnt how to extract data from database using mysql queries. We also build a web interface for users to input queries and see the results using PHP.

First, we set up the system on virtual box and set up the shared folder to easily manage files.

Second, we intialize the database and create the tables(Movie table, Actor table, etc.) for provided data.

Third, we load and query the dataset.

Next, we create a web interface using php. Users can access it from http://localhost:1438/~cs143/

Then we modify and add the constraints to enforce the data integerity.

In this extended project based on 1B, we build a complete and fancy website to interact with our database.

We have 8 pages to met the requirements of this project.Home page, Actor/Director adding page, Movie Info Adding page, Movie/Actor relation adding page, Movie/Director adding page, Actor finding page, Movie Finding page, Movie/Actor Search page.

For all pages, we include a navigation.php, in which it shows the navigation bar. We also add a all.css to include some fancy UI stuffs.

Index.php includes home page code;
navigation.php includes the navigation bar code;
Add_M_D_R queries the movie titles and year from database Movie, director name and birthday from database Director, we then add them into the MovieDirector database;

Add_M_A_R queries the movie titles and year from database Movie, Actor name and birthday from database Actor, user can also input role for actor in this Movie, we then add them into the MovieActor database;

Both Add_M_D_R.php and Add_M_A_R.php uses _movie_list.php to show the list of movies.

We create search.php to help user search the movies and actors according to a single keyword.

Show_A.php shows the actor tables by search the keyword input by user, after searching, user can see the tables of actors info represented in links. Users can click the link to see the actors’ information and their movies and roles.

Show_M.php shows the movie tables by search the keyword input by user. after searching, user can see the tables of movies info represented in links. User can click the link to see the movie’s information and their actors and corresponding roles. Also, users can add reviews by clicking the link we created:Be the first to add a review! or if there is a review: the link will be: Add another review. We also queries database to calculate the average rating of the movie.

addReview.php, we use href in Show_M.php to help user access this page. The href will carry the id of movie in the url. In this page, we get the movie id number from the url and add the users’ reviews and users’ name&ratings into the table: Review. After reviewing the movie, users can see an link to return to the movie information page to see their own reviews below the Movie info.

tables.inc: this is a class to create tables in html, we use variable type to create different tables: type 0: no link, type 1:show link for actors, type 2:show link for movies.

add.php: add actors and directors into database;

addMovie.php: add movies into database;

I and Shunji Worked together and closely to complete this project. we focused a lot on UI part and it turns out the ui is beautiful and useful. We split the work on query codes in php: save or load info from database. The table.inc is created by Shunji, which is a really great idea to help us create different types of tables. I think both of us did a good job.

By Zixia Weng, Shunji Zhan on Apr.27.2018
