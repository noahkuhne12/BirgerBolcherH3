<?php
    $sql = "SELECT product.ID, product.Name, product.Weight
    FROM product 
    WHERE product.Weight BETWEEN 10 AND 12
    ORDER BY product.Name ASC, product.Weight DESC;"
    ;
    $stat = $conn->prepare($sql);
    $stat->execute();
    $result = $stat->get_result();
?>

<div class="card border-secondary mb-3">
        <div class="card-header">
            <h2>Opg. 8 - Find og udskriv navnene på alle bolcher, der vejer mellem 10 og 12 gram (begge tal inklusive), sorteret alfabetisk og derefter vægt.</h2>
        </div>
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Navn</th>
                <th scope="col">Vægt (g)</th>

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


