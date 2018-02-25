-- Created by Vertabelo (http://vertabelo.com)
-- Last modification date: 2018-02-19 05:40:58.744

-- tables
-- Table: banner
CREATE TABLE banner (
    id int NOT NULL,
    name_clean varchar(50) NOT NULL,
    description varchar(100) NOT NULL,
    link varchar(255) NOT NULL,
    position varchar(20) NULL,
    date_created timestamp NOT NULL,
    page_id int NOT NULL,
    interval_init timestamp NULL,
    interlval_end timestamp NULL,
    CONSTRAINT banner_pk PRIMARY KEY (id)
);

-- Table: banner_image
CREATE TABLE banner_image (
    id int NOT NULL,
    name varchar(45) NOT NULL,
    location varchar(255) NOT NULL,
    priority varchar(20) NULL,
    type varchar(100) NULL,
    date_init date NULL,
    date_end date NULL,
    banner_id int NOT NULL,
    CONSTRAINT banner_image_pk PRIMARY KEY (id)
);

-- Table: hotel
CREATE TABLE hotel (
    id int NOT NULL,
    description varchar(100) NOT NULL,
    enabled tinyint(1) NULL,
    tariff_id int NOT NULL,
    CONSTRAINT hotel_pk PRIMARY KEY (id)
);

-- Table: image
CREATE TABLE image (
    id int NOT NULL,
    type varchar(50) NULL,
    description varchar(200) NOT NULL,
    name_generate varchar(255) NULL,
    code varchar(50) NULL,
    location varchar(255) NOT NULL,
    enabled tinyint(1) NULL,
    page_details_id int NOT NULL,
    CONSTRAINT image_pk PRIMARY KEY (id)
);

-- Table: menu
CREATE TABLE menu (
    id int NOT NULL,
    description varchar(50) NOT NULL,
    enabled tinyint(1) NULL,
    data_created timestamp NOT NULL,
    menu_id int NULL,
    CONSTRAINT menu_pk PRIMARY KEY (id)
);

-- Table: page
CREATE TABLE page (
    id int NOT NULL,
    name varchar(100) NOT NULL,
    name_clean varchar(50) NULL,
    menu_id int NOT NULL,
    enabled tinyint(1) NOT NULL,
    CONSTRAINT page_pk PRIMARY KEY (id)
);

-- Table: page_details
CREATE TABLE page_details (
    id int NOT NULL,
    description varchar(45) NOT NULL,
    value text NULL,
    enabled tinyint(1) NULL,
    page_id int NOT NULL,
    CONSTRAINT page_details_pk PRIMARY KEY (id)
);

-- Table: room
CREATE TABLE room (
    id int NOT NULL,
    description int NOT NULL,
    enabled tinyint(1) NULL,
    hotel_id int NOT NULL,
    CONSTRAINT room_pk PRIMARY KEY (id)
);

-- Table: room_values
CREATE TABLE room_values (
    id int NOT NULL,
    description varchar(100) NOT NULL,
    value decimal(9,2) NOT NULL,
    breakfast tinyint(1) NULL,
    lunch tinyint(1) NULL,
    dinner tinyint(1) NULL,
    room_id int NOT NULL,
    CONSTRAINT room_values_pk PRIMARY KEY (id)
);

-- Table: tag
CREATE TABLE tag (
    id int NOT NULL,
    tag varchar(45) NOT NULL,
    enabled tinyint(1) NOT NULL,
    page_id int NOT NULL,
    CONSTRAINT tag_pk PRIMARY KEY (id)
);

-- Table: tag_values
CREATE TABLE tag_values (
    id int NOT NULL,
    value text NOT NULL,
    tag_id int NOT NULL,
    CONSTRAINT tag_values_pk PRIMARY KEY (id)
);

-- Table: tariff
CREATE TABLE tariff (
    id int NOT NULL,
    description varchar(100) NOT NULL,
    date_init date NULL,
    date_end int NULL,
    enabled tinyint(1) NULL,
    CONSTRAINT tariff_pk PRIMARY KEY (id)
);

-- foreign keys
-- Reference: banner_image_banner (table: banner_image)
ALTER TABLE banner_image ADD CONSTRAINT banner_image_banner FOREIGN KEY banner_image_banner (banner_id)
    REFERENCES banner (id);

-- Reference: banner_page (table: banner)
ALTER TABLE banner ADD CONSTRAINT banner_page FOREIGN KEY banner_page (page_id)
    REFERENCES page (id);

-- Reference: hotels_details_hotels (table: page_details)
ALTER TABLE page_details ADD CONSTRAINT hotels_details_hotels FOREIGN KEY hotels_details_hotels (page_id)
    REFERENCES page (id);

-- Reference: image_page_details (table: image)
ALTER TABLE image ADD CONSTRAINT image_page_details FOREIGN KEY image_page_details (page_details_id)
    REFERENCES page_details (id);

-- Reference: menu_menu (table: menu)
ALTER TABLE menu ADD CONSTRAINT menu_menu FOREIGN KEY menu_menu (menu_id)
    REFERENCES menu (id);

-- Reference: page_menu (table: page)
ALTER TABLE page ADD CONSTRAINT page_menu FOREIGN KEY page_menu (menu_id)
    REFERENCES menu (id);

-- Reference: room_hotel (table: room)
ALTER TABLE room ADD CONSTRAINT room_hotel FOREIGN KEY room_hotel (hotel_id)
    REFERENCES hotel (id);

-- Reference: room_values_room (table: room_values)
ALTER TABLE room_values ADD CONSTRAINT room_values_room FOREIGN KEY room_values_room (room_id)
    REFERENCES room (id);

-- Reference: tag_page (table: tag)
ALTER TABLE tag ADD CONSTRAINT tag_page FOREIGN KEY tag_page (page_id)
    REFERENCES page (id);

-- Reference: tag_values_tag (table: tag_values)
ALTER TABLE tag_values ADD CONSTRAINT tag_values_tag FOREIGN KEY tag_values_tag (tag_id)
    REFERENCES tag (id);

-- Reference: tariff_values_tariff (table: hotel)
ALTER TABLE hotel ADD CONSTRAINT tariff_values_tariff FOREIGN KEY tariff_values_tariff (tariff_id)
    REFERENCES tariff (id);

-- End of file.

