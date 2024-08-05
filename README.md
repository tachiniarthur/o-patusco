# O Patusco - Clinic Website

O Patusco is a website developed for the O Patusco clinic, using Laravel, Vue3, and Inertia.js. This project aims to provide an intuitive and modern experience for patients and the clinic's staff.

## Technologies Used

- **Laravel**: PHP framework for backend development.
- **Vue3**: JavaScript framework for building the user interface.
- **Inertia.js**: Tool for seamlessly integrating Vue with Laravel.

## Requirements

- PHP >= 8.0
- Composer
- Node.js >= 16.x
- NPM or Yarn

## Installation

1. **Clone the Repository**

```bash
git clone https://github.com/tachiniarthur/o-patusco.git
cd o-patusco
```

2. **Install Backend Dependencies**

```bash
composer install
```

3. **Configure the Environment**

Copy the .env.example file to .env and set up the necessary environment variables, such as database connection.

```bash
cp .env.example .env
```

4. **Generate Application Key**

```bash
php artisan key:generate
```

5. **Install Frontend Dependencies**

```bash
npm install
```

6. **Compile Assets**

```bash
npm run dev
```

7. **Run Migrations and Seeds**

```bash
php artisan migrate --seed
```

8. **Start the Server**

```bash
php artisan serve
```

## Usage

Access the application via a browser at http://localhost:8000. Admin user login is

email: test@example.com<br>
password: 123123123
