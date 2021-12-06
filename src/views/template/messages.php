<?php

$errors = [];

if($exception){
    $message = [
        'type' => 'error',
        'message' => $exception->getMessage()
    ];

    if(get_class($exception) === 'ValidationException'){
        $errors = $exception->getErrors();
    }
}

?>

<?php if($message): ?>
    <div class="my-3 alert alert-<?= $message['type'] === 'error'? 'danger' : 'success' ?>" role="alert">
        <?= $message['message']?>
    </div>
<?php endif ?>