<?php
    $sql = "SELECT product.ID, product.Name, product.Weight, product.CommodityPrice
        FROM product 
        ORDER BY product.ID ASC;"
    ;
    $stat = $conn->prepare($sql);
    $stat->execute();
    $result = $stat->get_result();
?>

<div class="card border-secondary mb-3">
        <div class="card-header">
            <h2>Opg. 1 - Udskriv alle informationer om alle bolcher</h2>
        </div>
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Navn</th>
                <th scope="col">Vægt (g)</th>
                <th scope="col">Råvarepris (øre)</th>
                <th scope="col">Nettopris (øre)</th>
                <th scope="col">Salgspris Inkl. moms (øre)</th>
                <th scope="col">Salgspris 100g Inkl. moms (øre)</th>
              </tr>
            </thead>
            <tbody>
<?php
while($row = $result->fetch_assoc()){    
?>
              <tr>
                <th scope="row"><?= $row["ID"] ?></th>
                <td><?= $row["Name"] ?></td>
                <td><?= $row["Weight"] ?></td>
                <td><?= $row["CommodityPrice"] ?></td>
                <td><?= $netto = round($row["CommodityPrice"]*2.5,2) ?></td>
                <td><?= $sale = round($netto*1.25,2)?></td>
                <td><?= round(($sale / $row["CommodityPrice"]) * 100, 2) ?></td>
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


