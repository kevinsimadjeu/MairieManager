<pre>
<?php
header('Content-Type:text/html; charset=UTF-8');
require_once('db_config.php');

$successMessage = "";
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $nh = trim(htmlspecialchars($_POST['nom_hom'] ?? ''));
    $nf = trim(htmlspecialchars($_POST['nom_fem'] ?? ''));
    $nt = trim(htmlspecialchars($_POST['nom_tem'] ?? ''));
    $jm = trim(htmlspecialchars($_POST['jour_ma'] ?? ''));
    $lm = trim(htmlspecialchars($_POST['lieu_ma'] ?? ''));
    $dm = trim(htmlspecialchars($_POST['date_ma'] ?? ''));

    if ($nh && $nf && $nt && $jm && $lm && $dm) {
        try {
            $request = $pdo->prepare('INSERT INTO demande_acte_mariage(nom_homme,nom_femme,nom_temoins,jour_mariage,lieu_mariage,date_demande) VALUES(:nom_homme,:nom_femme,:nom_temoins,:jour_mariage,:lieu_mariage,:date_demande)');
            $request->execute([
                'nom_homme' => $nh,
                'nom_femme' => $nf,
                'nom_temoins' => $nt,
                'jour_mariage' => $jm,
                'lieu_mariage' => $lm,
                'date_demande' => $dm
            ]);
            // echo "<h1><em>Merci pour votre compréhension. vos données seront traitées</h1>";
        } catch (PDOException $e) {
            echo "<h1><em>Erreur lors de l'insertion des données: " . htmlspecialchars($e->getMessage()) . "</h1>";
        }
    } else {
        echo "<h1><em>Tous les champs sont requis.</h1>";
    }
}

?></pre>

<!--<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Acte de Naissance</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(243, 105, 105);
        }

        .container_form_mariage {
            min-width: none;
            max-width: 400px;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            background-color: rgb(240, 210, 210);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            margin-top: 150px;
        }

        .section {
            margin-bottom: 20px;
        }

        .section p {
            display: flex;
            margin: 10px 0;
        }

        @media (max-width: 500px) {
            .container_form_mariage {
                width: 90%;
            }

            .section p {
                flex-direction: column;
            }

            .section p * {
                width: 100%;
            }
        }

        .label {
            font-weight: bold;
            width: 200px;
            display: inline-block;
        }

        .value {
            display: inline-block;

        }

        .bouton {
            text-align: center;
            margin-bottom: 20px;
            background-color: rgb(214, 26, 26);
            border-radius: 30px;
            width: 130px;
            height: 40px;
            color: #fff;
            font-size: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
        }

        input {
            display: inline-block;
            border-radius: 15px;
            padding: 5px;
            outline: none;
            border: 1px solid #ccc;
        }

        input:focus {
            border-color: rgb(214, 26, 26);
        }
    </style>
</head>

<body>
    <?php require_once('header.php'); ?>
    <form action="" method="post" id="formMariage">
        <div id="popupErreur" style="display:none; background-color: rgba(255,0,0,0.8); color: #fff; padding: 10px; border-radius: 5px; position: fixed; top: 20px; left: 50%; transform: translateX(-50%); z-index: 1000;"></div>
        <div class="container_form_mariage">
            <div class="header">
                <h2>ACTE DE MARIAGE</h2>
            </div>
            <div class="section">
                <p>
                    <span class="label">Nom du marié :</span>
                    <span class="value"><input type="text" name="nom_hom" id="nom_enfant"></span>
                </p>
                <p>
                    <span class="label">Nom de la femme:</span>
                    <span class="value"><input type="text" name="nom_fem" id="prenom_enfant"></span>
                </p>
                <p>
                    <span class="label">Nom témoin:</span>
                    <span class="value"><input type="text" name="nom_tem"></span>
                </p>
                <p>
                    <span class="label">jour mariage:</span>
                    <span class="value"><input type="text" name="jour_ma"></span>
                </p>
                <p>
                    <span class="label">lieu mariage:</span>
                    <span class="value"><input type="text" name="lieu_ma"></span>
                </p>
                <p>
                    <span class="label">date du mariage:</span>
                    <span class="value"><input type="date" name="date_ma"></span>
                </p>
                <p>
                    <span class="label">Photo des mariés:</span>
                    <span class="value"><input type="file" name="photo" id="photo" style="max-width: 170px;"></span>
                </p>
            </div>
            <div class="header"><input type="submit" value="soumettre" name="submit" class="bouton"></div>
    </form>

    </div>
     <?php
    require_once('footer.php');
    ?>
    <script src="script.js"></script>
    <script>
        document.getElementById('formMariage').addEventListener('submit', function(e) {
            const form = e.target;
            const popup = document.getElementById('popupErreur');
            let erreurs = [];

            const champs = ['nom_hom', 'nom_fem', 'nom_tem', 'jour_ma', 'lieu_ma', 'date_ma', "photo"];
            const values = [
                form.elements['nom_hom'].value,
                form.elements['nom_fem'].value,
                form.elements['nom_tem'].value,
                form.elements['jour_ma'].value,
                form.elements['lieu_ma'].value,
                form.elements['date_ma'].value,
                form.elements['photo'].value
            ];
            alert(values);
            champs.forEach(name => {
                const champ = form.elements[name];
                if (!champ.value.trim()) {
                    erreurs.push(`Le champ "${name.replace(/_/g, ' ')}" est requis.`);
                }
            });

            if (erreurs.length > 0) {
                e.preventDefault();
                popup.innerHTML = erreurs.join('<br>');
                popup.style.display = 'block';

                setTimeout(() => {
                    popup.style.display = 'none';
                }, 4000);
            }
        });
    </script>
</body>

</html> -->