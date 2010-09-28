
-----------------------------------------------------------------------------
-- users
-----------------------------------------------------------------------------

DROP TABLE "users" CASCADE;


CREATE TABLE "users"
(
	"id" serial  NOT NULL,
	"login" VARCHAR(100)  NOT NULL,
	"password" VARCHAR(100)  NOT NULL,
	"password_salt" VARCHAR(100)  NOT NULL,
	"email" VARCHAR(100)  NOT NULL,
	"website_blog" VARCHAR(500),
	"avatar" VARCHAR(500),
	"gender" INTEGER default 0,
	"about" TEXT,
	"last_login" TIMESTAMP,
	"is_active" BOOLEAN default 'f' NOT NULL,
	"persistence_token" VARCHAR(200) default '',
	"is_super_admin" BOOLEAN default 'f' NOT NULL,
	"count_of_films" INTEGER default 0,
	"created_at" TIMESTAMP,
	"updated_at" TIMESTAMP,
	PRIMARY KEY ("id"),
	CONSTRAINT "users_U_1" UNIQUE ("login"),
	CONSTRAINT "users_U_2" UNIQUE ("email")
);

COMMENT ON TABLE "users" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- users_group
-----------------------------------------------------------------------------

DROP TABLE "users_group" CASCADE;


CREATE TABLE "users_group"
(
	"id" serial  NOT NULL,
	"name" VARCHAR(255)  NOT NULL,
	"description" TEXT,
	PRIMARY KEY ("id"),
	CONSTRAINT "users_group_U_1" UNIQUE ("name")
);

COMMENT ON TABLE "users_group" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- users_users_group
-----------------------------------------------------------------------------

DROP TABLE "users_users_group" CASCADE;


CREATE TABLE "users_users_group"
(
	"user_id" INTEGER  NOT NULL,
	"group_id" INTEGER  NOT NULL,
	PRIMARY KEY ("user_id","group_id")
);

COMMENT ON TABLE "users_users_group" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- users_remember_key
-----------------------------------------------------------------------------

DROP TABLE "users_remember_key" CASCADE;


CREATE TABLE "users_remember_key"
(
	"user_id" INTEGER  NOT NULL,
	"remember_key" VARCHAR(32),
	"ip_address" VARCHAR(50)  NOT NULL,
	"created_at" TIMESTAMP,
	PRIMARY KEY ("user_id","ip_address")
);

COMMENT ON TABLE "users_remember_key" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- film
-----------------------------------------------------------------------------

DROP TABLE "film" CASCADE;


CREATE TABLE "film"
(
	"id" serial  NOT NULL,
	"user_id" INTEGER  NOT NULL,
	"title" VARCHAR(500)  NOT NULL,
	"original_title" VARCHAR(500)  NOT NULL,
	"normal_logo" VARCHAR(255),
	"thumb_logo" VARCHAR(255),
	"url" VARCHAR(500),
	"pub_year" INTEGER,
	"director" VARCHAR(255),
	"cast_people" VARCHAR(1000),
	"about" TEXT,
	"country" VARCHAR(500),
	"duration" VARCHAR(500),
	"file_info" TEXT,
	"is_visible" BOOLEAN default 't' NOT NULL,
	"is_private" BOOLEAN default 'f' NOT NULL,
	"is_public" BOOLEAN default 'f' NOT NULL,
	"modified_user_id" INTEGER,
	"modified_at" TIMESTAMP,
	"modified_text" VARCHAR(500),
	"created_at" TIMESTAMP,
	"updated_at" TIMESTAMP,
	PRIMARY KEY ("id")
);

COMMENT ON TABLE "film" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- film_links
-----------------------------------------------------------------------------

DROP TABLE "film_links" CASCADE;


CREATE TABLE "film_links"
(
	"id" serial  NOT NULL,
	"film_id" INTEGER  NOT NULL,
	"title" VARCHAR(200)  NOT NULL,
	"url" VARCHAR(500)  NOT NULL,
	"sort" INTEGER default 0,
	"hash" VARCHAR(10),
	"created_at" TIMESTAMP,
	"updated_at" TIMESTAMP,
	PRIMARY KEY ("id","film_id")
);

