<?php

namespace App\admin\Controllers;

use App\admin\Models\EventModel;

class AgendaController extends Controller
{
    private $eventModel;

    public function __construct()
    {
        $this->eventModel = new EventModel();
    }

    public function createAgenda()
    {
        $events = $this->eventModel->getAllEvents();
        $this->render('custom/agendaForm', ['events' => $events]);
    }

    public function storeEvent()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $eventDate = $_POST['event_date'] ?? '';
            $eventTime = $_POST['event_time'] ?? '';
            $description = $_POST['description'] ?? '';

            if (!empty($name) && !empty($eventDate) && !empty($eventTime)) {
                $this->eventModel->addEvent($name, $eventDate, $eventTime, $description);

                $_SESSION['event_add_success'] = "L'événement '$name' a été ajouté avec succès.";
                header('Location: index.php?controller=home&action=index');
                exit();
            } else {
                $_SESSION['event_add_error'] = "Tous les champs sont requis pour ajouter un événement.";
                header('Location: index.php?controller=home&action=index');
                exit();
            }
        }
    }

    public function deleteEvent()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['event_id'])) {
            $eventId = $_POST['event_id'];
            $this->eventModel->deleteEvent($eventId);

            $_SESSION['event_delete_success'] = "L'événement a été supprimé avec succès.";
            header('Location: index.php?controller=agenda&action=createAgenda');
        } else {
            $_SESSION['event_delete_error'] = "Une erreur s'est produite lors de la tentative de suppression de l'événement.";
            header('Location: index.php?controller=agenda&action=createAgenda');
        }
        exit();
    }
}
