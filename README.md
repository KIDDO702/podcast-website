# Blvck Radio - Podcast Website Demo

Welcome to the Blvck Radio demo project! This web application allows users to explore various shows and episodes, comment on episodes, rate shows, and provides functionality for hosts and administrators to manage content.

## Features

- **Showcasing Shows and Episodes:** Browse a curated list of shows and episodes with detailed information.

- **Host Management:** Hosts can create and manage shows and episodes, adding rich content and details.

- **Admin Control:** Administrators have the power to oversee and control the overall content and user interactions.

- **User Engagement:** Users can actively participate by commenting on episodes and rating shows to share their feedback.

## Demo

Check out the live demo of the Blvck Radio podcast website [here](#insert-demo-link).

## Table of Contents

- [Features](#features)
- [Demo](#demo)
- [Getting Started](#getting-started)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)

## Getting Started

### Prerequisites

- PHP >= 8.2
- Composer
- Node.js and npm
- MySql
- laravel >= 10 

### Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/KIDDO702/podcast-website.git
    ```

2. Install dependencies:

    ```bash
    cd podcast-website
    composer install
    npm install && npm run dev
    ```

3. Configure the environment:

    - Duplicate the `.env.example` file and rename it to `.env`.
    - Configure your database and other settings in the `.env` file.

4. Generate application key:

    ```bash
    php artisan key:generate
    ```

5. Run migrations:

    ```bash
    php artisan migrate --seed
    ```

6. Start the development server:

    ```bash
    php artisan serve
    ```

Visit [http://localhost:8000](http://localhost:8000) in your browser to view the demo podcast website.

## Usage

- Log in with appropriate roles (admin, host, user) to explore different functionalities.
- Add podcast episodes, manage media, and enjoy the demo features.

## Contributing

Feel free to contribute by opening issues or pull requests. Your feedback is highly appreciated.


