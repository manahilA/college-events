CREATE TABLE universities(
	name VARCHAR(100) PRIMARY KEY,
	latitude FLOAT(23,19) NOT NULL,
	longitude FLOAT(23,19) NOT NULL,,
	uni_description VARCHAR(10000),
	no_of_students INT,
	image_url VARCHAR(255)
);

CREATE TABLE contacts(
	email VARCHAR(100) PRIMARY KEY, 
	CHECK(email LIKE '%_@__%.__%'),
	f_name VARCHAR(50),
	l_name VARCHAR(50),
	phone_no VARCHAR(50) NOT NULL
);

CREATE TABLE users(
	username VARCHAR(100) PRIMARY KEY,
	first_name VARCHAR(50),
	last_name VARCHAR (50),
	password VARCHAR(255) NOT NULL,
	role_type VARCHAR(100) NOT NULL,
	email VARCHAR(100) NOT NULL,
	university VARCHAR(100) NOT NULL,
	FOREIGN KEY (email) REFERENCES contacts(email),
	FOREIGN KEY (university) REFERENCES universities(name)
);

CREATE TABLE rsos(
  id INT AUTO_INCREMENT PRIMARY KEY,
   name VARCHAR(100) NOT NULL,
   rso_description VARCHAR(10000),
   admin_username VARCHAR(100) NOT NULL,
   university VARCHAR(100) NOT NULL,
   FOREIGN KEY (admin_username) REFERENCES users(username),
   FOREIGN KEY (university) REFERENCES universities(name)
);

CREATE TABLE rso_members(
  rso INT NOT NULL,
  rso_member VARCHAR(100) NOT NULL,
  FOREIGN KEY (rso) REFERENCES rsos(id),
  FOREIGN KEY (rso_member) REFERENCES users(username),
  PRIMARY KEY (rso, rso_member)
);

CREATE TABLE events(
  id INT AUTO_INCREMENT PRIMARY KEY,
  event_name VARCHAR(500) NOT NULL,
  event_description VARCHAR(10000),
  event_category VARCHAR(255),
  start_time DATETIME NOT NULL,
  end_time DATETIME NOT NULL,
  privacy_level ENUM('public', 'private', 'rso event') DEFAULT 'public',
  latitude FLOAT(23,19) NOT NULL,
  longitude FLOAT(23,19) NOT NULL,
  created_at TIMESTAMP DEFAULT NOW(),
  contact VARCHAR(100) NOT NULL,
  university VARCHAR(100) NOT NULL,
  rso INT,
  FOREIGN KEY (contact) REFERENCES contacts(email),
  FOREIGN KEY (rso) REFERENCES rsos(id)
);

CREATE TABLE comments(
  id INT AUTO_INCREMENT PRIMARY KEY,
  comment_text VARCHAR(1000) NOT NULL,
  rating INT,
  CONSTRAINT CHK_rating CHECK(
    rating <= 5 AND rating >= 0
  ),
  user VARCHAR(100) NOT NULL,
  event_id INT NOT NULL,
  FOREIGN KEY (user) REFERENCES users(username),
  FOREIGN KEY (event_id) REFERENCES events(id)
);

CREATE TABLE requests(
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  rso_description VARCHAR(10000),
  admin_username VARCHAR(100) NOT NULL,
  university VARCHAR(100) NOT NULL
);
