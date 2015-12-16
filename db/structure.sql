drop table if exists movie;
drop table if exists category;

create table category (
    cat_id integer not null primary key auto_increment,
    cat_name varchar(100) not null 
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table movie (
    mov_id integer not null primary key auto_increment,
    mov_title varchar(100) not null,
    mov_description_short varchar(500) not null,
    mov_description_long varchar(2000) not null,
    mov_director varchar(150) not null,
    mov_year integer not null,
    mov_image varchar(150),
    cat_id integer not null,
    constraint fk_mov_cat foreign key(cat_id) references category(cat_id)
) engine=innodb character set utf8 collate utf8_unicode_ci;