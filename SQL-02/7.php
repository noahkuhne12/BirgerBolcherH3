<?php
    $sql = "SELECT product.ID, product.Name, product.Weight
    FROM product 
    WHERE product.Weight < 10
    ORDER BY product.Weight DESC;"
    ;
    $stat = $conn->prepare($sql);
    $stat->execute();
    $result = $stat->get_result();
?>

<div class="card border-secondary mb-3">
        <div class="card-header">
            <h2>Opg. 7 - Find og udskriv navn og vægt på alle bolcher der vejer mindre end 10 gram, sorter dem efter vægt, stigende.</h2>
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


