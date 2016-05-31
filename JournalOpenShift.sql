show databases;
show tables;

create table user (
  id int auto_increment primary key,
  username varchar(50),
  password varchar(100),
  emailAddress varchar(100),
  accountCreateDate date,
  dataUsed int,
  journalCount int,
  entryCount int
);
explain user;

create table journal (
  id int auto_increment primary key, 
  userId int, 
  name varchar(20), 
  createDate date, 
  foreign key (userId) references user(id)
  );
explain journal;
--drop table journal;

create table entry (
  id int auto_increment primary key, 
  journalId int, 
  userId int, 
  createDate date, 
  text text, 
  foreign key (userId) references user(id), 
  foreign key (journalId) references journal(id)
  );
explain entry;
--drop table entry;


insert into user (username, password, emailAddress, accountCreateDate) 
values ('normanLevy', 'hardPassword', 'normanLevy1290@gmail.com', '2016-05-17');
insert into user (username, password, emailAddress, accountCreateDate) 
values ('darthvader', 'joinTheDarkside', 'notsureiwanttosignuphere@gmail.com', '2016-05-23');

insert into journal (userId, name, createDate) 
values (1, 'My First Journal', '2016-05-17');
insert into journal (userId, name, createDate) 
values (1, 'Reflective Journal', '2016-05-23');
insert into journal (userId, name, createDate) 
values (1, 'School Notes', '2016-05-23');
insert into journal (userId, name, createDate) 
values (2, 'The Dark Side Rules', '2016-05-23');

insert into entry (journalId, userId, createDate, text) 
values (1, 1, '2016-05-17', 'This is the first entry!');
insert into entry (journalId, userId, createDate, text) 
values (1, 1, '2016-05-17', 'This is another entry into the journal named My First Journal whose journalId is 1.');
insert into entry (journalId, userId, createDate, text) 
values (2, 1, '2016-05-17', 'This is the first entry for the Reflective Journal!');
insert into entry (journalId, userId, createDate, text) 
values (3, 1, '2016-05-17', 'This is the first entry for the school journal!');
insert into entry (journalId, userId, createDate, text) 
values (4, 2, '2016-05-23', 'This is my journal about how the dark side rules. If anyone reads this without my permission they will be force choked.');
insert into entry (journalId, userId, createDate, text) 
values (4, 2, '2016-05-24', 'Today I finally told Luke I was his father. It did not go over well. I knew it was going to be awkward. I freaking cut off his hand! Gosh dangit! Why did it have to be so awkward!');

select * from user;
select * from user where id = 2;
select * from journal;
select * from journal where userId=2;
select * from entry;
select * from entry where userId = 2;
select * from entry where journalId=4;

select * from user where username="normanLevy" and password="hardPassword";