<?php define("URL", "generate.php");?>
<!DOCTYPE html>
<html>
<head>
  <title>Upload your files</title>
</head>
<body>
  <form enctype="multipart/form-data" action="<?= URL?>" method="POST">
    <p>Upload csv file</p>
    <input type="file" name="csv"></input>
    <input type="submit" value="Run"></input>
  </form>
<?php
$dir = "uploads";
$files = scandir($dir);
if(count($files) > 2):
?>
  
  <form action="<?= URL?>" method="POST">
    <p>Run csv file</p>
    <table border='1'>
        <tr>
            <th> # </th>
            <th> File name </th>
        </tr>
        <?php for ($i=2; $i < count($files); $i++) : ?>
        <tr>
            <td>
                <input type="radio" name="csv" value="<?= $files[$i]?>"></input>
            </td>
            <td>
                <strong class="file-nmae"><?= $files[$i]?></strong>
            </td>
        </tr>
        <?php endfor;?>
    </table>
    <input type="submit" name="import" value="Import"></input>
    <input type="submit" name="delete" value="Delete"></input>
  </form>
<?php endif;?>
</body>
</html>
<?PHP
define("PATH", "uploads/");
define("DOWNLOAD", "downloads/");
  if(!empty($_FILES['csv']))
  {
    $filepath = PATH . basename( $_FILES['csv']['name']);

    if(file_exists($filepath)){
      $newPath = PATH . time() . basename( $_FILES['csv']['name']);
      if(move_uploaded_file($_FILES['csv']['tmp_name'], $newPath)) {
        echo "The file ".  basename( $_FILES['csv']['name']). " has been uploaded";
      } else{
          echo "There was an error uploading the file, please try again!";
      }
    }else{
      if(move_uploaded_file($_FILES['csv']['tmp_name'], $filepath)) {
        echo "The file ".  basename( $_FILES['csv']['name']). " has been uploaded";
      } else{
          echo "There was an error uploading the file, please try again!";
      }
    }
    header("Refresh:0; url=".URL);
    exit;
  }
  if ($_POST) {
    if (!empty($_POST['delete'])) {
      $csv = PATH.$_POST['csv'];
      unlink($csv);
      header("Refresh:0; url=".URL);
      exit;
    }
    if (!empty($_POST['import'])) {
      $csv = PATH.$_POST['csv'];
    }
  }
?>

<?php
if (isset($csv)){
    $file = $csv;

    $row = 0;
    if (($handle = fopen($file, "r")) !== FALSE) {

        $downloadPath = DOWNLOAD.time()."export.csv";
        $fileToGenerate = fopen($downloadPath, 'a');
        while (($data = fgetcsv($handle,1000, ";")) !== FALSE) {
            $row++;
            try {
                if ($row == 1)
                {
                    $transactionArray['ordernumber'] = "ordernumber";
                    $transactionArray['mainnumber'] = "mainnumber";
                    $transactionArray['propertyGroupName'] = "propertyGroupName";
                    $transactionArray['Linie'] = "Linie";
                    $transactionArray['Anwendung1'] = "Anwendung1";
                    $transactionArray['Anwendung'] = "Anwendung";
                    $transactionArray['Garantiezeit'] = "Garantiezeit";
                }
                else 
                {
                    $transactionData = getTransactionData($data);
                    $transactionArray = array();
                    $transactionProperty = explode("|",$transactionData['propertyValueName']);
                    $transactionArray['ordernumber'] = $transactionData['ordernumber'];
                    $transactionArray['mainnumber'] = $transactionData['mainnumber'];
                    $transactionArray['propertyGroupName'] = $transactionData['propertyGroupName'];
                    foreach ($transactionProperty as $property) {
                        $propertyData = explode(":",$property);
                        $transactionArray[$propertyData[0]] = $propertyData[1];
                    }
                }

                echo "<pre>";
                print_r($transactionArray);
                
                echo "<br/>";
                echo "</pre>";
                
                fputcsv($fileToGenerate, $transactionArray);
                
            } catch (\Exception $e) {
                echo $e;
            }
        }
        fclose($handle);
        fclose($fileToGenerate);
        echo("<br/>");
        echo "<br/> Total Rows: ".$row;
        echo("<br/>");
        echo('<a href="downloads/export.csv" download>Download TEXT file</a>');
        
    }
}


function getTransactionData($data)
{
    return [
        'ordernumber' => $data[0],
        'mainnumber' => $data[1],
        'propertyGroupName' => $data[2],
        'propertyValueName' => $data[3]
    ];
}
?>