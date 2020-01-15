 
CREATE TABLE role_user (
   role_id INT NOT NULL,
   user_id INT NOT NULL,

   FOREIGN KEY (role_id) REFERENCES roles (id),
   FOREIGN KEY (user_id) REFERENCES users (id)
);