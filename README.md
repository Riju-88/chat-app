# Live URL: http://chat-app-php.000webhostapp.com/

# chat-app
This is a web app which is capable of real time communication.

# Which languages/frameworks were used?
This is a real-time chat application made using HTML, CSS, JS, Bootstrap 5, PHP and MySql. This project uses Ratchet PHP WebSocket for real-time communication but doesn't uses any JS frameworks or external JS libraries.

# The basic registration process
In order to use this application, users must create an account first. During the sign-up process the password checker checks for password length, numbers, symbols, uppercase and lowercase characters for security. To create an account, users must enter the OTP which will be send to their email during registration process. Duplicate email entry will prevent the registration. In case of forgetting Password, users can get their password to the provided email.

# Chatting
Users can start chatting with each other after logging in. After sending a message, the receiving user will be able to see the message immediately without reloading the page. Every message will include a readable timestamp upon sending.

# Other Features
There is a search feature to search users. Another feature is a status indicator. Active users will have a green indicator while logged out users will have red. On Password change other devices will logout on any activity. Users have the option to edit/update their profile.
