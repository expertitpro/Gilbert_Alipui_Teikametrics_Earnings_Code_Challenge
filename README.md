# Earnings Code Challenge


This is Gilbert Alipui second version of the Teikametrics code challenge.  Thank you for granting me the opportunity to tackle this challenge.  I have enjoyed working so much that I created a second version.  
This version features a more polished front-end UI built with Extjs, and employs my own hand-coded MVC framework on the back-end.

<b>How to View the Solution</b>

To view my solution, clone off a copy, and after renaming the folder to remove my name, store the resulting <b>earnings_code_challenge</b> folder in your web root and enter this link into the browser's address bar:  http://localhost/earnings_code_challenge

<b>The Problem:</b>  

Using the Boston Employee Earnings Report, create a simple web API service which given a job title, will respond with the average salary for that position.  
Requirements:  The average salary should be based on Total Earnings and not Regular. title should allow for case insensitve comparison. 
title should match on partials (example, teacher should match Teacher, Teacher I, Subsitute Teacher.

<b>Introduction:</b>

I chose to use Extjs 6 on the front-end, and PHP5 for this challenge because though it has a steep learning curve, Extjs provides unparalleled, polished and professional-looking UI components, and PHP is great for rapidly getting a prototype up and running.  
Also, my most recent front-end and back-end work has been with both Extjs and PHP so these were a natural choice for me.

I tried not to go overboard on any aspect.  I relied heavily on Extjs for visual aesthetics, and client-side validation to catch an empty textfield, and additional tests on the server-side, to block processing if for some reason unacceptable parameters or 
empty submissions get through, to avoid the dreaded division by zero!

Once the client-side validation is completed successfully, an Ajax call is made to the controller which hands off to the model which handles the data, and performs the position salary search.

Naturally, I am open to working with Ruby on Rails, and GO so it would be interesting to compare the level of effort between Ruby and PHP.

<b>My Solution Methodology:</b>

My solution is pretty straight-forward.  Once I figured out the correct URL for the nice JSON data, I used json_decode to store the data into array.  I then totaled up the earnings based on Total Earnings whilst totalling up the total number of 
records.  This enabled me to find the average earnings.  Instead of strpos, I used <b>stripos</b> instead for case-insensitive matching to fulfill the case-insensitivity requirement.  Since it was case-insensitive, I chose not to use strtoupper as that would have been redundant.

This time round, I used Extjs 6 framework on the front-end, and my own hand-coded MVC framework on the back-end. A database was not required, so my model just performs the search and echoes back a response text, otherwise I would have used Yii to generate the back-end CRUD code.

<b>Solution API</b>

My solution consists of three primary files.  

1. model.php
2. view.php
3. controller.php


If I spent additional time on the project, I would opt for PHP framework like Yii to generate the CRUD saffolding to store search results in a MySQL database.  I would then add a tab with a panel to display some
nice pie charts or bar graphs breaking down the various titles and their respective average salaries, and other canned queries. 

Thank you for this opportunity to tackle the Teikametrics code challenge.

Gilbert Alipui
