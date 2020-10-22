<?php
    require("./controller.php");

    $config = new crud();
    
    if(isset($_POST['delete'])){
        $msg = $config->delete_user($_POST['delete']);
    }
    
    $data = $config->user_table_data();

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
        <a href="./add" class="uk-margin-large-top uk-button uk-button-secondary">Add New User</a>

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

        <table class="uk-table uk-table-hover">
            <h2 class="uk-padding uk-text-secondary uk-margin-top">User's Table</h2>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Delete</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach($data as $row): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $row['username'];?></td>
                        <td><?= $row['password'];?></td>
                        <td>
                           <form action="" method="post">
                                <button value="<?= $row['id']; ?>" name="delete" class="uk-button uk-button-danger">Delete</button>
                           </form>
                        </td>
                        <td>
                            <a href="./edit/?id=<?= $row['id'];?>" class="uk-button uk-button-primary">Update</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.5.4/js/uikit.min.js" 
        integrity="sha256-8QekXFS5Mxv+c4TrPQY01b+3GUCDKMEtUT4hwe79u+U=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.5.4/js/uikit-icons.min.js" 
        integrity="sha256-ePbnCL/UfOwc7bXqeMgyTNf6wM1HoqaY1ZeDQWYSJ9Y=" crossorigin="anonymous"></script>
</body>
</html>