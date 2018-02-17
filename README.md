# Automated Code Evaluation System (ACES)
An online test portal that evaluates the code/program and queries written by test-takers.

Implemented using PHP, Javascript, MySQL, HTML5, CSS (Bootstrap), Apache2

## What is the aim?
The aim of the project is create a web application for educational instituitions to test their students in general (using Multiple Choice Questions), their programming and querying skills.

## What is Automated Code Evaluation System (ACES)?
ACES is a web application for students to take tests online. Staff can create question (MCQs, Programming questions and Querying questions) pools. Tests are created based on the pool set by the staff. Students can take the test to evaluate their programming and querying knowledge.

## How to run?
### Step 1:
Install the required softwares. While installing the database server (mysql), set your password as “mysql” for smooth running of the software.
 
### Step 2:
We need databases and tables to store your data. So you have to create the required tables by running the .sql files. The .sql files can be found on your /var/www/Run_sql_files.  

### Step 3:
After setting up all the required things you can start running the application on your browser.
First get on to the login page and create a account for yourself .
 
#### As Staff: 
There are three different tabs on the top of the page.
##### Scores
  A staff when logged into his account can view the scores of all the students who have taken the test.
##### Add question
  Test Code - Staff can add questions from programming languages(C, C++, JAVA) to the question pool.
  MCQ - Staff can add Multiple Choice questions to the question pool.
  Test Query - Staff can add questions from structured query languages to the question pool.
##### Test Offered
  Once the questions are added to the pool, the test is created by picking questions in random.

#### As Student:
##### Test Offered - In this link, students can take up the test created by the staff by giving the correct test-ID.
##### Scores - Student can see the scores of the tests he/she has taken and improve their performance accordingly.

### Step 4:
Logout before you exit the browser for security reasons.

## Do you want to contribute?
Your contributions are always welcome! Feel free to improve existing code, documentation or implement new algorithm.
If there are big changes, kindly open an issue to propose them.
