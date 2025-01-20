# Intra-AMCEL-web
Collecting workspace information

# Intra-AMCEL Web

Intra-AMCEL Web is a web application designed to manage various aspects of an organization's internal operations, including user authentication, knowledge base, projector booking, meeting room management, and more.

## Table of Contents

- Installation
- Usage
- Project Structure
- Routes
- License

## Installation

1. Clone the repository:

```sh
git clone https://github.com/mauriciovictor/intra-amcel-web.git
cd intra-amcel-web
```

2. Install the dependencies:

```sh
composer install
npm install
```

3. Set up the environment variables:

```sh
cp .env.example .env
```

Edit the 

.env

 file to match your environment.

4. Build the assets:

```sh
npm run build
```

5. Start the server:

```sh
php -S localhost:8000 -t src
```

## Usage

Open your browser and navigate to `http://localhost:8000` to access the application.

## Project Structure

```
.editorconfig
.env
.gitignore
.htaccess
assets/
    css/
    fonts/
    imgs/
    js/
    pdf/
    videos/
assets_old/
    css/
    fonts/
    imgs/
    js/
composer.json
composer.lock
db/
    intra_amcel1.sql
    intra-amcel.sql
js/
    server.js
logs/
    20200109_log.text
    20201208_log.text
    20202108_log.text
    20210811_log.text
package.json
src/
    controllers/
    index.php
    models/
    routes/
    schedules/
    utils/
    views/
src_old/
    controllers/
    index.php
    models/
    routes/
    schedules/
    utils/
    views/
vendor/
webpack.config.js
```

## Routes

The application uses a router to define various endpoints. Here are some of the key routes:

- `/auth`: Authenticates the user.
- `/login`: Displays the login page.
- `/home`: Displays the home page.
- `/base-conhecimento`: Displays the knowledge base.
- `/agendamento-projetor/criar`: Creates a new projector booking.
- `/salas-reuniao/criar`: Creates a new meeting room booking.
- `/solicitar-perfil`: Requests a user profile.
- `/usuario/logout`: Logs out the user.
- `/cargos`: Displays job positions.
- `/departamento`: Displays departments.
- `/ramais-contatos`: Displays extensions and contacts.
- `/pdf/ramal`: Generates a PDF for extensions.
- `/lgpd`: Displays LGPD (General Data Protection Law) information.

For a complete list of routes, refer to the index.php file.

## License

This project is licensed under the GNU GPL v3.0 License. See the LICENSE file for details.