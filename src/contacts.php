<?php
$contactsFile = 'json_data/contacts.json';

function getContactsFromJsonFile($file) {
    if (file_exists($file)) {
        $contacts = file_get_contents($file);
        $contacts = mb_convert_encoding($contacts, 'UTF-8', 'UTF-8, Windows-1251'); // Преобразование в UTF-8, если исходная кодировка Windows-1251
        return json_decode($contacts, true);
    } else {
        return [];
    }
}


function saveContactsToJsonFile($contacts, $file) {
    $jsonContacts = json_encode($contacts, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); // Использование опции JSON_UNESCAPED_UNICODE для корректного сохранения Unicode символов
    file_put_contents($file, $jsonContacts);
}


function deleteContact($contacts, $index) {
    array_splice($contacts, $index, 1);
    return $contacts;
}


function updateContact(&$contacts, $index, $updatedContact) {
    $contacts[$index] = $updatedContact;
}