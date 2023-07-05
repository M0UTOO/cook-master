<?php

namespace App\Controllers;

class Reservation extends BaseController
{
    //client makes a reservation
    //on récupère les infos envoyées par le js du calendar dans mdoal,
    // on raffiche une page pour confirmer les infos de réservation (date) et payer(stripe youhou.)
    //si stripe okay, on envoie les infos de réservation à l'api
    //si stripe pas okay, on raffiche la page de réservation avec un message d'erreur
}