<?php
    if( count(get_included_files()) == 1 ) exit("Direct access not permitted.");

    $LISTJOB = [
        "Lausanne" => [
            "laborantinBiologie" => "Laborantin-e CFC; option biologie",
            "laborantinChimie" => "Laborantin-e CFC; option chimie",
            "laborantinPhysique" => "Laborantin-e CFC; option physique",
            "polyMecanicien" => "Polymécanicien-ne CFC",
            "informaticien" => "Informaticien-ne CFC",
            "logisticien" => "Logisticien-ne CFC",
            "planificateurElectricien" => "Planificateur-trice éléctricien-ne CFC",
            "employeCommerce" => "Employé-e de commerce CFC",
            "gardienAnimaux" => "Gardien-ne d'animaux CFC",
            "electronicien" => "Electronicien-ne CFC",
            "interactiveMediaDesigner" => "Interactive Media Designer CFC"
        ],
        "Sion" => [
            "polyMecanicien" => "Polymécanicien-ne CFC"
        ]
    ];
?>