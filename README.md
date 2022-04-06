# M_Web
NTB elective module for web programming

## Task description

Develop a web application using HTML, CSS, JavaScript, PHP and MySQL to manage the addresses of friends and acquaintances. The goal was also to keep the design and code as simple and straightforward as possible

## Features
- [x] Add
- [x] Edit
- [x] Delete
- [x] \(Optional) Search

## Local Webserver
To use this repository, the use of [XAMPP](https://www.apachefriends.org/de/index.html) is highly recommended.

## How to use (with XAMPP)
1. Open MySQL Admin Panel
2. Create a `address-book` database
3. Add a users table, that looks like this:<br>

| ID | First_Name  | Last_Name  | Username  | Password  | Last_Login  |
|----|-------------|------------|-----------|-----------|-------------|
| 1  | Alex        | Koller     | Alko      | d41d8cd9e | 28 Nov 2021 |
| 2  |             |            |           |           |             |
| 3  |             |            |           |           |             | 

_Note that the password has to be hashed via php's password hashing function._

4. Add a persons table, that looks like this:<br>

| ID | Name         | Mobile     | Email            | Street       | City         |
|----|--------------|------------|------------------|--------------|--------------|
| 1  | Augusta Wind | 3699064308 | a.wind@gmail.com | Unterland 12 | Münsterstadt |
| 2  |              |            |                  |              |              |
| 3  |              |            |                  |              |              |

5. Copy the repository to `\path\to\xampp\htdocs\address-book`
6. Start Apache Module
7. Open a Browser and navigate to `localhost/address-book`

## Images
![Login Screen](/screenshots/addressbook_login.png)
![Main Screen](/screenshots/addressbook.png)
