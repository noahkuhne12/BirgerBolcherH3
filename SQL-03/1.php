<?php
    if($_GET["q-type"] == "combined")
    {
        $query = '%'.$_GET["search"].'%';
    }
    else if($_GET["q-type"] == "start")
    {
        $query = $_GET["search"].'%';
    }
    else
    {
        $query = '%';
    }
    $sql = "SELECT * FROM colour;";
    $stat = $conn->prepare($sql);
    $stat->execute();
    $storColour = $stat->get_result();

    if($_GET["Colour"] != "Alle" && !empty($_GET["Colour"]))
    {
        $sql = "SELECT product.ID, product.Name, product.Weight, product.CommodityPrice,
        colour.Colour, tast_type.Tast, tast_strength.Strength, acidity_level.Acidity 
        FROM product 
        INNER JOIN tast_strength ON product.TastStrengthID = tast_strength.ID 
        INNER JOIN acidity_level ON product.AcidityLevelID = acidity_level.ID 
        INNER JOIN tast_type ON product.TastTypeID = tast_type.ID 
        INNER JOIN colour ON product.ColourID = colour.ID 
        WHERE product.Name LIKE ? AND colour.Colour = ?;";

        $stat = $conn->prepare($sql);
        $stat->bind_param("ss",$query, $_GET["Colour"]);
    }
    else
    {
        $sql = "SELECT product.ID, product.Name, product.Weight, product.CommodityPrice,
        colour.Colour, tast_type.Tast, tast_strength.Strength, acidity_level.Acidity 
        FROM product 
        INNER JOIN tast_strength ON product.TastStrengthID = tast_strength.ID 
        INNER JOIN acidity_level ON product.AcidityLevelID = acidity_level.ID 
        INNER JOIN tast_type ON product.TastTypeID = tast_type.ID 
        INNER JOIN colour ON product.ColourID = colour.ID 
        WHERE product.Name LIKE ?;";
        $stat = $conn->prepare($sql);
        $stat->bind_param("s",$query);
    }  
    
    $stat->execute();
    $result = $stat->get_result();
?>


<div class="card border-secondary mb-3">
    <div class="card-header">
        <a class="btn btn-primary" href="index.php?SQL=03" role="button">vis alle</a>
        <br></br>
        <form>
            <input type="hidden" name="SQL" value="03" />
            <div class="input-group mb-3">
                <select class="form-select" name="Colour">
                <option<?= $_GET["Colour"] == "Alle" ? ' selected' : '' ?>>Alle</option>
                <?php
                    while($row = $storColour->fetch_assoc())
                    {   
                ?>
                    <option<?= $_GET["Colour"] == $row["Colour"] ? ' selected' : '' ?>><?=$row["Colour"]?></option>
                <?php
                    }
                ?>
                </select>
                <select class="form-select" name="q-type">
                    <option value="combined"<?= $_GET["q-type"] == "combined" ? ' selected' : '' ?>>sammenhængende bogstaver</option>
                    <option value="start"<?= $_GET["q-type"] == "start" ? ' selected' : '' ?>>Begyndelses bogstav</option>
                </select>
                <input name="search" type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="søg" value="<?= strip_tags($_GET['search']) ?>">
                <button class="btn btn-outline-secondary" type="submit" id="butten-search">søg</button>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <?php
    print_r($result);
            if($result->num_rows > 0){
        ?>

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
        <?php
            }
            else
        {
        ?>
                <h3>der er ingen bolcer med den kobination</h3>
                
        <?php    
           
        }
        ?>
    </div>
    <div  class="card-footer bg-transparent border-success">
        <h3>
            <?=$sql?>
        </h3>
    </div>
</div>