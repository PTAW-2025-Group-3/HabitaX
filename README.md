# HabitaX - Real Estate Platform

## Description

HabitaX is a web platform designed to simplify the process of publishing and searching for real estate properties. It was developed to address the lack of transparency and usability found in existing real estate platforms, particularly for individual property owners who want to advertise without intermediaries.

The platform allows users to create structured listings, manage inquiries, filter and save properties, and simulate bank loan payments. Administrators have access to moderation tools to ensure credibility and security.

During development, the team gained experience in full-stack web development using Laravel, database design, role-based access control, automated testing, and containerization with Docker.

## Table of Contents

If your README is long, add a table of contents to make it easy for users to find what they need.

- [Installation](#installation)
- [Usage](#usage)
- [Credits](#credits)
- [License](#license)
- [Features](#features)
- [How to Contribute](#how-to-contribute)
- [Tests](#tests)

## Installation

```bash
git clone https://github.com/Projecto-Tematico-em-Aplicacoes-Web/HabitaX.git
cd habitax
composer install
npm install && npm run build
```

Duplicate .env.example to .env, configure database credentials and storage paths, then:
```bash
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

## Usage

Provide instructions and examples for use. Include screenshots as needed.

To add a screenshot, create an `assets/images` folder in your repository and upload your screenshot to it. Then, using the relative filepath, add it to your README using the following syntax:

    ```md
    ![alt text](assets/images/screenshot.png)
    ```

## Credits

List your collaborators, if any, with links to their GitHub profiles.

If you used any third-party assets that require attribution, list the creators with links to their primary web presence in this section.

If you followed tutorials, include links to those here as well.

https://youtube.com/playlist?list=PL4cUxeGkcC9gF5Gez17eHcDIxrpVSBuVt&si=CG2-nhbvw0nYhXY7

## License

MIT License

Copyright (c) 2025 HabitaX Developers

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

---

## Features

Public access:
- Browse available listings
- Filter by price, location, property type and features
- Access detailed property pages

Registered users:
- Create and manage listings with flexible attributes
- Upload and order multiple images
- Receive and answer contact requests
- Save listings to favorites and collections
- Report problematic content
- Run mortgage simulation

Administrators:
- Manage users and listings
- Review reports and take action
- Access internal dashboards

## How to Contribute

If you created an application or package and would like other developers to contribute it, you can include guidelines for how to do so. The [Contributor Covenant](https://www.contributor-covenant.org/) is an industry standard, but you can always write your own if you'd prefer.

## Tests

To run tests, run the following command

```bash
  php artisan test
```
Ensure you have a testing database configured in your `.env` file.
