<?php

    require("../controller.php");
 
    $config = new crud();
    
    if(isset($_POST['update'])){
        $msg = $config->update_user_data($_POST['update'], $_POST['username'], $_POST['password']);
    }

    $data = $config->edit_user($_GET['id']);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Php OOP CRUD</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.5.4/css/uikit.min.css"/>
    <style>
        .cap {
            font-size: 30px;
        }
    </style>
</head>
<body class="uk-background-muted">
        
    <div class="uk-container">
        <a href="../" class="uk-margin-large-top uk-button uk-button-secondary">Go Back</a>

        <form action="" class="uk-padding-large" method="post">

            <?php 
            if(!empty($msg)):
                foreach($msg as $m): 
                    if(!empty($m["error"])) : ?>
                        <div class="uk-alert-danger" uk-alert>
                            <a class="uk-alert-close" uk-close></a>
                            <p><?= $m['error'];?></p>
                        </div>
                    <?php elseif(!empty($m["success"])): ?>
                        <div class="uk-alert-success" uk-alert>
                            <a class="uk-alert-close" uk-close></a>
                            <p><?= $m['success'];?></p>
                        </div>
                    <?php 
                    endif;
                endforeach;
            endif; 
            ?>

            <div class="ui labeled button left" tabindex="0" aria-label="label">
              <a class="ui basic label">
                Username
              </a>
              <div class="ui button">
               <input type="text" name="username" value="<?= $data['username'];?>" placeholder="Enter Username" class="uk-input">
              </div>
            </div>
            
            <div class="ui labeled button uk-margin-top left" tabindex="0" aria-label="label">
              <a class="ui basic label">
                Password
              </a>
              <div class="ui button">
               <input type="text" name="password" value="<?= $data['password'];?>" placeholder="Enter Password" class="uk-input">
              </div>
            </div>

            <button name="update" value="<?= $data['id'];?>" class="uk-button uk-button-danger uk-margin-top">Update</button>


        </form>

    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.5.4/js/uikit.min.js" 
        integrity="sha256-8QekXFS5Mxv+c4TrPQY01b+3GUCDKMEtUT4hwe79u+U=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.5.4/js/uikit-icons.min.js" 
        integrity="sha256-ePbnCL/UfOwc7bXqeMgyTNf6wM1HoqaY1ZeDQWYSJ9Y=" crossorigin="anonymous"></script>
</body>
</html>