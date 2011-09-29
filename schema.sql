DROP TABLE IF EXISTS store;
CREATE TABLE store(
	s_id char(9) primary key,
	address varchar(256) not null
);

DROP TABLE IF EXISTS item;
CREATE TABLE item(
	i_id int(12) primary key, -- UPC barcode
	name varchar(256) not null,
	price decimal(8, 2) not null, --8 digits in total, and 2 digits after the decimal point	
	productionDate date not null,
	expiryDate date not null,
	producer varchar(256) not null,
	supplier varchar(256)
)

DROP TABLE IF EXISTS stock;
CREATE TABLE stock(
	s_id char(9) REFERENCES store(s_id) ON UPDATE CASCADE ON DELETE CASCADE,
	i_id int(12) REFERENCES item(i_id) ON UPDATE CASCADE ON DELETE CASCADE,
	quantity int(6) not null default 0,
	temp_quantity int(6) not null default 0,
	ceiling decimal(8,2) not null,
	floor decimal(8, 2) not null,
	pricing_var decimal(6,2) not null,
	primary key(s_id, i_id)
)

DROP TABLE IF EXISTS personnel;
CREATE TABLE personnel(
	p_id char(9) primary key,
	name varchar(256) not null,
	password varchar(32) not null,
	role varchar(64) not null,
	s_id char(9) REFERENCES store(s_id) ON UPDATE CASCADE ON DELETE CASCADE
);

DROP TABLE IF EXISTS member;
CREATE TABLE member(
	m_id int(8) primary key auto_increment,
	name varchar(256) not null,
	password varchar(32) not null,
	membership varchar(32) not null
)

DROP TABLE IF EXISTS transaction;
CREATE TABLE transaction(
	t_id int(12) primary key auto_increment,
	i_id int(12) REFERENCES item(i_id) ON UPDATE CASCADE ON DELETE CASCADE,
	s_id char(9) REFERNECES store(s_id) ON UPDATE CASCADE ON DELETE CASCADE,
	time datetime not null,
	quantity int(6) not null
)
