<?php
            $conn = mysqli_connect("swe-project-db.ckec3iue5fvo.us-east-2.rds.amazonaws.com", "admin", "softwareengineering", "hotel");

            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                exit();
            }
