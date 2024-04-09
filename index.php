<?php
include 'src/contacts.php';

$allContacts = getContactsFromJsonFile($contactsFile);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['btn_submit'])) {
    $allContacts[] = [
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'address' => $_POST['address'],
        'contact_number' => $_POST['contact_number']
    ];

    saveContactsToJsonFile($allContacts, $contactsFile);
    header("Location: index.php");
    exit();
}

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['index'])) {
    $allContacts = deleteContact($allContacts, $_GET['index']);
    saveContactsToJsonFile($allContacts, $contactsFile);
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>PHP AddressBook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h2>Контакты</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Действия</th>
            <th>Имя</th>
            <th>Адрес</th>
            <th>Контакт</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($allContacts as $index => $contact): ?>
            <tr>
                <td>
                    <a href="?action=delete&index=<?= $index ?>" class="btn btn-danger">Удалить</a>
                </td>
                <td><?= htmlspecialchars($contact['last_name'] . ' ' . $contact['first_name']) ?></td>
                <td><?= htmlspecialchars($contact['address']) ?></td>
                <td><?= htmlspecialchars($contact['contact_number']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <form action="index.php" method="post" class="container">
        <div class="mb-3">
            <input type="text" name="first_name" class="form-control" placeholder="Имя" required>
        </div>
        <div class="mb-3">
            <input type="text" name="last_name" class="form-control" placeholder="Фамилия" required>
        </div>
        <div class="mb-3">
            <input type="text" name="contact_number" class="form-control" placeholder="Контактный номер" required>
        </div>
        <div class="mb-3">
            <textarea name="address" class="form-control" placeholder="Адрес" required></textarea>
        </div>
        <div class="mb-3">
            <button type="submit" name="btn_submit" class="btn btn-primary">Добавить контакт</button>
        </div>
    </form>

</div>
</body>
</html>
