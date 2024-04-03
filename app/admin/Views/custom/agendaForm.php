<?php $title = "Ajouter un événement à l'agenda"; ?>

<!-- Affichage des alertes -->
<?php

$alertTypes = [
    'event_delete_success' => 'alert-success',
    'event_delete_error' => 'alert-danger',
];

foreach ($alertTypes as $key => $class) {
    if (isset($_SESSION[$key])) {
        echo "<div class='alert {$class}' role='alert'>" . htmlspecialchars($_SESSION[$key]) . "</div>";
        unset($_SESSION[$key]);
    }
}
?>


<div class="container">
    <h2>Ajouter un événement à l'agenda</h2>
    <form method="POST" action="index.php?controller=agenda&action=storeEvent">
        <div class="form-group my-3">
            <label for="eventName">Nom de l'événement</label>
            <input type="text" class="form-control input-desktop-width" id="eventName" name="name" required>
        </div>
        <div class="form-group my-3">
            <label for="eventDescription">Description de l'événement</label>
            <textarea class="form-control input-desktop-width" id="eventDescription" name="description" rows="3"></textarea>
        </div>
        <div class="form-group my-3">
            <label for="eventDate">Date de l'événement</label>
            <input type="date" class="form-control input-desktop-width" id="eventDate" name="event_date" required>
        </div>
        <div class="form-group my-3">
            <label for="eventTime">Heure de l'événement</label>
            <input type="time" class="form-control input-desktop-width" id="eventTime" name="event_time" value="08:00" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter l'événement</button>
    </form>
</div>

<hr>

<!-- Formulaire de suppression d'un événement -->
<div class="container">
    <form method="POST" action="index.php?controller=agenda&action=deleteEvent">
        <div class="form-group">
            <label for="eventSelect">Sélectionnez un événement à supprimer</label>
            <select class="form-control input-desktop-width m-2" id="eventSelect" name="event_id">
                <?php foreach ($events as $event) : ?>
                    <option value="<?= $event['id'] ?>"><?= htmlspecialchars($event['name']) . ' - ' . $event['event_date'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-danger m-3">Supprimer l'événement</button>
    </form>
</div>