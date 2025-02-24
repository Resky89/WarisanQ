# WarisanQ - Islamic Inheritance Calculator

<p align="center">
  <img src="https://warisanq.vercel.app/images/logo_text.png" alt="WarisanQ Logo" width="200"/>
</p>

## Description

WarisanQ is a web-based Islamic inheritance (Mawaris) calculator that helps Muslims calculate and distribute inheritance according to Islamic law. The application provides comprehensive information about Islamic inheritance laws, calculation methods, and an easy-to-use calculator for determining inheritance shares.

## Features

### 1. Educational Content
- Detailed explanation of Islamic inheritance laws
- References from Al-Quran and Hadith
- Compilation of Islamic Law (KHI) references
- Historical background of Islamic inheritance

### 2. Inheritance Calculator
- User-friendly interface for inputting inheritance details
- Support for various heir configurations:
  - Spouse (husband/wife)
  - Children (sons and daughters)
  - Parents
  - Siblings
  - Grandparents
- Automatic calculation of shares based on Islamic law
- Detailed breakdown of inheritance distribution

### 3. Legal References
- Al-Quran verses related to inheritance
- Relevant Hadith
- KHI (Kompilasi Hukum Islam) articles
- Explanation of special cases in inheritance

## Technical Stack

- **Frontend:**
  - HTML5
  - TailwindCSS
  - Bootstrap 5
  - JavaScript
  - Font Awesome Icons

- **Backend:**
  - PHP
  - Laravel Framework

## Installation

1. Clone the repository:
```bash
git clone https://github.com/Resky89warisanq.git
```

2. Install dependencies:
```bash
composer install
npm install
```

3. Create environment file:
```bash
cp .env.example .env
```

4. Generate application key:
```bash
php artisan key:generate
```

5. Run the development server:
```bash
php artisan serve
```

## Usage

1. Visit the homepage to learn about Islamic inheritance
2. Navigate to the calculator section
3. Input the deceased's details and heir information
4. Enter the total inheritance amount and any deductions
5. Get detailed calculation results showing each heir's share

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