COMMENT ON TABLE "film_links" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- film_types
-----------------------------------------------------------------------------

DROP TABLE "film_types" CASCADE;


CREATE TABLE "film_types"
(
	"id" serial  NOT NULL,
	"title" VARCHAR(500)  NOT NULL,
	"url" VARCHAR(500)  NOT NULL,
	"logo" VARCHAR(500)  NOT NULL,
	"description" TEXT,
	"is_visible" BOOLEAN default 't' NOT NULL,
	"is_not_main" BOOLEAN default 'f' NOT NULL,
	"created_at" TIMESTAMP,
	PRIMARY KEY ("id")
);

COMMENT ON TABLE "film_types" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- film_raiting
-----------------------------------------------------------------------------

DROP TABLE "film_raiting" CASCADE;


CREATE TABLE "film_raiting"
(
	"id" serial  NOT NULL,
	"film_id" INTEGER  NOT NULL,
	"user_id" INTEGER  NOT NULL,
	"rating" INTEGER default 1 NOT NULL,
	"created_at" TIMESTAMP,
	PRIMARY KEY ("id","film_id","user_id")
);

COMMENT ON TABLE "film_raiting" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- film_total_rating
-----------------------------------------------------------------------------

DROP TABLE "film_total_rating" CASCADE;


CREATE TABLE "film_total_rating"
(
	"id" serial  NOT NULL,
	"film_id" INTEGER  NOT NULL,
	"total_rating" DECIMAL(10,1) default 0 NOT NULL,
	PRIMARY KEY ("id")
);

COMMENT ON TABLE "film_total_rating" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- film_gallery
-----------------------------------------------------------------------------

DROP TABLE "film_gallery" CASCADE;


CREATE TABLE "film_gallery"
(
	"id" serial  NOT NULL,
	"film_id" INTEGER  NOT NULL,
	"thumb_img" VARCHAR(500)  NOT NULL,
	"normal_img" VARCHAR(500)  NOT NULL,
	"sort" INTEGER default 0,
	PRIMARY KEY ("id","film_id")
);

COMMENT ON TABLE "film_gallery" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- film_film_types
-----------------------------------------------------------------------------

DROP TABLE "film_film_types" CASCADE;


CREATE TABLE "film_film_types"
(
	"film_id" INTEGER  NOT NULL,
	"film_genre_id" INTEGER  NOT NULL,
	PRIMARY KEY ("film_id","film_genre_id")
);

COMMENT ON TABLE "film_film_types" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- film_trailer
-----------------------------------------------------------------------------

DROP TABLE "film_trailer" CASCADE;


CREATE TABLE "film_trailer"
(
	"id" serial  NOT NULL,
	"film_id" INTEGER  NOT NULL,
	"trailer_type" INTEGER default 0,
	"trailer_code" VARCHAR(500)  NOT NULL,
	"sort" INTEGER default 0,
	"created_at" TIMESTAMP,
	"updated_at" TIMESTAMP,
	PRIMARY KEY ("id","film_id")
);

COMMENT ON TABLE "film_trailer" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- comments
-----------------------------------------------------------------------------

DROP TABLE "comments" CASCADE;


CREATE TABLE "comments"
(
	"id" serial  NOT NULL,
	"user_id" INTEGER  NOT NULL,
	"film_id" INTEGER  NOT NULL,
	"description" TEXT,
	"ip" VARCHAR(100),
	"created_at" TIMESTAMP,
	"updated_at" TIMESTAMP,
	PRIMARY KEY ("id","film_id")
);

COMMENT ON TABLE "comments" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- messages
-----------------------------------------------------------------------------

DROP TABLE "messages" CASCADE;


