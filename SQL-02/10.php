<?php
    $sql = "SELECT product.ID, product.Name, product.Weight, product.CommodityPrice,
        colour.Colour, tast_type.Tast, tast_strength.Strength, acidity_level.Acidity 
        FROM product 
        INNER JOIN tast_strength ON product.TastStrengthID = tast_strength.ID 
        INNER JOIN acidity_level ON product.AcidityLevelID = acidity_level.ID 
        INNER JOIN tast_type ON product.TastTypeID = tast_type.ID 
        INNER JOIN colour ON product.ColourID = colour.ID 
        ORDER BY RAND()
        LIMIT 1;"
    ;
    $stat = $conn->prepare($sql);
    $stat->execute();
    $result = $stat->get_result();
?>

<div class="card border-secondary mb-3">
        <div class="card-header">
            <h2>Opg. 10 - Udskriv alle informationer om et tilfældigt bolche, udvalgt af systemet.</h2>
        </div>
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Navn</th>
                <th scope="col">Farve</th>
                <th scope="col">Vægt (g)</th>
                <th scope="col">Surhed</th>
                <th scope="col">Styrke</th>
                <th scope="col">Type</th>
                <th scope="col">Pris (øre)</th>
              </tr>
            </thead>
            <tbody>
<?php
while($row = $result->fetch_assoc()){    
?>
              <tr>
                <th scope="row"><?= $row["ID"] ?></th>
                <td><?= $row["Name"] ?></td>
                <td><?= $row["Colour"] ?></td>
                <td><?= $row["Weight"] ?></td>
                <td><?= $row["Acidity"] ?></td>
                <td><?= $row["Strength"] ?></td>
                <td><?= $row["Tast"] ?></td>
                <td><?= $row["CommodityPrice"] ?></td>
              </tr>
<?php
}
?>
            </tbody>
          </table>
        </div>
        <div class="card-footer bg-transparent border-success">
            <h3>
                <?=$sql?>
            </h3>
          </div>
      </div>


