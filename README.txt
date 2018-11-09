Name: Shanti Chary
Email: schary@my.bcit.ca
Student database

App info: student_app.php - main page

Comments:
I had some issues with redirecting the pages on Submit to the main student_app.php page along with the positive or negative messages. I finally resolved it by using:
example: header("Location: student_app.php?message=Success! The student: $id $firstname $lastname entered into the database"); - the messages now show on the main page after redirection.

I had some problems with displaying a record on the update form on clicking the 'Update' link using $_GET, but has been resolved.
