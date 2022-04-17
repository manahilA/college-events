INSERT INTO
  universities
VALUES
  (
    'University of Central Florida',
    28.603568174040756,
    -81.20021994046058,
    'The University of Central Florida (UCF) is a metropolitan research university built to make a better future for our students and society.',
    70406,
    'https://www.ucf.edu/news/files/2021/09/ucf-2022-rankings.jpg'
  ),
  (
    'University of Florida',
    29.64509812399473,
    -82.3550177679679,
    'The University of Florida is a public land-grant research university located in Gainesville, Florida. It is a senior member of the State University System of Florida and traces its origins back to 1853.',
    61112,
    'https://storage.googleapis.com/collegetuitioncompare/images/webp/colleges/134130-university-of-florida.webp'
  );

INSERT INTO
  contacts
VALUES
  (
    'manahil@gmail.com',
    'Manahil',
    'Awan',
    '407-555-5555'
  ),
  (
    'anotherstudent@gmail.com',
    'Another',
    'Student',
    '312-123-4567'
  ),
  (
    'janedoe@gmail.com',
    'Jane',
    'Doe',
    '407-135-7979'
  );

INSERT INTO
  users(username, password, role_type, email, university)
VALUES
  (
    'manahil',
    'Manahil',
    'Awan',
    'password',
    'super admin',
    'manahil@gmail.com',
    'University of Central Florida'
  ),
  (
    'anotherstudent',
    'Another',
    'Student',
    'password',
    'admin',
    'anotherstudent@gmail.com',
    'University of Central Florida'
  ),
  (
    'janedoe',
    'Jane',
    'Doe',
    'password',
    'student',
    'janedoe@gmail.com',
    'University of Florida'
  );

INSERT INTO
  rsos(
    name,
    rso_description,
    admin_username,
    university
  )
VALUES
  (
    'Association for Computing Machinery - Women',
    'The mission of the Association for Computing Machinery–Women is to promote diversity in tech by empowering women in computing. We are a coed club that is welcoming to everyone who supports our mission. We focus on creating interactive content and building a supportive community.',
    'anotherstudent',
    'University of Central Florida'
  );

INSERT INTO
  rso_members
VALUES
  (1, 'janedoe');

INSERT INTO
  events(
    event_name,
    event_description,
    event_category,
    start_time,
    end_time,
    privacy_level,
    latitude,
    longitude,
    contact,
    university,
    rso
  )
VALUES
  (
    'General Body Meeting',
    'The Association for Computing Machinery for Women will host its first General Body Meeting to discuss plans for the semester, membership, mentorship, and more! Come join us and we can''t wait to see you there.',
    'General Meeting',
    '2022-04-18 13:00:00.000',
    '2022-04-18 14:00:00.000',
    'rso event',
    28.603568174040756,
    -81.20021994046058,
    'anotherstudent@gmail.com',
    'University of Central Florida',
    1
  );

INSERT INTO
  comments(comment_text, user, event_id)
VALUES
  (
    "I am so excited! I look forward to becoming a mentee and meeting new people!",
    'janedoe',
    1
  );
