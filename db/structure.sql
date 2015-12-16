create database if not exists microcms character set utf8 collate utf8_unicode_ci;

use microcms;


grant all privileges on microcms.* to 'microcms_user'@'localhost' identified by 'secret';


structure.

drop table if exists movie;


create table movie (

art_id integer not null primary key auto_increment,

art_title varchar(100) not null,

art_content varchar(2000) not null

) engine=innodb character set utf8 collate utf8_unicode_ci;

drop table if exists t_comment;
drop table if exists t_user;
drop table if exists movie;

create table movie (
    art_id integer not null primary key auto_increment,
    art_title varchar(100) not null,
    art_content varchar(2000) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table t_user (
    usr_id integer not null primary key auto_increment,
    usr_name varchar(50) not null,
    usr_password varchar(88) not null,
    usr_salt varchar(23) not null,
    usr_role varchar(50) not null 
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table t_comment (
    com_id integer not null primary key auto_increment,
    com_content varchar(500) not null,
    art_id integer not null,
    usr_id integer not null,
    constraint fk_com_art foreign key(art_id) references movie(art_id),
    constraint fk_com_usr foreign key(usr_id) references t_user(usr_id)
) engine=innodb character set utf8 collate utf8_unicode_ci;