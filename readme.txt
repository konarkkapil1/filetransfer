Project contributions
Uma
Noshyia wani

File structure details

Whole API works with POST method only

/api

        /account 
            /login.php //login page api /filetransfer/api/account/login.php 
            /signup.php //signup page api /filetransfer/api/account/signup.php

        /config 
            /db.php //datbase connection file

        /department //department api can only be accessed by superadmin 
            /assignmanager.php //api to assign managers to departments 
            /filetransfer/api/department/assignmanager.php /create.php //api to create departments /filetransfer/api/department/create.php

        /files 
            /create.php //api to create files 
            /filetransfer/api/files/create.php /transfer.php //api to transfer file employee to employee 
            /filetransfer/api/files/transfer.php /track.php //api to track file movement only shows file managed by logged in user /filetransfer/api/files/track.php

        /jwt 
            /decode.php //jwt token decoding logic

        /security 
            /pagevalidation.php //checks if request method is POST or not Only POST method allowed in whole api

        /state 
            /variable.php //holds all the important variable to be used in api db variable jwt variables etc
