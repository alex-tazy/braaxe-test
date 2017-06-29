create database if not exists IMDB character set utf8 collate utf8_unicode_ci;
use IMDB;

grant all privileges on IMDB.* to 'alex'@'localhost' identified by 'alex';

drop table if exists actor;
drop table if exists movie;
drop table if exists person;

create table person (
  person_id integer not null primary key auto_increment,
  person_name varchar(100) not null,
  person_firstName varchar(100) not null,
  person_birthDate date not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table movie (
  movie_id integer not null primary key auto_increment,
  movie_title varchar(100) not null,
  movie_synopsis varchar(2000) not null,
  movie_date date not null,
  movie_poster varchar(100) null,
  movie_director integer not null,
  constraint fk_movie_director foreign key(movie_director) references person(person_id)
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table actor (
  actor_id integer not null primary key auto_increment,
  actor_person integer not null,
  actor_movie integer not null,
  constraint fk_actor_person foreign key(actor_person) references person(person_id),
  constraint fk_actor_movie foreign key(actor_movie) references movie(movie_id)
) engine=innodb character set utf8 collate utf8_unicode_ci;

insert into person values
  (1, 'Scott', 'Ridley', '1937-11-30');
insert into person values
  (2, 'Cameron', 'James', '1954-08-16');
insert into person values
  (3, 'Crowe', 'Russell', '1964-04-07');
insert into person values
  (4, 'Phoenix', 'Joaquin', '1974-10-28');

insert into movie values
  (1, 'Gladiator', 'When a Roman general is betrayed and his family murdered by an emperor''s corrupt son, he comes to Rome as a gladiator to seek revenge.', '2000-06-01', 'uploads/glad.jpg', 1);
insert into movie values
  (2, 'Lorem ipsum', 'Lorem ipsum dolorNunc vitae pulvinar odio, iaculis, hendrerit vulputate lorem vestibulum. Suspendisse pulvinar, purus at rutrum diam et dictum. Sed tellus iolutpat nunc. Praesent nec accumsan nisi, in hendrerit nibh. ', '2017-06-01', 'uploads/fond.jpg', 2);
insert into movie values
  (3, 'Lorem ipsum in french', "J’en dis autax devores, et que rien ne nous empêche de faire ce qui peut nous donner le plus de plaisir, nous pouvons nous livrer entièrement à la volupté et chasser toute sorte de douleur ; mais, dans les temps destinés aux devoirs de la société ou à la nécessité des affaires, souvent il faut faire divorce avec la volupté, et ne se point refuser à la peine. La règle que suit en cela un homme sage, c’est de renoncer à de légères voluptés pour en avoir de plus grandes, et de savoir supporter des douleurs légères pour en éviter de plus fâcheuses.", '2017-06-01', '', 1);

insert into actor values
  (1, 3, 1);
insert into actor values
  (2, 4, 1)