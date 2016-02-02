CREATE TABLE NOTIFICATION_L
(
Liker_id int (2),
Liked_id int (2),
post_id int,
    
PRIMARY KEY(Liker_id ,Liked_id , post_id)
);

CREATE TABLE NOTIFICATION_ADD
(
adder_id int (2),
added_id int (2),
    
PRIMARY KEY(adder_id ,added_id)
);


ALTER TABLE NOTIFICATION_L ADD FOREIGN KEY ( Liker_id ) REFERENCES MEMBER (member_id );
ALTER TABLE NOTIFICATION_L ADD FOREIGN KEY ( Liked_id ) REFERENCES MEMBER (member_id );
ALTER TABLE NOTIFICATION_L ADD FOREIGN KEY ( post_id ) REFERENCES post (post_id );

ALTER TABLE NOTIFICATION_ADD ADD FOREIGN KEY ( adder_id ) REFERENCES MEMBER (member_id );
ALTER TABLE NOTIFICATION_ADD ADD FOREIGN KEY ( added_id ) REFERENCES MEMBER (member_id );