CREATE TABLE "messages"
(
	"id" serial  NOT NULL,
	"from_user_id" INTEGER,
	"to_user_id" INTEGER  NOT NULL,
	"message_type" INTEGER  NOT NULL,
	"description" TEXT,
	"created_at" TIMESTAMP,
	"updated_at" TIMESTAMP,
	PRIMARY KEY ("id")
);

COMMENT ON TABLE "messages" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- user_friends
-----------------------------------------------------------------------------

DROP TABLE "user_friends" CASCADE;


CREATE TABLE "user_friends"
(
	"user_id" INTEGER  NOT NULL,
	"friend_id" INTEGER  NOT NULL,
	"commit" BOOLEAN default 'f' NOT NULL,
	PRIMARY KEY ("user_id")
);

COMMENT ON TABLE "user_friends" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- news
-----------------------------------------------------------------------------

DROP TABLE "news" CASCADE;


CREATE TABLE "news"
(
	"id" serial  NOT NULL,
	"title" VARCHAR(500)  NOT NULL,
	"url" VARCHAR(500),
	"description" TEXT,
	"is_visible" BOOLEAN default 't' NOT NULL,
	"created_at" TIMESTAMP,
	"updated_at" TIMESTAMP,
	PRIMARY KEY ("id")
);

COMMENT ON TABLE "news" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- film_news
-----------------------------------------------------------------------------

DROP TABLE "film_news" CASCADE;


CREATE TABLE "film_news"
(
	"id" serial  NOT NULL,
	"title" VARCHAR(500)  NOT NULL,
	"url" VARCHAR(500),
	"img" VARCHAR(500),
	"description" TEXT,
	"is_visible" BOOLEAN default 'f' NOT NULL,
	"created_at" TIMESTAMP,
	"updated_at" TIMESTAMP,
	PRIMARY KEY ("id")
);

COMMENT ON TABLE "film_news" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- afisha_country
-----------------------------------------------------------------------------

DROP TABLE "afisha_country" CASCADE;


CREATE TABLE "afisha_country"
(
	"id" serial  NOT NULL,
	"external_id" VARCHAR(500) default '',
	"title" VARCHAR(500)  NOT NULL,
	"created_at" TIMESTAMP,
	"updated_at" TIMESTAMP,
	PRIMARY KEY ("id")
);

COMMENT ON TABLE "afisha_country" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- afisha_city
-----------------------------------------------------------------------------

DROP TABLE "afisha_city" CASCADE;


CREATE TABLE "afisha_city"
(
	"id" serial  NOT NULL,
	"afisha_country_id" INTEGER  NOT NULL,
	"external_id" VARCHAR(500) default '',
	"title" VARCHAR(500)  NOT NULL,
	"created_at" TIMESTAMP,
	"updated_at" TIMESTAMP,
	PRIMARY KEY ("id")
);

COMMENT ON TABLE "afisha_city" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- afisha_theater
-----------------------------------------------------------------------------

DROP TABLE "afisha_theater" CASCADE;


CREATE TABLE "afisha_theater"
(
	"id" serial  NOT NULL,
	"external_id" VARCHAR(500) default '',
	"afisha_city_id" INTEGER  NOT NULL,
	"title" VARCHAR(500)  NOT NULL,
	"link" VARCHAR(255),
	"address" VARCHAR(500),
	"phone" VARCHAR(500),
	"description" TEXT,
	"created_at" TIMESTAMP,
	"updated_at" TIMESTAMP,
	"latitude" VARCHAR(50),
	"longitude" VARCHAR(50),
	"normal_telephone" VARCHAR(255),
	PRIMARY KEY ("id")
);

COMMENT ON TABLE "afisha_theater" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- afisha_film
-----------------------------------------------------------------------------

DROP TABLE "afisha_film" CASCADE;


CREATE TABLE "afisha_film"
(
	"id" serial  NOT NULL,
	"external_id" VARCHAR(500) default '',
	"title" VARCHAR(500)  NOT NULL,
	"orig_title" VARCHAR(500),
	"year" INTEGER,
	"poster" VARCHAR(255),
	"link" VARCHAR(255),
	"description" TEXT,
	"video_tag" VARCHAR(255),
	"created_at" TIMESTAMP,
	"updated_at" TIMESTAMP,
	PRIMARY KEY ("id")
);

