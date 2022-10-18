<h3><?= $data['title'] ?> .</h3>;   
<p><a href="<?= URLROOT; ?>/richestpeople/create">Nieuw Record</a></p>
<table>
    <thead>
        <th>Id</th>
        <th>Naam</th>
        <th>Vermogen</th>
        <th>Leeftijd</th>
        <th>Bedrijf</th>
        <th>Delete</th>
    </thead>

    <tbody>
        <?= $data['rows'] ?>
    </tbody>
</table>
<p><a href="<?= URLROOT; ?>/landingpages/index">Homepage</a></p>
    