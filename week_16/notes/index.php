<?php
$conn = require_once('connection.php');

// Call the getNotes() method to retrieve notes from the database
$notes = $conn->getNotes();

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $res=$conn->getNoteById($id);
    if(!$res){
        $currentnote=array(
            'title'=>'',
            'description'=>'',
            'id'=>''
        );
    }else{
        $currentnote=$res;
    }
}else{
    $currentnote=array(
        'title'=>'',
        'description'=>'',
        'id'=>''
    );
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div>
        <form class="new-note" action="save.php" method="post">
            <input type="hidden" name='id' value="<?=$currentnote['id']?>">
            <input type="text" name="title" placeholder="Note title" autocomplete="off" value="<?=$currentnote['title']?>">
            <textarea name="description" cols="30" rows="4" placeholder="Note Description"><?=$currentnote['description']?></textarea>
            <input type='submit' value="<?php
            if(isset($_GET['id']))echo'Update Note';
            else echo 'New Note';
            ?>" class="button" />
        </form>
        <?php
        foreach ($notes as $key => $note) {
            ?>
            <div class="notes">
                <div class="note">
                    <div class="title">
                        <a href="?id=<?=$note['id']?>">
                            <?= $note['title'] ?>
                        </a>
                    </div>
                    <div class="description">
                        <?= $note['description'] ?>
                    </div>
                    <small><?=$note['create_date']?></small>
                    <form action="remove.php" method="post" class='close'>
                        <input type="hidden" name='id' value="<?=$note['id']?>">
                        <a href="remove.php?id=<?=$note['id']?>">X</a>
                    </form>
                    
                </div>
            </div>
            <?php
        }
        ?>

    </div>
</body>

</html>