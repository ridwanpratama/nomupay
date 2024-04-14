## Nomupay

Nomupay is a web-based e-wallet application built using the CodeIgniter 4 framework. This application is specifically designed for businesses that want to provide e-wallet services to their customers.

### How to Run the Application

Below are the steps to run the Nomupay application:

1. **Environment Setup:**
   - Make sure your computer has PHP version 8.0 or higher installed.
   - Also, ensure that Composer is installed on your computer. If not, you can download it [here](https://getcomposer.org/download/).

2. **Clone the Repository:**
   ```
   git clone https://github.com/ridwanpratama/nomupay.git
   ```

3. **Install Dependencies:**
   - Open a terminal or command prompt, navigate to the directory where you cloned the Nomupay repository.
   - Run the following command to install all required dependencies:
   ```
   composer install
   ```

4. **Configure the Database:**
   - Copy the `env` file and rename it to `.env`.
   - Open the `.env` file and adjust the database settings according to your environment.

5. **Database Migration:**
   - After configuring the database, run migrations to create the database schema:
   ```
   php spark migrate
   ```

6. **Run the Local Server:**
   - Finally, start the local server with the command:
   ```
   php spark serve
   ```
   The application will run at `http://localhost:8080`.

7. **Access the Application:**
   - Open a web browser and visit `http://localhost:8080` to access the Nomupay application.

### Contribution

We welcome contributions from various parties to further develop this application. Please note that this project is also the final assignment for the Web Programming II course at Bina Sarana Informatika University (Universitas BSI). If you would like to contribute, please create a pull request, and we will review it.

### License

This project is licensed under the MIT License. Please see the [LICENSE](LICENSE) file for more information.

---

Enjoy using Nomupay! Feel free to contact us if you have any questions or feedback.