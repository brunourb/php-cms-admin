-- Created by Vertabelo (http://vertabelo.com)
-- Last modification date: 2018-05-28 03:03:34.129

-- tables
-- Table: banner
CREATE TABLE banner (
    id int NOT NULL AUTO_INCREMENT,
    name_clean varchar(50) NOT NULL,
    description varchar(100) NOT NULL,
    url varchar(255) NOT NULL,
    position varchar(20) NULL,
    date_created timestamp NOT NULL,
    page_id int NOT NULL,
    interval_init timestamp NULL,
    interlval_end timestamp NULL,
    CONSTRAINT banner_pk PRIMARY KEY (id)
);

-- Table: content
CREATE TABLE content (
    id int NOT NULL AUTO_INCREMENT,
    name_generate varchar(255) NOT NULL,
    description varchar(255) NOT NULL,
    title varchar(100) NOT NULL,
    caption varchar(100) NOT NULL,
    url varchar(255) NOT NULL,
    image_video_id int NOT NULL,
    CONSTRAINT content_pk PRIMARY KEY (id)
);

-- Table: gallery
CREATE TABLE gallery (
    id int NOT NULL AUTO_INCREMENT,
    description varchar(100) NOT NULL,
    enabled tinyint(1) NOT NULL,
    banner_id int NULL,
    page_details_id int NULL,
    room_id int NULL,
    CONSTRAINT gallery_pk PRIMARY KEY (id)
);

-- Table: hotel
CREATE TABLE hotel (
    id int NOT NULL AUTO_INCREMENT,
    description varchar(100) NOT NULL,
    enabled tinyint(1) NULL,
    CONSTRAINT hotel_pk PRIMARY KEY (id)
);

-- Table: image_video
CREATE TABLE image_video (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    description varchar(255) NULL,
    type enum('image', 'video') NOT NULL,
    enabled tinyint(1) NOT NULL,
    url varchar(255) NULL,
    gallery_id int NOT NULL,
    CONSTRAINT image_video_pk PRIMARY KEY (id)
);

CREATE INDEX image_video_idx_1 ON image_video (description,name);

-- Table: menu
CREATE TABLE menu (
    id int NOT NULL AUTO_INCREMENT,
    description varchar(50) NOT NULL,
    enabled tinyint(1) NULL,
    data_created timestamp NOT NULL,
    menu_id int NULL,
    CONSTRAINT menu_pk PRIMARY KEY (id)
);

CREATE INDEX menu_idx ON menu (description);

-- Table: page
CREATE TABLE page (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(100) NOT NULL,
    name_clean varchar(50) NULL,
    menu_id int NOT NULL,
    enabled tinyint(1) NOT NULL,
    CONSTRAINT page_pk PRIMARY KEY (id)
);

CREATE INDEX page_idx_1 ON page (name);

-- Table: page_details
CREATE TABLE page_details (
    id int NOT NULL AUTO_INCREMENT,
    description varchar(45) NOT NULL,
    value text NULL,
    enabled tinyint(1) NULL,
    page_id int NOT NULL,
    CONSTRAINT page_details_pk PRIMARY KEY (id)
);

CREATE INDEX page_details_idx_1 ON page_details (description);

-- Table: room
CREATE TABLE room (
    id int NOT NULL AUTO_INCREMENT,
    description int NOT NULL,
    enabled tinyint(1) NULL,
    hotel_id int NOT NULL,
    CONSTRAINT room_pk PRIMARY KEY (id)
);

CREATE INDEX room_idx_1 ON room (description);

-- Table: tag
CREATE TABLE tag (
    id int NOT NULL AUTO_INCREMENT,
    tag varchar(45) NOT NULL,
    enabled tinyint(1) NOT NULL,
    page_id int NOT NULL,
    CONSTRAINT tag_pk PRIMARY KEY (id)
);

-- Table: tag_values
CREATE TABLE tag_values (
    id int NOT NULL AUTO_INCREMENT,
    value varchar(255) NOT NULL,
    tag_id int NOT NULL,
    CONSTRAINT tag_values_pk PRIMARY KEY (id)
);

-- Table: tariff
CREATE TABLE tariff (
    id int NOT NULL AUTO_INCREMENT,
    description varchar(100) NOT NULL,
    date_init date NULL,
    date_end int NULL,
    enabled tinyint(1) NULL,
    CONSTRAINT tariff_pk PRIMARY KEY (id)
);

-- Table: tariff_values
CREATE TABLE tariff_values (
    id int NOT NULL AUTO_INCREMENT,
    kind_of_host enum('SGLDBL', 'ADC','CHD') NOT NULL,
    kind_of_room enum('APTO', 'SUITE') NOT NULL,
    value decimal(9,2) NOT NULL,
    breakfast tinyint(1) NULL,
    lunch tinyint(1) NULL,
    dinner tinyint(1) NULL,
    tariff_id int NOT NULL,
    hotel_id int NOT NULL,
    CONSTRAINT tariff_values_pk PRIMARY KEY (id)
);

-- foreign keys
-- Reference: Table_38_image_video (table: content)
ALTER TABLE content ADD CONSTRAINT Table_38_image_video FOREIGN KEY Table_38_image_video (image_video_id)
    REFERENCES image_video (id);

-- Reference: banner_page (table: banner)
ALTER TABLE banner ADD CONSTRAINT banner_page FOREIGN KEY banner_page (page_id)
    REFERENCES page (id);

-- Reference: gallery_banner (table: gallery)
ALTER TABLE gallery ADD CONSTRAINT gallery_banner FOREIGN KEY gallery_banner (banner_id)
    REFERENCES banner (id);

-- Reference: gallery_page_details (table: gallery)
ALTER TABLE gallery ADD CONSTRAINT gallery_page_details FOREIGN KEY gallery_page_details (page_details_id)
    REFERENCES page_details (id);

-- Reference: gallery_room (table: gallery)
ALTER TABLE gallery ADD CONSTRAINT gallery_room FOREIGN KEY gallery_room (room_id)
    REFERENCES room (id);

-- Reference: hotels_details_hotels (table: page_details)
ALTER TABLE page_details ADD CONSTRAINT hotels_details_hotels FOREIGN KEY hotels_details_hotels (page_id)
    REFERENCES page (id);

-- Reference: image_video_gallery (table: image_video)
ALTER TABLE image_video ADD CONSTRAINT image_video_gallery FOREIGN KEY image_video_gallery (gallery_id)
    REFERENCES gallery (id);

-- Reference: menu_menu (table: menu)
ALTER TABLE menu ADD CONSTRAINT menu_menu FOREIGN KEY menu_menu (menu_id)
    REFERENCES menu (id);

-- Reference: page_menu (table: page)
ALTER TABLE page ADD CONSTRAINT page_menu FOREIGN KEY page_menu (menu_id)
    REFERENCES menu (id);

-- Reference: room_hotel (table: room)
ALTER TABLE room ADD CONSTRAINT room_hotel FOREIGN KEY room_hotel (hotel_id)
    REFERENCES hotel (id);

-- Reference: room_values_tariff (table: tariff_values)
ALTER TABLE tariff_values ADD CONSTRAINT room_values_tariff FOREIGN KEY room_values_tariff (tariff_id)
    REFERENCES tariff (id);

-- Reference: tag_page (table: tag)
ALTER TABLE tag ADD CONSTRAINT tag_page FOREIGN KEY tag_page (page_id)
    REFERENCES page (id);

-- Reference: tag_values_tag (table: tag_values)
ALTER TABLE tag_values ADD CONSTRAINT tag_values_tag FOREIGN KEY tag_values_tag (tag_id)
    REFERENCES tag (id);

-- Reference: tariff_values_hotel (table: tariff_values)
ALTER TABLE tariff_values ADD CONSTRAINT tariff_values_hotel FOREIGN KEY tariff_values_hotel (hotel_id)
    REFERENCES hotel (id);

-- End of file.

