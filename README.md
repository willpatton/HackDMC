# HackDMC - A Hackathon Project for UI Labs
www.uilabs.org

This codebase is for the UI Labs "DMC Hackathon" - HackDMC weekend July 15-17, 2016.
This project won 2nd place.

This app interprets vast amounts of machine data (collected by MTConnect sensors) as a dashboard. 
The "intent" of this app is better "decision" making based on "very clear and thoughtful" indicators (i.e. "good vs bad", "yes vs no", "color code: red, yellow, green").  
Intended users of this app include operators, ops managers and execs for use at the regular ops meetings (daily, weekly, monthly). 


# Participants
* Will - developer
* Connor - data scientist
* Eric - business executive
* Taylor - student

#ABOUT
About this app - A loosely (rudely) coded MVC / Restful app.  

Folders
* /app - the app runs with index.php from this folder
* /config - 
* /data - Company, Project data I/O
* /sql - Database schema. Consists of tables for data, departments, assets, parts...
* /template - php templating 
* /reports - static HTML pages generated using R from Connor
* /docs - PowerPoint from Eric

# Dev Stack
LAMP - PHP/MySQL, Bootstrap, JQuery

# Installation
* Download to a LAMP server
* Configure the database settings in /config/database_config.php
* Initialize the database using the .sql in /sql

Data policy
The .sql schema is contains a sample of data.
24GB JSON of real world MTConnect machine data not included. 


#Unfinished
* See the TODO in the code
* Streaming MTConnect data would provide real-time visibility.