COMMENT ON TABLE "afisha_film" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- afisha
-----------------------------------------------------------------------------

DROP TABLE "afisha" CASCADE;


CREATE TABLE "afisha"
(
	"id" serial  NOT NULL,
	"external_id" VARCHAR(500) default '',
	"afisha_theater_id" INTEGER  NOT NULL,
	"afisha_film_id" INTEGER  NOT NULL,
	"afisha_zal_id" INTEGER  NOT NULL,
	"link" VARCHAR(255),
	"description" TEXT,
	"date_begin" TIMESTAMP  NOT NULL,
	"date_end" TIMESTAMP  NOT NULL,
	"times" TEXT,
	"prices" TEXT,
	"created_at" TIMESTAMP,
	"updated_at" TIMESTAMP,
	PRIMARY KEY ("id")
);

COMMENT ON TABLE "afisha" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- afisha_zal
-----------------------------------------------------------------------------

DROP TABLE "afisha_zal" CASCADE;


CREATE TABLE "afisha_zal"
(
	"id" serial  NOT NULL,
	"external_id" VARCHAR(500) default '',
	"afisha_theater_id" INTEGER  NOT NULL,
	"title" VARCHAR(500),
	PRIMARY KEY ("id")
);

COMMENT ON TABLE "afisha_zal" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- afisha_time
-----------------------------------------------------------------------------

DROP TABLE "afisha_time" CASCADE;


CREATE TABLE "afisha_time"
(
	"id" serial  NOT NULL,
	"afisha_id" INTEGER  NOT NULL,
	"time" VARCHAR(200)  NOT NULL,
	"price" VARCHAR(100),
	PRIMARY KEY ("id")
);

COMMENT ON TABLE "afisha_time" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- static_pages
-----------------------------------------------------------------------------

DROP TABLE "static_pages" CASCADE;


CREATE TABLE "static_pages"
(
	"id" serial  NOT NULL,
	"title" VARCHAR(500)  NOT NULL,
	"url" VARCHAR(500),
	"sort" INTEGER default 0,
	"description" TEXT,
	"is_visible" BOOLEAN default 't' NOT NULL,
	"created_at" TIMESTAMP,
	"updated_at" TIMESTAMP,
	PRIMARY KEY ("id")
);

COMMENT ON TABLE "static_pages" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- banned_ips
-----------------------------------------------------------------------------

DROP TABLE "banned_ips" CASCADE;


CREATE TABLE "banned_ips"
(
	"id" serial  NOT NULL,
	"ip" VARCHAR(100)  NOT NULL,
	"description" TEXT  NOT NULL,
	"created_at" TIMESTAMP,
	"updated_at" TIMESTAMP,
	PRIMARY KEY ("id"),
	CONSTRAINT "banned_ips_U_1" UNIQUE ("ip")
);

COMMENT ON TABLE "banned_ips" IS '';


SET search_path TO public;
ALTER TABLE "users_users_group" ADD CONSTRAINT "users_users_group_FK_1" FOREIGN KEY ("user_id") REFERENCES "users" ("id") ON DELETE CASCADE;

ALTER TABLE "users_users_group" ADD CONSTRAINT "users_users_group_FK_2" FOREIGN KEY ("group_id") REFERENCES "users_group" ("id") ON DELETE CASCADE;

ALTER TABLE "users_remember_key" ADD CONSTRAINT "users_remember_key_FK_1" FOREIGN KEY ("user_id") REFERENCES "users" ("id") ON DELETE CASCADE;

ALTER TABLE "film" ADD CONSTRAINT "film_FK_1" FOREIGN KEY ("user_id") REFERENCES "users" ("id");

ALTER TABLE "film" ADD CONSTRAINT "film_FK_2" FOREIGN KEY ("modified_user_id") REFERENCES "users" ("id");

