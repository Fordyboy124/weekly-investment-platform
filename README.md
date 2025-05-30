# Weekly Investment Platform

A PHP-based web platform that allows users to:

- Register and log in
- Deposit funds using Flutterwave (MPesa)
- Earn 10% profit weekly on deposits
- Withdraw funds after a 7-day hold period

## Features

- Secure login system
- MPesa integration via Flutterwave
- Profit auto-calculated via cron job
- Withdraw lock until 7 days after last transaction
- Clean dashboard, deposit, and transaction history pages

## Tech Stack

- PHP
- MySQL
- HTML/CSS
- Flutterwave MPesa API
- Cron (for profit calculation)

## Setup Instructions

1. Clone this repo
2. Create your `.env` or `config.php` with database and API credentials
3. Import the database schema
4. Schedule `profit_cron.php` as a weekly cron job

## License

MIT License
