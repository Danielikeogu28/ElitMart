# EliteMart

EliteMart is a modern eCommerce platform built with Laravel. It provides a seamless shopping experience with features like authentication, cart management, and secure payment gateways (PayPal & Paystack).

## Features
- 🛒 User-friendly shopping cart
- 🔐 Secure authentication (Laravel Breeze)
- 💳 PayPal & Paystack payment integration
- 📦 Order management system
- 📄 Blog module for updates and promotions
- 🏪 Admin panel for product & order management

## Tech Stack
- **Backend:** Laravel
- **Frontend:** Blade, Tailwind CSS
- **Database:** MySQL
- **Authentication:** Laravel Breeze
- **Payments:** PayPal, Paystack

## Installation
### 1. Clone the Repository
```bash
git clone https://github.com/Danielikeogu28/EliteMart.git
cd EliteMart
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Configure Environment
Copy the `.env.example` file and set up your environment variables.
```bash
cp .env.example .env
```
Update the database credentials and payment gateway keys in `.env`:
```ini
DB_DATABASE=elitemart
DB_USERNAME=root
DB_PASSWORD=

PAYSTACK_PUBLIC_KEY=your_paystack_public_key
PAYSTACK_SECRET_KEY=your_paystack_secret_key
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Run Migrations & Seed Database
```bash
php artisan migrate --seed
```

### 6. Serve the Application
```bash
php artisan serve
```

## Usage
- Visit `http://127.0.0.1:8000/` to access the homepage.
- Register/Login to manage your cart and checkout.
- Admin users can manage products and orders.

## Deployment
To deploy the project, configure your production server and set up the `.env` file accordingly. Use Laravel Forge, Docker, or shared hosting.

## License
This project is licensed under the MIT License.

## Contributing
Pull requests are welcome! For major changes, please open an issue first to discuss what you would like to change.

## Contact
For support, reach out at [danielikeogu28@gmail.com] or create an issue in the repository.

