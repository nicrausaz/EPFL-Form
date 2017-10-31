<?php
    if( count(get_included_files()) == 1 ) exit("Direct access not permitted.");

    // by default, labo can't apply by this formular, in case, add these values in the array:

    // "laborantinBiologie" => "Laborantin-e CFC; option biologie",
    // "laborantinChimie" => "Laborantin-e CFC; option chimie",
    // "laborantinPhysique" => "Laborantin-e CFC; option physique",
    // "logisticien" => "Logisticien-ne CFC",
    // "planificateurElectricien" => "Planificateur-trice éléctricien-ne CFC",
    // "electronicien" => "Electronicien-ne CFC",

    $LISTJOB = [
        "Lausanne" => [
            "laborantinBiologie" => "Laborantin-e CFC; option biologie",
            "polyMecanicien" => "Polymécanicien-ne CFC",
            "informaticien" => "Informaticien-ne CFC",
            "employeCommerce" => "Employé-e de commerce CFC",
            "gardienAnimaux" => "Gardien-ne d'animaux CFC",
            "interactiveMediaDesigner" => "Interactive Media Designer CFC"
        ],
        "Sion" => [
            "logisticien" => "Logisticien-ne CFC"
        ]
    ];
?>