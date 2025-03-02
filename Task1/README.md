# 🔐 Dictionary & Brute Force Attack Simulation
![Attack](https://github.com/ahmedmohamedbekhit1/Information_Security_Mangment/blob/main/Task1/PasswordAttackSimulation.gif)
This project demonstrates a web-based simulation of both **Dictionary Attack** and **Brute Force Attack** to crack a predefined password. It is designed for educational purposes to understand the security vulnerabilities of weak passwords.

## ✨ Features

- ✅ A simple login form for manual password entry.
- 📂 A file upload option to perform a dictionary attack.
- 🔄 Brute force attack implementation for password cracking.
- ⚡ Speed control options (Low, Medium, High) for both attack methods.
- 📝 Console logging of each attempted password.
- 🔔 Alerts when the correct password is found or not found.

## 📌 Task Details

### 1. Dictionary Attack:
- The program allows users to enter a **username**.
- It attempts to log in by testing different passwords from a predefined **dictionary file**.
- If a match is found, the program stops and indicates **success**; otherwise, it reports **failure**.
- The attack speed can be adjusted using **radio buttons** (Low, Medium, High).

### 2. Brute Force Attack:
- If the dictionary attack fails, the program performs a **brute force attack**, systematically trying all possible password combinations.
- The password consists of **exactly 5 alphabetical (A-Z, a-z) characters**.
- Brute force speed can be controlled with **Low, Medium, High settings**.

## ⚙️ How It Works

1. 🖊️ The user enters a password manually and clicks the **"Log In"** button.
2. 🎯 If the entered password matches the predefined password, a success message appears.
3. 📄 The user can also upload a **`.txt`** file containing a list of passwords (one per line) to perform a **dictionary attack**.
4. 🔍 The script attempts each password from the dictionary file and logs the attempts in a simulated **terminal**.
5. 🛑 If the correct password is found, the script alerts the user and stops further attempts.
6. 🚀 If the dictionary attack fails, the **brute force attack** starts, trying all possible 5-letter passwords systematically.
7. 🎚️ The user can select **speed levels (Low, Medium, High)** to control attack performance.

## 📋 Requirements

- 🌐 A modern web browser.
- 📑 A text file (`.txt`) containing a list of potential passwords (for dictionary attack testing).

## 🚀 Usage

- 🔓 Open the web page and manually enter a password to test.
- 📂 Upload a **`.txt`** file containing passwords to perform a **dictionary attack**.
- 🎮 Use the speed controls to adjust the **attack performance**.
- 🖥️ Check the **simulated terminal output** for password attempts and results.
- 📢 Alerts notify when the correct password is found.

## ⚠️ Disclaimer

This project is for **educational purposes only**. ❌ Do not use it for unauthorized access or malicious activities. The author is not responsible for any misuse of this tool.

## 📜 License

This project is licensed under the **MIT License**. See the `LICENSE` file for more details.

## 👤 Author

**Ahmed Mohamed Bekhit**

