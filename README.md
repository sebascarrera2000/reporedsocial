Back-end
This is the back-end part of the redsocial project. It is built with Node.js and Express.js, and it provides APIs for managing users, messages, and follow relationships.

Installation
Make sure you have Node.js installed on your system.
Clone this repository.
Navigate to the project directory:

Copy code
cd redsocial/back-end
Install the dependencies:

Copy code
npm install
Usage
To start the server, run:


Copy code
npm start
The server will start running on http://localhost:3001 (for users), http://localhost:3002 (for messages), and http://localhost:3003 (for follow relationships).

API Endpoints
Users
GET /usuarios: Get all users
GET /usuarios/:usuario: Get a user by username
GET /usuariosId/:id: Get a user by ID
GET /usuarios/:usuario/:password: Validate a user by username and password
POST /usuarios: Create a new user
Messages
GET /mensajes: Get all messages
GET /mensajes/:usuarioId: Get messages for a specific user
POST /mensajes: Create a new message
Follow Relationships
POST /seguimientos: Follow a user
GET /seguimientos/:usuarioP: Get users followed by a specific user
Contributing
If you would like to contribute to this project, please follow these steps:

Fork the repository
Create a new branch for your feature or bug fix
Make your changes and commit them
Push your changes to your forked repository
Create a pull request
License
This project is licensed under the MIT License.

And here's the updated README for the front-end:

Front-end
This is the front-end part of the redsocial project. It is built with HTML, CSS, PHP, and JavaScript, and it interacts with the back-end APIs to provide a user interface for managing users, messages, and follow relationships.

Installation
Make sure you have a web server installed on your system (e.g., Apache or Nginx).
Clone this repository.
Copy the contents of the front-end directory to your web server's document root directory.
Usage
Start your web server.
Open your web browser and navigate to the URL where you have placed the front-end files (e.g., http://localhost).
Pages
index.html
This is the landing page where users can log in or register.

app.php
This page displays a list of all users and allows the logged-in user to follow other users.

mensajeria.php
This page allows the logged-in user to view and send messages.

seguimiento.php
This page allows the logged-in user to view the users they are following and the messages from those users.

admin.php
This page is accessible only to administrators and displays a list of all users. Administrators can also follow users from this page.

mensajeriaAdmin.php
This page is accessible only to administrators and allows them to view all messages.

seguimientoAdmin.php
This page is accessible only to administrators and allows them to view follow relationships between users.

register.php
This page allows administrators to create new user accounts.

Contributing
If you would like to contribute to this project, please follow these steps:

Fork the repository
Create a new branch for your feature or bug fix
Make your changes and commit them
Push your changes to your forked repository
Create a pull request
License
This project is licensed under the MIT License.