ALTER TABLE "film_links" ADD CONSTRAINT "film_links_FK_1" FOREIGN KEY ("film_id") REFERENCES "film" ("id") ON DELETE CASCADE;

ALTER TABLE "film_raiting" ADD CONSTRAINT "film_raiting_FK_1" FOREIGN KEY ("film_id") REFERENCES "film" ("id") ON DELETE CASCADE;

ALTER TABLE "film_raiting" ADD CONSTRAINT "film_raiting_FK_2" FOREIGN KEY ("user_id") REFERENCES "users" ("id") ON DELETE CASCADE;

ALTER TABLE "film_total_rating" ADD CONSTRAINT "film_total_rating_FK_1" FOREIGN KEY ("film_id") REFERENCES "film" ("id") ON DELETE CASCADE;

ALTER TABLE "film_gallery" ADD CONSTRAINT "film_gallery_FK_1" FOREIGN KEY ("film_id") REFERENCES "film" ("id") ON DELETE CASCADE;

ALTER TABLE "film_film_types" ADD CONSTRAINT "film_film_types_FK_1" FOREIGN KEY ("film_id") REFERENCES "film" ("id") ON DELETE CASCADE;

ALTER TABLE "film_film_types" ADD CONSTRAINT "film_film_types_FK_2" FOREIGN KEY ("film_genre_id") REFERENCES "film_types" ("id") ON DELETE CASCADE;

ALTER TABLE "film_trailer" ADD CONSTRAINT "film_trailer_FK_1" FOREIGN KEY ("film_id") REFERENCES "film" ("id") ON DELETE CASCADE;

ALTER TABLE "comments" ADD CONSTRAINT "comments_FK_1" FOREIGN KEY ("user_id") REFERENCES "users" ("id");

ALTER TABLE "comments" ADD CONSTRAINT "comments_FK_2" FOREIGN KEY ("film_id") REFERENCES "film" ("id") ON DELETE CASCADE;

ALTER TABLE "messages" ADD CONSTRAINT "messages_FK_1" FOREIGN KEY ("from_user_id") REFERENCES "users" ("id");

ALTER TABLE "messages" ADD CONSTRAINT "messages_FK_2" FOREIGN KEY ("to_user_id") REFERENCES "users" ("id");

ALTER TABLE "user_friends" ADD CONSTRAINT "user_friends_FK_1" FOREIGN KEY ("user_id") REFERENCES "users" ("id") ON DELETE CASCADE;

ALTER TABLE "user_friends" ADD CONSTRAINT "user_friends_FK_2" FOREIGN KEY ("friend_id") REFERENCES "users" ("id") ON DELETE CASCADE;

ALTER TABLE "afisha_city" ADD CONSTRAINT "afisha_city_FK_1" FOREIGN KEY ("afisha_country_id") REFERENCES "afisha_country" ("id");

ALTER TABLE "afisha_theater" ADD CONSTRAINT "afisha_theater_FK_1" FOREIGN KEY ("afisha_city_id") REFERENCES "afisha_city" ("id");

ALTER TABLE "afisha" ADD CONSTRAINT "afisha_FK_1" FOREIGN KEY ("afisha_theater_id") REFERENCES "afisha_theater" ("id");

ALTER TABLE "afisha" ADD CONSTRAINT "afisha_FK_2" FOREIGN KEY ("afisha_film_id") REFERENCES "afisha_film" ("id");

ALTER TABLE "afisha" ADD CONSTRAINT "afisha_FK_3" FOREIGN KEY ("afisha_zal_id") REFERENCES "afisha_zal" ("id") ON DELETE CASCADE;

ALTER TABLE "afisha_zal" ADD CONSTRAINT "afisha_zal_FK_1" FOREIGN KEY ("afisha_theater_id") REFERENCES "afisha_theater" ("id") ON DELETE CASCADE;

ALTER TABLE "afisha_time" ADD CONSTRAINT "afisha_time_FK_1" FOREIGN KEY ("afisha_id") REFERENCES "afisha" ("id") ON DELETE CASCADE;
